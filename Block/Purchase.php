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
use Magento\Framework\View\Element\Template\Context;

class Purchase extends AbstractConfig
{

    protected $_template = 'FusionLab_Ga4::purchase.phtml';

    private Session $checkoutSession;

    /**
     * @param ConfigProvider $configProvider
     * @param Data $catalogHelper
     * @param Context $context
     * @param Session $checkoutSession
     * @param array $data
     */
    public function __construct(
        ConfigProvider           $configProvider,
        Data                     $catalogHelper,
        ResourceConnection $connection,
        Context                  $context,
        Session                  $checkoutSession,
        array                    $data = []
    )
    {
        $this->checkoutSession = $checkoutSession;
        parent::__construct($configProvider, $catalogHelper, $connection,$context, $data);
    }

    /**
     * @return AbstractConfig
     */
    protected function _prepareLayout()
    {
        $order = $this->checkoutSession->getLastRealOrder();
        if(!$order){
            return parent::_prepareLayout();
        }
        $items = $order->getAllVisibleItems();
        $this->jsLayout['currency'] = $order->getStoreCurrencyCode();

        foreach ($items as $item) {
            $productId = $item->getProductId();
            if($item->getData('has_children')){
                $productId = $this->getProductIdBySku($item->getSku());
            }
            if(!isset($this->jsLayout['productIds']) || !in_array($productId,$this->jsLayout['productIds'])){
                $this->jsLayout['productIds'][] = $productId;
                $this->jsLayout['quantity'][$productId] = (float)$item->getQtyOrdered();
                $this->jsLayout['quantity'][$item->getProduct()->getData('sku')] = (float)$item->getQtyOrdered();
                $this->jsLayout['quantity'][$item->getSku()] = (float)$item->getQtyOrdered();
            }
        }
        $this->jsLayout['value'] = (float)$order->getGrandTotal();
        $this->jsLayout['tax'] = (float)$order->getTaxAmount();
        $this->jsLayout['shipping'] = (float)$order->getShippingAmount();
        $this->jsLayout['transaction_id'] = $order->getIncrementId();
        $this->jsLayout['coupon'] = $order->getCouponCode();
        return parent::_prepareLayout();
    }


}
