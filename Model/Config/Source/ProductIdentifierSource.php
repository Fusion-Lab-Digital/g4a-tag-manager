<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class ProductIdentifierSource implements OptionSourceInterface
{

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        return [
            [
                'label' => 'Product Id',
                'value' => 'entity_id',
            ],
            [
                'label' => 'Sku',
                'value' => 'sku',
            ],
        ];
    }
}
