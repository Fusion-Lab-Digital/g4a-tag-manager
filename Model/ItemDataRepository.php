<?php
/**
 * Copyright (c) 2025 Fusion Lab G.P
 * Website: https://fusionlab.gr
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace FusionLab\Ga4\Model;

use FusionLab\Ga4\Api\Data\EcommerceDataInterfaceFactory;
use FusionLab\Ga4\Api\Data\EventDataInterfaceFactory;
use FusionLab\Ga4\Api\Data\EventDataRequestInterface;
use FusionLab\Ga4\Api\Data\ItemEventDataInterface;
use FusionLab\Ga4\Api\Data\ItemEventDataInterfaceFactory;
use FusionLab\Ga4\Api\ItemDataRepositoryInterface;
use Magento\Bundle\Model\Product\Price as BundlePrice;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Type as ProductType;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\GroupedProduct\Model\Product\Type\Grouped;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class ItemDataRepository implements ItemDataRepositoryInterface
{

    const SINGLE_QTY_EVENTS = [
        'view_item_list',
        'view_item',
    ];
    const MAX_CATEGORIES = 5;

    private EcommerceDataInterfaceFactory $ecommerceDataFactory;

    private EventDataInterfaceFactory $eventDataInterfaceFactory;

    private ItemEventDataInterfaceFactory $itemEventDataInterfaceFactory;

    private ConfigProvider $configProvider;

    private CollectionFactory $collectionFactory;

    private StoreManagerInterface $storeManager;

    private BundlePrice $bundlePrice;

    private Grouped $grouped;

    private ?EventDataRequestInterface $eventDataRequest = null;

    private ProductAttributeResolver $attributeResolver;

    private AdapterInterface $connection;

    private CategoryRepositoryInterface $categoryRepository;

    private LoggerInterface $logger;

    /**
     * @param EcommerceDataInterfaceFactory $ecommerceDataFactory
     * @param EventDataInterfaceFactory $eventDataInterfaceFactory
     * @param ItemEventDataInterfaceFactory $itemEventDataInterfaceFactory
     * @param ConfigProvider $configProvider
     * @param CollectionFactory $collectionFactory
     * @param StoreManagerInterface $storeManager
     * @param BundlePrice $bundlePrice
     * @param Grouped $grouped
     * @param ProductAttributeResolver $attributeResolver
     * @param ResourceConnection $connection
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        EcommerceDataInterfaceFactory $ecommerceDataFactory,
        EventDataInterfaceFactory     $eventDataInterfaceFactory,
        ItemEventDataInterfaceFactory $itemEventDataInterfaceFactory,
        ConfigProvider                $configProvider,
        CollectionFactory             $collectionFactory,
        StoreManagerInterface         $storeManager,
        BundlePrice                   $bundlePrice,
        Grouped                       $grouped,
        ProductAttributeResolver      $attributeResolver,
        ResourceConnection $connection,
        CategoryRepositoryInterface $categoryRepository,
        LoggerInterface             $logger
    ) {
        $this->ecommerceDataFactory = $ecommerceDataFactory;
        $this->eventDataInterfaceFactory = $eventDataInterfaceFactory;
        $this->itemEventDataInterfaceFactory = $itemEventDataInterfaceFactory;
        $this->configProvider = $configProvider;
        $this->collectionFactory = $collectionFactory;
        $this->storeManager = $storeManager;
        $this->bundlePrice = $bundlePrice;
        $this->grouped = $grouped;
        $this->attributeResolver = $attributeResolver;
        $this->connection = $connection->getConnection();
        $this->categoryRepository = $categoryRepository;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function getProductEventData(EventDataRequestInterface $request): ?\FusionLab\Ga4\Api\Data\EventDataInterface
    {
        if (!$this->configProvider->isEnabled()) {
            return null;
        }
        $this->eventDataRequest = $request;

        $products = $this->createCollection($request->getProductIds());
        if (!$products) {
            return null;
        }

        $items = $this->collectItemsData($products);

        $ecommerceData = $this->ecommerceDataFactory->create();
        $ecommerceData->setItems($items);

        $event = $this->eventDataInterfaceFactory->create();
        $event->setEvent($this->eventDataRequest->getEventName());
        $event->setEcommerce($ecommerceData);

        return $event;
    }

    /**
     * @param array $ids
     * @return array
     * @throws NoSuchEntityException
     */
    private function createCollection(array $ids): array
    {
        return $this->collectionFactory->create()
            ->addStoreFilter($this->storeManager->getStore()->getId())
            ->addAttributeToFilter('entity_id', ['in' => $ids])
            ->addAttributeToSelect(
                [
                    'name',
                    'price',
                    'special_price',
                    $this->configProvider->getProductBrandAttributeCode(),
                ]
            )
            ->getItems();
    }

    /**
     * @param ProductInterface $product
     * @param int $index
     * @return ItemEventDataInterface
     */
    private function createItemEventData(ProductInterface $product, int $index = 0): ItemEventDataInterface
    {
        /** @var ItemEventDataInterface $data */
        $data = $this->itemEventDataInterfaceFactory->create();

        $data->setItemId($product->getData($this->configProvider->getProductIdentifier()));
        $data->setItemName($product->getName());
        $data->setIndex($index);
        $data->setItemBrand($this->getItemBrand($product));
        $data->setPrice($this->getProductPrice($product));
        if ($this->eventDataRequest->getEventName() === 'add_to_cart' && $this->eventDataRequest->getProductFormData()->hasData('qty')) {
            $data->setPrice($data->getPrice() * $this->eventDataRequest->getProductFormData()->getData('qty'));
        }

        $this->setProductCategories($data, $product);

        if (in_array($this->eventDataRequest->getEventName(), self::SINGLE_QTY_EVENTS)) {
            $data->setQuantity(1);
        }

        if ($this->eventDataRequest->getProductFormData() && $this->eventDataRequest->getProductFormData()->hasData('super_attribute')) {
            $data->setItemVariant($this->getProductVariant());
        }

        return $data;
    }

    /**
     * @param ItemEventDataInterface $data
     * @param ProductInterface $product
     * @return void
     */
    private function setProductCategories(ItemEventDataInterface $data, ProductInterface $product): void
    {
        if ($this->eventDataRequest->getCategories()) {
            $this->formatCategoriesIntoObject($data, $this->eventDataRequest->getCategories());
            return;
        }

        if (!$this->eventDataRequest->getIncludeCategories()) {
            return;
        }

        $categoryIds = $product->getCategoryIds();
        $categories = [];
        if (!$categoryIds) {
            return;
        }
        $select = $this->connection->select()
            ->from($this->connection->getTableName('catalog_category_entity'), ['path'])
            ->where('entity_id in (?)', $categoryIds)
            ->order('LENGTH(path) DESC')
            ->limit(1);

        $deepestPath = $this->connection->fetchOne($select);
        if (!$deepestPath) {
            return;
        }
        $deepestPath = explode('/', $deepestPath);

        foreach ($deepestPath as $id) {
            try {
                $category = $this->categoryRepository->get($id);
                if ($category->getLevel() <= 1) {
                    continue;
                }
                $categories[] = $category->getName();
            } catch (NoSuchEntityException $e) {
                $this->logger->critical($e);
            }
        }

        if (!$categories) {
            return;
        }

        $this->formatCategoriesIntoObject($data, $categories);
    }

    /**
     * @param ItemEventDataInterface $data
     * @param array $categories
     * @return void
     */
    private function formatCategoriesIntoObject(ItemEventDataInterface $data, array $categories):void
    {
        if ($this->configProvider->shouldConcatCategories()) {
            $data->setItemCategory(implode('/', $categories));
            return;
        }

        for ($i = 1; $i <= self::MAX_CATEGORIES; $i++) {
            if (($i - 1) === 0) {
                $function = 'setItemCategory';
            } else {
                $function = 'setItemCategory' . ($i);
            }
            $key = $i - 1;
            if (isset($categories[$key])) {
                $data->$function($categories[$key]);
            }
        }
    }

    /**
     * @return string
     */
    private function getProductVariant(): string
    {
        $variant = [];
        $attributes = $this->eventDataRequest->getProductFormData()->getData('super_attribute');
        foreach ($attributes as $key => $optionId) {
            $variant[] = $this->attributeResolver->getAttributeLabel($key) . ': ' . $this->attributeResolver->getAttributeValue($key, $optionId);
        }
        return implode(', ', $variant);
    }

    /**
     * @param ProductInterface|Product $product
     * @return float
     */
    private function getProductPrice(ProductInterface $product): float
    {
        switch ($product->getTypeId()) {
            case ProductType::TYPE_BUNDLE:
                return $this->bundlePrice->getTotalPrices($product, 'min');
            case Grouped::TYPE_CODE:
                $associatedProducts = $this->grouped->getAssociatedProducts($product);
                $prices = [];
                foreach ($associatedProducts as $associatedProduct) {
                    $prices[] = $associatedProduct->getFinalPrice();
                }
                return min($prices);
            default:
                return $product->getFinalPrice();
        }
    }

    /**
     * @param $product
     * @return string|null
     */
    private function getItemBrand($product): ?string
    {
        $brand = $product->getAttributeText($this->configProvider->getProductBrandAttributeCode());
        return is_string($brand) ? $brand : null;
    }

    /**
     * @param array $products
     * @return ItemEventDataInterface[]
     */
    private function collectItemsData(array $products): array
    {
        $items = [];
        $count = 0;
        foreach ($products as $product) {
            $items[] = $this->createItemEventData($product, $count);
            $count++;
        }
        return $items;
    }
}
