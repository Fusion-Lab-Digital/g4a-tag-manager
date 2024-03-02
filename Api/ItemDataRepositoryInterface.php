<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Api;

interface ItemDataRepositoryInterface
{

    /**
     * @param \FusionLab\Ga4\Api\Data\EventDataRequestInterface $request
     * @return \FusionLab\Ga4\Api\Data\EventDataInterface|null
     */
    public function getProductEventData(\FusionLab\Ga4\Api\Data\EventDataRequestInterface $request):?\FusionLab\Ga4\Api\Data\EventDataInterface;

}
