<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Api\Data;

interface EcommerceDataInterface
{

    const CURRENCY = "currency";

    const TRANSACTION_ID = "transaction_id";

    const VALUE = "value";

    const COUPON = "coupon";

    const SHIPPING = "shipping";

    const TAX = "tax";

    const ITEM_LIST_ID = 'item_list_id';

    const ITEM_LIST_NAME = 'item_list_name';

    const PAYMENT_TYPE = 'payment_type';

    const SHIPPING_TIER = 'shipping_tier';

    const ITEMS = 'items';

    /**
     * @return string|null
     */
    public function getCurrency():?string;

    /**
     * @param string $currency
     * @return \FusionLab\Ga4\Api\Data\EcommerceDataInterface
     */
    public function setCurrency(string $currency):\FusionLab\Ga4\Api\Data\EcommerceDataInterface;

    /**
     * @return string|null
     */
    public function getTransactionId():?string;

    /**
     * @param string $transactonId
     * @return \FusionLab\Ga4\Api\Data\EcommerceDataInterface
     */
    public function setTransactionId(string $transactonId):\FusionLab\Ga4\Api\Data\EcommerceDataInterface;

    /**
     * @return float|null
     */
    public function getValue():?float;

    /**
     * @param float $value
     * @return \FusionLab\Ga4\Api\Data\EcommerceDataInterface
     */
    public function setValue(float $value):\FusionLab\Ga4\Api\Data\EcommerceDataInterface;

    /**
     * @return string|null
     */
    public function getCoupon():?string;

    /**
     * @param string $coupon
     * @return \FusionLab\Ga4\Api\Data\EcommerceDataInterface
     */
    public function setCoupon(string $coupon):\FusionLab\Ga4\Api\Data\EcommerceDataInterface;

    /**
     * @return float|null
     */
    public function getShipping():?float;

    /**
     * @param float $shipping
     * @return \FusionLab\Ga4\Api\Data\EcommerceDataInterface
     */
    public function setShipping(float $shipping = 0):\FusionLab\Ga4\Api\Data\EcommerceDataInterface;

    /**
     * @return float|null
     */
    public function getTax():?float;

    /**
     * @param float $tax
     * @return \FusionLab\Ga4\Api\Data\EcommerceDataInterface
     */
    public function setTax(float $tax):\FusionLab\Ga4\Api\Data\EcommerceDataInterface;

    /**
     * @return string|null
     */
    public function getItemListId():?string;

    /**
     * @param string|null $listId
     * @return \FusionLab\Ga4\Api\Data\EcommerceDataInterface
     */
    public function setItemListId(?string $listId = null):\FusionLab\Ga4\Api\Data\EcommerceDataInterface;

    /**
     * @return string|null
     */
    public function getItemListName():?string;

    /**
     * @param string|null $listName
     * @return \FusionLab\Ga4\Api\Data\EcommerceDataInterface
     */
    public function setItemListName(?string $listName = null):\FusionLab\Ga4\Api\Data\EcommerceDataInterface;

    /**
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface[]
     */
    public function getItems():array;

    /**
     * @param array $items
     * @return \FusionLab\Ga4\Api\Data\EcommerceDataInterface
     */
    public function setItems(array $items):\FusionLab\Ga4\Api\Data\EcommerceDataInterface;

}
