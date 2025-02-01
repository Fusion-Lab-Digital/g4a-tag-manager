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
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template\Context;
use Magento\Quote\Model\Quote;
use Psr\Log\LoggerInterface;

class ViewCart extends AbstractConfig
{

    protected $_template = 'FusionLab_Ga4::view-cart.phtml';

    private Session $session;

    private ?Quote $quote = null;

    /**
     * @param ConfigProvider $configProvider
     * @param Data $catalogHelper
     * @param ResourceConnection $connection
     * @param LoggerInterface $logger
     * @param Context $context
     * @param Session $session
     * @param array $data
     */
    public function __construct(
        ConfigProvider $configProvider,
        Data           $catalogHelper,
        ResourceConnection $connection,
        LoggerInterface $logger,
        Context        $context,
        Session        $session,
        array          $data = []
    ) {
        $this->session = $session;
        $this->getQuote();
        parent::__construct($configProvider, $catalogHelper, $connection, $logger, $context, $data);
    }

    /**
     * @return AbstractConfig
     */
    protected function _prepareLayout()
    {
        $this->jsLayout['currency'] = $this->getCurrencyCode();
        $this->getCartInfo();
        return parent::_prepareLayout();
    }

    /**
     * @return void
     */
    private function getCartInfo(): void
    {
        $value = 0;
        if (!$this->quote) {
            return;
        }
        $items = $this->quote->getAllVisibleItems();
        foreach ($items as $item) {
            $productId = $item->getProductId();
            if ($item->getData('has_children')) {
                $productId = $this->getProductIdBySku($item->getSku());
            }
            if (!isset($this->jsLayout['productIds']) || !in_array($productId, $this->jsLayout['productIds'])) {
                $this->jsLayout['productIds'][] = $productId;
                $this->jsLayout['quantity'][$productId] = $item->getQty();
                $this->jsLayout['quantity'][$item->getProduct()->getData('sku')] = $item->getQty();
                $this->jsLayout['quantity'][$item->getSku()] = (float) $item->getQty();
                $value = $value + ($item->getPriceInclTax() * $item->getQty());
            }
        }
        $this->jsLayout['value'] = $value;
    }

    /**
     * @return void
     */
    private function getQuote(): void
    {
        if (!$this->quote) {
            try {
                $this->quote = $this->session->getQuote();
            } catch (NoSuchEntityException $e) {
                $this->_logger->critical($e);
            } catch (LocalizedException $e) {
                $this->_logger->critical($e);
            }
        }
    }
}
