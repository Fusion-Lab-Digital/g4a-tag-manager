<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Block;

class AddToCart extends AbstractConfig
{

    protected $_template = 'FusionLab_Ga4::add-to-cart.phtml';

    /**
     * @return AbstractConfig
     */
    protected function _prepareLayout()
    {
        $this->jsLayout['categories'] = $this->getCategoryPath();
        $this->jsLayout['currency'] = $this->getCurrencyCode();
        return parent::_prepareLayout();
    }

}
