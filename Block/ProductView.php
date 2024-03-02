<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Block;

class ProductView extends AbstractConfig
{

    protected $_template = 'FusionLab_Ga4::view-item.phtml';

    /**
     * @return AbstractConfig
     */
    protected function _prepareLayout()
    {
        $this->jsLayout['categories'] = $this->getCategoryPath();
        $this->jsLayout['currency'] = $this->getCurrencyCode();
        if($product = $this->getCurrentProduct()){
            $this->jsLayout['productIds'] = [(int)$product->getId()];
            $this->jsLayout['value'] = (float)$product->getFinalPrice();
        }
        return parent::_prepareLayout();
    }

    /**
     * @return \Magento\Catalog\Model\Product|null
     */
    public function getCurrentProduct():?\Magento\Catalog\Model\Product
    {
        return $this->catalogHelper->getProduct();
    }

}
