<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Model\Config\Source;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

class ProductAttributesSource implements OptionSourceInterface
{

    /**
     * @var AdapterInterface
     */
    private AdapterInterface $connection;

    /**
     * @param ResourceConnection $connection
     */
    public function __construct(ResourceConnection $connection)
    {
        $this->connection = $connection->getConnection();
    }

    /**
     * @inheritDoc
     */
    public function toOptionArray():array
    {
        $attributes = $this->getAllAttributes();

        array_multisort(array_column($attributes, 'attribute_code'), $attributes);

        $result = [];
        $result[] = ['value' => null, 'label' => __('--Select Attribute--')];

        foreach ($attributes as $attribute) {
            $result[] = [
                'value' => $attribute['attribute_code'],
                'label' => '(ID:' . $attribute['attribute_id'] . ') ' . $attribute['frontend_label']
            ];
        }

        return $result;
    }

    /**
     * @return array
     */
    private function getAllAttributes(): array
    {
        $select = $this->connection->select()
            ->from($this->connection->getTableName('eav_attribute'), ['attribute_id', 'attribute_code', 'frontend_label'])
            ->where('entity_type_id = ?', 4)
            ->where('backend_type in (?)', ['text','varchar','int'])
            ->where('frontend_label IS NOT NULL');

        return $this->connection->fetchAll($select);
    }
}
