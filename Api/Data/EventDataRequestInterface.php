<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Api\Data;


interface EventDataRequestInterface
{

    const PRODUCT_IDS = 'product_ids';

    const EVENT_NAME = 'event_name';

    const PRODUCT_FORM_DATA = 'product_form_data';

    const CATEGORIES = 'categories';

    const INCLUDE_CATEGORIES = 'include_categories';

    /**
     * @return int[]
     */
    public function getProductIds():array;

    /**
     * @param int[] $ids
     * @return \FusionLab\Ga4\Api\Data\EventDataRequestInterface
     */
    public function setProductIds(array $ids):\FusionLab\Ga4\Api\Data\EventDataRequestInterface;

    /**
     * @return string
     */
    public function getEventName():string;

    /**
     * @param string $eventName
     * @return \FusionLab\Ga4\Api\Data\EventDataRequestInterface
     */
    public function setEventName(string $eventName):\FusionLab\Ga4\Api\Data\EventDataRequestInterface;

    /**
     * @return mixed|null
     */
    public function getProductFormData():?\Magento\Framework\DataObject;

    /**
     * @param mixed $data
     * @return \FusionLab\Ga4\Api\Data\EventDataRequestInterface
     */
    public function setProductFormData($data):\FusionLab\Ga4\Api\Data\EventDataRequestInterface;

    /**
     * @return string[]
     */
    public function getCategories():array;

    /**
     * @param string[] $categories
     * @return \FusionLab\Ga4\Api\Data\EventDataRequestInterface
     */
    public function setCategories(array $categories):\FusionLab\Ga4\Api\Data\EventDataRequestInterface;

    /**
     * @return bool
     */
    public function getIncludeCategories():bool;

    /**
     * @param bool $value
     * @return \FusionLab\Ga4\Api\Data\EventDataRequestInterface
     */
    public function setIncludeCategories(bool $value = true):\FusionLab\Ga4\Api\Data\EventDataRequestInterface;

}
