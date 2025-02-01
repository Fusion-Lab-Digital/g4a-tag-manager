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

namespace FusionLab\Ga4\Block;

use FusionLab\Ga4\Model\ConfigProvider;
use Magento\Catalog\Helper\Data;
use Magento\Csp\Helper\CspNonceProvider;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\View\Element\Template\Context;
use Psr\Log\LoggerInterface;

class Head extends AbstractConfig
{

    protected $_template = 'FusionLab_Ga4::head.phtml';

    private CspNonceProvider $cspNonceProvider;

    /**
     * @param ConfigProvider $configProvider
     * @param Data $catalogHelper
     * @param ResourceConnection $connection
     * @param LoggerInterface $logger
     * @param CspNonceProvider $cspNonceProvider
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        ConfigProvider $configProvider,
        Data $catalogHelper,
        ResourceConnection $connection,
        LoggerInterface $logger,
        CspNonceProvider $cspNonceProvider,
        Context $context,
        array $data = []
    ) {
        $this->cspNonceProvider = $cspNonceProvider;
        parent::__construct($configProvider, $catalogHelper, $connection, $logger, $context, $data);
    }

    /**
     * @return string
     */
    public function getContainerId(): string
    {
        return $this->configProvider->getGoogleTagManagerId();
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCspNonce(): string
    {
        return $this->cspNonceProvider->generateNonce();
    }
}
