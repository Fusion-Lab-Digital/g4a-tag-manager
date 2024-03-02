define([
    'jquery',
    'FusionLab_Ga4/js/gtm',
    "FusionLab_Ga4/js/helper",
    'FusionLab_Ga4/js/abstract'
], function ($, gtm,helper) {
    'use strict';

    $.widget('FusionLab.viewCart', $.FusionLab.abstractGtm, {

        options: {
            currency: 'USD',
            productIds: [],
            quantity: [],
            value: 0,
            coupon: null,
            eventName: 'view_cart'
        },

        _create: function () {
            this._super();
            this.listenToBeforePushData();
            this.initiate();
        },

        listenToBeforePushData() {
            var self = this;
            $(document).on('gtm:beforePushData', function (event, data) {
                self.adjustDataLayerData(data);
            });
        },

        adjustDataLayerData(data) {
            var self = this;
            data.ecommerce.currency = this.options.currency;
            data.ecommerce.value = this.options.value;
            data.ecommerce.coupon = this.options.coupon;
            data.ecommerce.items.forEach(function (item) {
                item.quantity = helper.getProductQuantityFromOptions(self.options.quantity, item.item_id);
            })
        },

        initiate: function () {
            var request = this.createRequest(this.options.productIds);
            gtm.getProductEventData(request)
        },

    });

    return $.FusionLab.viewCart;
});
