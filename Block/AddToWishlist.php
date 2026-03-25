<?php
/**
 * Copyright (c) 2026 Fusion Lab G.P
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
use FusionLab\Ga4\Observer\SetWishlistOnceFlag;
use Magento\Catalog\Helper\Data;
use Magento\Customer\Model\Session;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\View\Element\Template\Context;
use Psr\Log\LoggerInterface;

class AddToWishlist extends AbstractConfig
{
    protected $_template = "FusionLab_Ga4::add-to-wishlist.phtml";

    private Session $customerSession;

    /**
     * @param ConfigProvider $configProvider
     * @param Data $catalogHelper
     * @param ResourceConnection $connection
     * @param LoggerInterface $logger
     * @param Session $customerSession
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        ConfigProvider $configProvider,
        Data $catalogHelper,
        ResourceConnection $connection,
        LoggerInterface $logger,
        Session $customerSession,
        Context $context,
        array $data = [],
    ) {
        $this->customerSession = $customerSession;
        parent::__construct(
            $configProvider,
            $catalogHelper,
            $connection,
            $logger,
            $context,
            $data,
        );
    }

    /**
     * @return AbstractConfig
     */
    protected function _prepareLayout()
    {
        $parent = parent::_prepareLayout();
        if (
            !$this->customerSession->getData(
                SetWishlistOnceFlag::FLAG_FUSION_LAB_WISHLIST_ADD_ID,
            )
        ) {
            $this->setTemplate(null);
        }

        //So it runs the login event only once.

        if (
            $this->customerSession->hasData(
                SetWishlistOnceFlag::FLAG_FUSION_LAB_WISHLIST_ADD_ID,
            )
        ) {
            $this->jsLayout["currency"] = $this->getCurrencyCode();
            $this->jsLayout["productIds"] = [
                $this->customerSession->getData(
                    SetWishlistOnceFlag::FLAG_FUSION_LAB_WISHLIST_ADD_ID,
                ),
            ];

            $this->customerSession->unsetData(
                SetWishlistOnceFlag::FLAG_FUSION_LAB_WISHLIST_ADD_ID,
            );
        }

        return $parent;
    }
}
