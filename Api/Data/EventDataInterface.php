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
