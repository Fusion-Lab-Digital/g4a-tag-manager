<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Api\Data;

interface ItemEventDataInterface
{

    const ITEM_ID = 'item_id';

    const ITEM_NAME = 'item_name`';

    const AFFILATION = 'affiliation';

    const COUPON = 'coupon';

    const DISCOUNT = 'discount';

    const INDEX = 'index';

    const ITEM_BRAND = 'item_brand';

    const ITEM_CATEGORY = 'item_category';

    const ITEM_CATEGORY2 = 'item_category2';

    const ITEM_CATEGORY3 = 'item_category3';

    const ITEM_CATEGORY4 = 'item_category4';

    const ITEM_CATEGORY5 = 'item_category5';

    const ITEM_LIST_ID = 'item_list_id';

    const ITEM_LIST_NAME = 'item_list_name';

    const ITEM_VARIANT = 'item_variant';

    const PRICE = 'price';

    const QUANTITY = 'quantity';

    /**
     * @return string
     */
    public function getItemId():string;

    /**
     * @param string $id
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setItemId(string $id):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return string
     */
    public function getItemName():string;

    /**
     * @param string $name
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setItemName(string $name):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return string|null
     */
    public function getAffilation():?string;

    /**
     * @param string $affilation
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setAffilation(string $affilation):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return string|null
     */
    public function getCoupon():?string;

    /**
     * @param string $coupon
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setCoupon(string $coupon):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return float|null
     */
    public function getDiscount():?float;

    /**
     * @param float $discount
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setDiscount(float $discount):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return int
     */
    public function getIndex():int;

    /**
     * @param int $index
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setIndex(int $index):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return string|null
     */
    public function getItemBrand():?string;

    /**
     * @param string|null $brand
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setItemBrand(?string $brand):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return string|
     */
    public function getItemCategory():?string;

    /**
     * @param string $category
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setItemCategory(string $category):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return string|null
     */
    public function getItemCategory2():?string;

    /**
     * @param string $category
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setItemCategory2(string $category):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return string|null
     */
    public function getItemCategory3():?string;

    /**
     * @param string $category
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setItemCategory3(string $category):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return string|null
     */
    public function getItemCategory4():?string;

    /**
     * @param string $category
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setItemCategory4(string $category):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return string|null
     */
    public function getItemCategory5():?string;

    /**
     * @param string $category
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setItemCategory5(string $category):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return string|null
     */
    public function getItemListId():?string;

    /**
     * @param string $listId
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setItemListId(string $listId):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return string|null
     */
    public function getItemListName():?string;

    /**
     * @param string $listName
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setItemListName(string $listName):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return string|null
     */
    public function getItemVariant():?string;

    /**
     * @param string $variant
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setItemVariant(string $variant):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return float|null
     */
    public function getPrice():?float;

    /**
     * @param float $price
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setPrice(float $price):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

    /**
     * @return int|null
     */
    public function getQuantity():?int;

    /**
     * @param int $qty
     * @return \FusionLab\Ga4\Api\Data\ItemEventDataInterface
     */
    public function setQuantity(int $qty):\FusionLab\Ga4\Api\Data\ItemEventDataInterface;

}
