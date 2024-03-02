<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Model;

use FusionLab\Ga4\Api\Data\EcommerceDataInterface;
use Magento\Framework\DataObject;

class EcommerceData extends DataObject implements EcommerceDataInterface
{

    /**
     * @inheritDoc
     */
    public function getCurrency(): ?string
    {
        return $this->getData(self::CURRENCY);
    }

    /**
     * @inheritDoc
     */
    public function setCurrency(string $currency): \FusionLab\Ga4\Api\Data\EcommerceDataInterface
    {
        return $this->setData(self::CURRENCY, $currency);
    }

    /**
     * @inheritDoc
     */
    public function getTransactionId(): ?string
    {
        return $this->getData(self::TRANSACTION_ID);
    }

    /**
     * @inheritDoc
     */
    public function setTransactionId(string $transactonId): \FusionLab\Ga4\Api\Data\EcommerceDataInterface
    {
        return $this->setData(self::TRANSACTION_ID, $transactonId);
    }

    /**
     * @inheritDoc
     */
    public function getValue(): ?float
    {
        return $this->getData(self::VALUE);
    }

    /**
     * @inheritDoc
     */
    public function setValue(float $value): \FusionLab\Ga4\Api\Data\EcommerceDataInterface
    {
        return $this->setData(self::VALUE, $value);
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
    public function setCoupon(string $coupon): \FusionLab\Ga4\Api\Data\EcommerceDataInterface
    {
        return $this->setData(self::COUPON, $coupon);
    }

    /**
     * @inheritDoc
     */
    public function getShipping(): ?float
    {
        return $this->getData(self::SHIPPING);
    }

    /**
     * @inheritDoc
     */
    public function setShipping(float $shipping = 0): \FusionLab\Ga4\Api\Data\EcommerceDataInterface
    {
        return $this->setData(self::SHIPPING, $shipping);
    }

    /**
     * @inheritDoc
     */
    public function getTax(): ?float
    {
        return $this->getData(self::TAX);
    }

    /**
     * @inheritDoc
     */
    public function setTax(float $tax): \FusionLab\Ga4\Api\Data\EcommerceDataInterface
    {
        return $this->setData(self::TAX, $tax);
    }

    /**
     * @inheritDoc
     */
    public function getItemListId(): ?string
    {
        return $this->getData(self::ITEM_LIST_ID) ?? null;
    }

    /**
     * @inheritDoc
     */
    public function setItemListId(?string $listId = null): \FusionLab\Ga4\Api\Data\EcommerceDataInterface
    {
        return $this->setData(self::ITEM_LIST_ID,$listId);
    }

    /**
     * @inheritDoc
     */
    public function getItemListName(): ?string
    {
        return $this->getData(self::ITEM_LIST_NAME) ?? null;
    }

    /**
     * @inheritDoc
     */
    public function setItemListName(?string $listName = null): \FusionLab\Ga4\Api\Data\EcommerceDataInterface
    {
        return $this->setData(self::ITEM_LIST_NAME,$listName);
    }

    /**
     * @inheritDoc
     */
    public function getItems(): array
    {
        return $this->getData(self::ITEMS);
    }

    /**
     * @inheritDoc
     */
    public function setItems(array $items): \FusionLab\Ga4\Api\Data\EcommerceDataInterface
    {
        return $this->setData(self::ITEMS, $items);
    }
}
