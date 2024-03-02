<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Model;

use FusionLab\Ga4\Api\Data\EventDataInterface;
use Magento\Framework\DataObject;

class EventData extends DataObject implements EventDataInterface
{

    /**
     * @inheritDoc
     */
    public function getEvent(): string
    {
        return (string)$this->getData(self::EVENT);
    }

    /**
     * @inheritDoc
     */
    public function setEvent(string $event): \FusionLab\Ga4\Api\Data\EventDataInterface
    {
        return $this->setData(self::EVENT,$event);
    }

    /**
     * @inheritDoc
     */
    public function getEcommerce(): ?\FusionLab\Ga4\Api\Data\EcommerceDataInterface
    {
        return $this->getData(self::ECOMMERCE) ?? null;
    }

    /**
     * @inheritDoc
     */
    public function setEcommerce(\FusionLab\Ga4\Api\Data\EcommerceDataInterface $ecommerceData): \FusionLab\Ga4\Api\Data\EventDataInterface
    {
        return $this->setData(self::ECOMMERCE,$ecommerceData);
    }
}
