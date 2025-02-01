<?php
/**
 * Copyright (c) 2025 Fusion Lab G.P
 * Website: https://fusionlab.gr
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
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
        $result[] = [
            'label' => __('--Select Attribute--'),
            'value' => null,
        ];

        foreach ($attributes as $attribute) {
            $result[] = [
                'label' => '(ID:' . $attribute['attribute_id'] . ') ' . $attribute['frontend_label'],
                'value' => $attribute['attribute_code'],
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
            ->where('backend_type in (?)', ['text', 'varchar', 'int'])
            ->where('frontend_label IS NOT NULL');

        return $this->connection->fetchAll($select);
    }
}
