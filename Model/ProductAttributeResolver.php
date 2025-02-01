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

namespace FusionLab\Ga4\Model;

use Magento\Eav\Model\Entity\Attribute;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

class ProductAttributeResolver
{

    private Attribute $attribute;

    private AdapterInterface $connection;

    private LoggerInterface $logger;

    private $loadedAttributes = [];

    /**
     * @param Attribute $attribute
     * @param ResourceConnection $connection
     * @param LoggerInterface $logger
     */
    public function __construct(
        Attribute          $attribute,
        ResourceConnection $connection,
        LoggerInterface $logger
    ) {
        $this->attribute = $attribute;
        $this->connection = $connection->getConnection();
        $this->logger = $logger;
    }

    /**
     * @param int $attributeId
     * @return string
     */
    public function getAttributeLabel(int $attributeId): string
    {
        $attribute = $this->getAttribute($attributeId);
        return $attribute->getStoreLabel();
    }

    /**
     * @param int $attributeId
     * @param int $optionId
     * @return string
     */
    public function getAttributeValue(int $attributeId, int $optionId): string
    {
        $attribute = $this->getAttribute($attributeId);
        foreach ($attribute->getOptions() as $option) {
            if ((int) $option->getValue() === $optionId) {
                return $option->getLabel();
            }
        }

        return '';
    }

    /**
     * @param int $attributeId
     * @return Attribute|null
     */
    private function getAttribute(int $attributeId): ?Attribute
    {
        if (!array_key_exists($attributeId, $this->loadedAttributes)) {
            try {
                $this->loadedAttributes[$attributeId] = $this->attribute->loadByCode(4, $this->getAttributeCodeById($attributeId));
            } catch (LocalizedException $e) {
                $this->logger->critical($e);
            }
        }
        return array_key_exists($attributeId, $this->loadedAttributes) ? $this->loadedAttributes[$attributeId] : null;
    }

    /**
     * @param int $attributeId
     * @return string|null
     */
    public function getAttributeCodeById(int $attributeId): ?string
    {
        $select = $this->connection->select()
            ->from('eav_attribute', ['attribute_code'])
            ->where('attribute_id = ? ', $attributeId);

        return $this->connection->fetchOne($select);
    }
}
