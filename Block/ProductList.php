<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Block;


class ProductList extends AbstractConfig
{
    protected $_template = 'FusionLab_Ga4::view-item-list.phtml';

    /**
     * @return AbstractConfig
     */
    protected function _prepareLayout()
    {
        $this->jsLayout['selector'] = $this->getProductListSelector();
        $this->jsLayout['categories'] = $this->getCategoryPath();
        return parent::_prepareLayout();
    }

    /**
     * @return string
     */
    private function getProductListSelector():string
    {
        return $this->configProvider->getProductListSelector();
    }

}
