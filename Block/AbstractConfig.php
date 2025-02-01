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

namespace FusionLab\Ga4\Block;

use FusionLab\Ga4\Model\ConfigProvider;
use Magento\Catalog\Helper\Data;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Psr\Log\LoggerInterface;

abstract class AbstractConfig extends Template
{

    protected ConfigProvider $configProvider;

    protected Data $catalogHelper;

    private AdapterInterface $connection;

    private LoggerInterface $logger;

    /**
     * @param ConfigProvider $configProvider
     * @param Data $catalogHelper
     * @param ResourceConnection $connection
     * @param LoggerInterface $logger
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        ConfigProvider     $configProvider,
        Data               $catalogHelper,
        ResourceConnection $connection,
        LoggerInterface    $logger,
        Context   $context,
        array              $data = []
    ) {
        $this->configProvider = $configProvider;
        $this->catalogHelper = $catalogHelper;
        $this->connection = $connection->getConnection();
        $this->logger = $logger;
        parent::__construct($context, $data);
    }

    /**
     * @return AbstractConfig
     */
    protected function _prepareLayout()
    {
        if (!$this->configProvider->isEnabled()) {
            $this->setTemplate(null);
        }

        return parent::_prepareLayout();
    }

    /**
     * @return array
     */
    protected function getCategoryPath(): array
    {
        $result = [];

        foreach ($this->catalogHelper->getBreadcrumbPath() as $key => $item) {
            $result[] = [
                'id' => str_replace('category', "", $key),
                'label' => $item['label']
            ];
        }
        return $result;
    }

    /**
     * @return string
     */
    protected function getCurrencyCode(): string
    {
        $result = '';
        try {
            $result = $this->_storeManager->getStore()->getCurrentCurrencyCode();
        } catch (NoSuchEntityException $e) {
            $this->logger->critical($e->getMessage());
        }

        return $result;
    }

    /**
     * @param string $sku
     * @return int
     */
    protected function getProductIdBySku(string $sku): int
    {
        $select = $this->connection->select()
            ->from($this->connection->getTableName('catalog_product_entity'), ['entity_id'])
            ->where('sku = ?', $sku);

        return (int) $this->connection->fetchOne($select);
    }
}
