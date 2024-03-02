define([
    'jquery',
    'FusionLab_Ga4/js/gtm',
    'FusionLab_Ga4/js/abstract'
], function ($, gtm) {
    'use strict';

    $.widget('FusionLab.removeItem', $.FusionLab.abstractGtm, {

        options: {
            currency: 'USD',
            eventName: 'remove_from_cart'
        },

        _create: function () {
            this._super();
            this.listenToRemoveFromCart();
            this.listenToBeforePushData();
        },

        listenToRemoveFromCart: function () {
            var self = this;
            $(document).on('ajax:removeFromCart', function (event, data) {
                if(!data.hasOwnProperty('productIds')){
                    return;
                }
                data.productIds.forEach(function (productId) {
                    self.initiate(parseInt(productId));
                })
            });
        },

        listenToBeforePushData() {
            var self = this;
            $(document).on('gtm:beforePushData', function (event, data) {
                self.adjustDataLayerData(data);
            });
        },

        adjustDataLayerData(data) {
            data.ecommerce.currency = this.options.currency;
            data.ecommerce.value = this.options.value;
        },

        initiate: function (productId) {
            var request = this.createRequest([productId]);
            gtm.getProductEventData(request)
        },

    });

    return $.FusionLab.removeItem;
});
