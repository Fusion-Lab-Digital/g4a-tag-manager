define([
    'jquery',
    'FusionLab_Ga4/js/gtm',
    "FusionLab_Ga4/js/helper",
    'FusionLab_Ga4/js/abstract'
], function ($, gtm,helper) {
    'use strict';

    $.widget('FusionLab.purchase', $.FusionLab.abstractGtm, {

        options: {
            currency: 'USD',
            productIds: [],
            quantity: [],
            value: 0,
            coupon: null,
            transaction_id: null,
            shipping: 0,
            tax: 0,
            eventName: 'purchase'
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
            data.ecommerce.tax = this.options.tax;
            data.ecommerce.shipping = this.options.shipping;
            data.ecommerce.transaction_id= this.options.transaction_id;
            data.ecommerce.items.forEach(function (item) {
                item.quantity = helper.getProductQuantityFromOptions(self.options.quantity, item.item_id);
            })
        },

        initiate: function () {
            var request = this.createRequest(this.options.productIds);
            gtm.getProductEventData(request)
        },

    });

    return $.FusionLab.purchase;
});
