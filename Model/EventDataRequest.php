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

use FusionLab\Ga4\Api\Data\EventDataRequestInterface;
use Magento\Framework\DataObject;
use Magento\Framework\DataObjectFactory;

class EventDataRequest extends DataObject implements EventDataRequestInterface
{

    /**
     * @inheritDoc
     */
    public function getProductIds(): array
    {
        return $this->getData(self::PRODUCT_IDS);
    }

    /**
     * @inheritDoc
     */
    public function setProductIds(array $ids): \FusionLab\Ga4\Api\Data\EventDataRequestInterface
    {
        return $this->setData(self::PRODUCT_IDS, $ids);
    }

    /**
     * @inheritDoc
     */
    public function getEventName(): string
    {
        return (string) $this->getData(self::EVENT_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setEventName(string $eventName): \FusionLab\Ga4\Api\Data\EventDataRequestInterface
    {
        return $this->setData(self::EVENT_NAME, $eventName);
    }

    /**
     * @return DataObject|null
     */
    public function getProductFormData(): ?DataObject
    {
        return $this->getData(self::PRODUCT_FORM_DATA);
    }

    /**
     * @param mixed $data
     * @return EventDataRequestInterface
     */
    public function setProductFormData($data): \FusionLab\Ga4\Api\Data\EventDataRequestInterface
    {
        $object = \Magento\Framework\App\ObjectManager::getInstance()->get(DataObjectFactory::class)->create();
        $output = [];
        $currentGroup = null;
        foreach ($data as $key => $value) {
            preg_match('/([^\[]+)/', $key, $matches);
            if (!empty($matches)) {
                $currentGroup = $matches[1];
            }
            preg_match('/\[(\d+)\]/', $key, $indexMatches);
            if (isset($indexMatches[1])) {
                $index = (int) $indexMatches[1];
                $output[$currentGroup][$index] = $value;
            } else {
                $output[$key] = $value;
            }
        }

        $object->setData($output);
        return $this->setData(self::PRODUCT_FORM_DATA, $object);
    }

    /**
     * @inheritDoc
     */
    public function getCategories(): array
    {
        return $this->getData(self::CATEGORIES) ?? [];
    }

    /**
     * @inheritDoc
     */
    public function setCategories(array $categories): \FusionLab\Ga4\Api\Data\EventDataRequestInterface
    {
        return $this->setData(self::CATEGORIES, $categories);
    }

    /**
     * @inheritDoc
     */
    public function getIncludeCategories(): bool
    {
        return $this->getData(self::INCLUDE_CATEGORIES) ?? true;
    }

    /**
     * @inheritDoc
     */
    public function setIncludeCategories(bool $value = true): \FusionLab\Ga4\Api\Data\EventDataRequestInterface
    {
        return $this->setData(self::INCLUDE_CATEGORIES, $value);
    }
}
