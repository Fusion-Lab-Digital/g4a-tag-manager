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

namespace FusionLab\Ga4\Api\Data;

interface EventDataRequestInterface
{

    const PRODUCT_IDS = 'product_ids';

    const EVENT_NAME = 'event_name';

    const PRODUCT_FORM_DATA = 'product_form_data';

    const CATEGORIES = 'categories';

    const INCLUDE_CATEGORIES = 'include_categories';

    /**
     * @return int[]
     */
    public function getProductIds():array;

    /**
     * @param int[] $ids
     * @return \FusionLab\Ga4\Api\Data\EventDataRequestInterface
     */
    public function setProductIds(array $ids):\FusionLab\Ga4\Api\Data\EventDataRequestInterface;

    /**
     * @return string
     */
    public function getEventName():string;

    /**
     * @param string $eventName
     * @return \FusionLab\Ga4\Api\Data\EventDataRequestInterface
     */
    public function setEventName(string $eventName):\FusionLab\Ga4\Api\Data\EventDataRequestInterface;

    /**
     * @return mixed|null
     */
    public function getProductFormData():?\Magento\Framework\DataObject;

    /**
     * @param mixed $data
     * @return \FusionLab\Ga4\Api\Data\EventDataRequestInterface
     */
    public function setProductFormData($data):\FusionLab\Ga4\Api\Data\EventDataRequestInterface;

    /**
     * @return string[]
     */
    public function getCategories():array;

    /**
     * @param string[] $categories
     * @return \FusionLab\Ga4\Api\Data\EventDataRequestInterface
     */
    public function setCategories(array $categories):\FusionLab\Ga4\Api\Data\EventDataRequestInterface;

    /**
     * @return bool
     */
    public function getIncludeCategories():bool;

    /**
     * @param bool $value
     * @return \FusionLab\Ga4\Api\Data\EventDataRequestInterface
     */
    public function setIncludeCategories(bool $value = true):\FusionLab\Ga4\Api\Data\EventDataRequestInterface;
}
