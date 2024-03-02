var config = {
    'config': {
        'mixins': {
            'Magento_Checkout/js/view/shipping': {
                'FusionLab_Ga4/js/mixins/checkout/add-shipping-info-event': true
            },
            'Magento_Checkout/js/view/payment/default': {
                'FusionLab_Ga4/js/mixins/checkout/add-payment-info-event': true
            }
        }
    }
};
