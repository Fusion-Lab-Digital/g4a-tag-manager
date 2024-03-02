<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Model;

use FusionLab\Ga4\Api\Data\ItemEventDataInterface;
use Magento\Framework\DataObject;

class ItemEventData extends DataObject implements ItemEventDataInterface
{

    /**
     * @inheritDoc
     */
    public function getItemId(): string
    {
        return (string)$this->getData(self::ITEM_ID);
    }

    /**
     * @inheritDoc
     */
    public function setItemId(string $id): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::ITEM_ID, $id);
    }

    /**
     * @inheritDoc
     */
    public function getItemName(): string
    {
        return (string)$this->getData(self::ITEM_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setItemName(string $name): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::ITEM_NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getAffilation(): ?string
    {
        return $this->getData(self::AFFILATION);
    }

    /**
     * @inheritDoc
     */
    public function setAffilation(string $affilation): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::AFFILATION, $affilation);
    }

    /**
     * @inheritDoc
     */
    public function getCoupon(): ?string
    {
        return $this->getData(self::COUPON);
    }

    /**
     * @inheritDoc
     */
    public function setCoupon(string $coupon): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::COUPON, $coupon);
    }

    /**
     * @inheritDoc
     */
    public function getDiscount(): ?float
    {
        return $this->getData(self::DISCOUNT);
    }

    /**
     * @inheritDoc
     */
    public function setDiscount(float $discount): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::DISCOUNT, $discount);
    }

    /**
     * @inheritDoc
     */
    public function getIndex(): int
    {
        return (int)$this->getData(self::INDEX);
    }

    /**
     * @inheritDoc
     */
    public function setIndex(int $index): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::INDEX, $index);
    }

    /**
     * @inheritDoc
     */
    public function getItemBrand(): ?string
    {
        return $this->getData(self::ITEM_BRAND) ?? null;

    }

    /**
     * @inheritDoc
     */
    public function setItemBrand(?string $brand): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::ITEM_BRAND, $brand);
    }

    /**
     * @inheritDoc
     */
    public function getItemCategory(): ?string
    {
        return $this->getData(self::ITEM_CATEGORY);
    }

    /**
     * @inheritDoc
     */
    public function setItemCategory(string $category): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::ITEM_CATEGORY, $category);
    }

    /**
     * @inheritDoc
     */
    public function getItemCategory2(): ?string
    {
        return $this->getData(self::ITEM_CATEGORY2);
    }

    /**
     * @inheritDoc
     */
    public function setItemCategory2(string $category): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::ITEM_CATEGORY2, $category);
    }

    /**
     * @inheritDoc
     */
    public function getItemCategory3(): ?string
    {
        return $this->getData(self::ITEM_CATEGORY3);
    }

    /**
     * @inheritDoc
     */
    public function setItemCategory3(string $category): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::ITEM_CATEGORY3, $category);
    }

    /**
     * @inheritDoc
     */
    public function getItemCategory4(): ?string
    {
        return $this->getData(self::ITEM_CATEGORY4);
    }

    /**
     * @inheritDoc
     */
    public function setItemCategory4(string $category): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::ITEM_CATEGORY4, $category);
    }

    /**
     * @inheritDoc
     */
    public function getItemCategory5(): ?string
    {
        return $this->getData(self::ITEM_CATEGORY5);
    }

    /**
     * @inheritDoc
     */
    public function setItemCategory5(string $category): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::ITEM_CATEGORY5, $category);
    }

    /**
     * @inheritDoc
     */
    public function getItemListId(): ?string
    {
        return $this->getData(self::ITEM_LIST_ID);
    }

    /**
     * @inheritDoc
     */
    public function setItemListId(string $listId): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::ITEM_LIST_ID, $listId);
    }

    /**
     * @inheritDoc
     */
    public function getItemListName(): ?string
    {
        return $this->getData(self::ITEM_LIST_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setItemListName(string $listName): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::ITEM_LIST_NAME, $listName);
    }

    /**
     * @inheritDoc
     */
    public function getItemVariant(): ?string
    {
        return $this->getData(self::ITEM_VARIANT);
    }

    /**
     * @inheritDoc
     */
    public function setItemVariant(string $variant): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::ITEM_VARIANT, $variant);
    }

    /**
     * @inheritDoc
     */
    public function getPrice(): ?float
    {
        return $this->getData(self::PRICE);
    }

    /**
     * @inheritDoc
     */
    public function setPrice(float $price): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * @inheritDoc
     */
    public function getQuantity(): ?int
    {
        return $this->getData(self::QUANTITY);
    }

    /**
     * @inheritDoc
     */
    public function setQuantity(int $qty): \FusionLab\Ga4\Api\Data\ItemEventDataInterface
    {
        return $this->setData(self::QUANTITY, $qty);
    }

}
