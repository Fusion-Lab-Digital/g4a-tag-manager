<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Block;

class RemoveItem extends AbstractConfig
{

    protected $_template = 'FusionLab_Ga4::remove-item.phtml';

    /**
     * @return AbstractConfig
     */
    protected function _prepareLayout()
    {
        $this->jsLayout['currency'] = $this->getCurrencyCode();
        return parent::_prepareLayout();
    }


}
