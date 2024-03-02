<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Api\Data;

interface EventDataInterface
{

    const EVENT = 'event';

    const ECOMMERCE = 'ecommerce';

    /**
     * @return string
     */
    public function getEvent(): string;

    /**
     * @param string $event
     * @return \FusionLab\Ga4\Api\Data\EventDataInterface
     */
    public function setEvent(string $event): \FusionLab\Ga4\Api\Data\EventDataInterface;

    /**
     * @return \FusionLab\Ga4\Api\Data\EcommerceDataInterface|null
     */
    public function getEcommerce(): ?\FusionLab\Ga4\Api\Data\EcommerceDataInterface;

    /**
     * @param \FusionLab\Ga4\Api\Data\EcommerceDataInterface $ecommerceData
     * @return \FusionLab\Ga4\Api\Data\EventDataInterface
     */
    public function setEcommerce(\FusionLab\Ga4\Api\Data\EcommerceDataInterface $ecommerceData): \FusionLab\Ga4\Api\Data\EventDataInterface;

}
