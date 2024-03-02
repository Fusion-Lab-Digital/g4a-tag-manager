<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
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

class ViewCart extends AbstractConfig
{

    protected $_template = 'FusionLab_Ga4::view-cart.phtml';

    private Session $session;

    private ?Quote $quote = null;

    /**
     * @param ConfigProvider $configProvider
     * @param Data $catalogHelper
     * @param Context $context
     * @param Session $session
     * @param array $data
     */
    public function __construct(
        ConfigProvider $configProvider,
        Data           $catalogHelper,
        ResourceConnection $connection,
        Context        $context,
        Session        $session,
        array          $data = []
    )
    {
        $this->session = $session;
        $this->getQuote();
        parent::__construct($configProvider, $catalogHelper,$connection, $context, $data);
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
            if($item->getData('has_children')){
                $productId = $this->getProductIdBySku($item->getSku());
            }
            if (!isset($this->jsLayout['productIds']) || !in_array($productId, $this->jsLayout['productIds'])) {
                $this->jsLayout['productIds'][] = $productId;
                $this->jsLayout['quantity'][$productId] = $item->getQty();
                $this->jsLayout['quantity'][$item->getProduct()->getData('sku')] = $item->getQty();
                $this->jsLayout['quantity'][$item->getSku()] = (float)$item->getQty();
                $value = $value + ($item->getPrice() * $item->getQty());
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
            } catch (LocalizedException $e) {
            }
        }

    }

}
