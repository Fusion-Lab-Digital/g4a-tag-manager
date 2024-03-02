<?php

namespace FusionLab\Ga4\Model\Adminhtml\Backend;


class ContainerIdValidator extends \Magento\Framework\App\Config\Value
{

    /**
     * @return ContainerIdValidator
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function beforeSave(): ContainerIdValidator
    {

        if (!preg_match('/^GTM-[a-zA-Z0-9]{7}$/', $this->getValue())) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('Invalid GTM container ID. It should start with GTM- followed by 7 alphanumeric characters.')
            );
        }

        return parent::beforeSave();
    }
}
