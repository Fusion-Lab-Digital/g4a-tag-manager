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
use Magento\Checkout\Model\Session;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\View\Element\Template\Context;
use Psr\Log\LoggerInterface;

class Purchase extends AbstractConfig
{

    protected $_template = 'FusionLab_Ga4::purchase.phtml';

    private Session $checkoutSession;

    /**
     * @param ConfigProvider $configProvider
     * @param Data $catalogHelper
     * @param ResourceConnection $connection
     * @param LoggerInterface $logger
     * @param Context $context
     * @param Session $checkoutSession
     * @param array $data
     */
    public function __construct(
        ConfigProvider           $configProvider,
        Data                     $catalogHelper,
        ResourceConnection $connection,
        LoggerInterface         $logger,
        Context                  $context,
        Session                  $checkoutSession,
        array                    $data = []
    ) {
        $this->checkoutSession = $checkoutSession;
        parent::__construct($configProvider, $catalogHelper, $connection, $logger, $context, $data);
    }

    /**
     * @return AbstractConfig
     */
    protected function _prepareLayout()
    {
        $order = $this->checkoutSession->getLastRealOrder();
        if (!$order) {
            return parent::_prepareLayout();
        }
        $items = $order->getAllVisibleItems();
        $this->jsLayout['currency'] = $order->getStoreCurrencyCode();

        foreach ($items as $item) {
            $productId = $item->getProductId();
            if ($item->getData('has_children')) {
                $productId = $this->getProductIdBySku($item->getSku());
            }
            if (!isset($this->jsLayout['productIds']) || !in_array($productId, $this->jsLayout['productIds'])) {
                $this->jsLayout['productIds'][] = $productId;
                $this->jsLayout['quantity'][$productId] = (float) $item->getQtyOrdered();
                $this->jsLayout['quantity'][$item->getProduct()->getData('sku')] = (float) $item->getQtyOrdered();
                $this->jsLayout['quantity'][$item->getSku()] = (float) $item->getQtyOrdered();
            }
        }
        $this->jsLayout['value'] = (float) $order->getGrandTotal();
        $this->jsLayout['tax'] = (float) $order->getTaxAmount();
        $this->jsLayout['shipping'] = (float) $order->getShippingAmount();
        $this->jsLayout['transaction_id'] = $order->getIncrementId();
        $this->jsLayout['coupon'] = $order->getCouponCode();
        return parent::_prepareLayout();
    }
}
