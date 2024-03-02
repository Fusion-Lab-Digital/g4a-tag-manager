<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class ConfigProvider
{

    const XML_PATH_GTM_ENABLE = 'fusionlab_ga4_settings/general/enable';

    const XML_PATH_GTM_CONTAINER_ID = 'fusionlab_ga4_settings/general/gtm_container_id';

    const XML_PATH_EVENT_SETTINGS_ITEM_ID = 'fusionlab_ga4_settings/event_settings/item_id';

    const XML_PATH_EVENT_SETTINGS_BRAND = 'fusionlab_ga4_settings/event_settings/brand';

    const XML_PATH_EVENT_SETTINGS_CATEGORY_CONCAT = 'fusionlab_ga4_settings/event_settings/category_concat';

    const XML_PATH_PRODUCT_LIST_SELECTOR = 'fusionlab_ga4_settings/product_settings/product_list';

    private ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->scopeConfig->getValue(self::XML_PATH_GTM_ENABLE, ScopeInterface::SCOPE_STORE) && !empty($this->getGoogleTagManagerId());
    }

    /**
     * @return string
     */
    public function getGoogleTagManagerId(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_GTM_CONTAINER_ID, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getProductIdentifier(): string
    {
        return (string)$this->scopeConfig->getValue(self::XML_PATH_EVENT_SETTINGS_ITEM_ID, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getProductBrandAttributeCode(): string
    {
        return (string)$this->scopeConfig->getValue(self::XML_PATH_EVENT_SETTINGS_BRAND, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return bool
     */
    public function shouldConcatCategories(): bool
    {
        return (bool)$this->scopeConfig->getValue(self::XML_PATH_EVENT_SETTINGS_CATEGORY_CONCAT, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function getProductListSelector(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_PRODUCT_LIST_SELECTOR,ScopeInterface::SCOPE_STORE);
    }

}
