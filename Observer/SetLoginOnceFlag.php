<?php

namespace FusionLab\Ga4\Observer;

use Magento\Customer\Model\Session;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SetLoginOnceFlag implements ObserverInterface
{
    const FLAG_FUSION_LAB_JUST_LOGGED_IN = "fusionlab_customer_just_logged_in";
    private Session $customerSession;

    /**
     * @param Session $customerSession
     */
    public function __construct(Session $customerSession)
    {
        $this->customerSession = $customerSession;
    }
    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        $this->customerSession->setData(
            self::FLAG_FUSION_LAB_JUST_LOGGED_IN,
            true,
        );
    }
}
