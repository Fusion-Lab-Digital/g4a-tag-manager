<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Block;

class Head extends AbstractConfig
{

    protected $_template = 'FusionLab_Ga4::head.phtml';

    /**
     * @return string
     */
    public function getContainerId(): string
    {
        return $this->configProvider->getGoogleTagManagerId();
    }

}
