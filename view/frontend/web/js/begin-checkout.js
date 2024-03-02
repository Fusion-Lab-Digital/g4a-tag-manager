define([
    'jquery',
    'FusionLab_Ga4/js/gtm',
    'FusionLab_Ga4/js/abstract',
    'Magento_Checkout/js/model/quote'
], function ($, gtm) {
    'use strict';

    $.widget('FusionLab.beginCheckout', $.FusionLab.abstractGtm, {

        options: {
            currency: 'USD',
            productIds: [],
            quantity: [],
            value: 0,
            coupon: null,
            eventName: 'begin_checkout'
        },

        _create: function () {
            this._super();
            this.listenToBeforePushData();
            this.listenToAfterPushData();
            this.initiate();
        },

        listenToBeforePushData() {
            var self = this;
            $(document).on('gtm:beforePushData', function (event, data) {
                self.adjustDataLayerData(data);
            });
        },

        listenToAfterPushData() {
            var self = this;
            $(document).on('gtm:afterPushData', function (event, data) {
                if(data.event === self.options.eventName){
                    window.gtm = {};
                    window.gtm.begin_checkout = data;
                }
            });
        },

        adjustDataLayerData(data) {
            data.ecommerce.currency = this.options.currency;
            data.ecommerce.value = this.options.value;
            this.addProductQuantities(data);
        },

        addProductQuantities(data) {
            var self = this;
            data.ecommerce.items.forEach(function (item) {
                Object.keys(self.options.quantity).forEach(function (key) {
                    if (key === item.item_id) {
                        item.quantity = self.options.quantity[key];
                    }
                });
            })
        },

        initiate: function () {
            var request = this.createRequest(this.options.productIds);
            gtm.getProductEventData(request)
        },

    });

    return $.FusionLab.beginCheckout;
});
