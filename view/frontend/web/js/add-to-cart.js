define([
    'jquery',
    'FusionLab_Ga4/js/gtm',
    'FusionLab_Ga4/js/abstract'
], function ($, gtm) {
    'use strict';

    $.widget('FusionLab.addToCart', $.FusionLab.abstractGtm, {

        options: {
            categories: [],
            computedIds: [],
            currency: 'USD',
            eventName: 'add_to_cart'
        },
        _create: function () {
            this._super();
            this._listenBeforePushData();
            this._listenAfterPushData();
            this._listenToAddToCart();
            this._listenToEventDataLoad();
        },

        _listenBeforePushData() {
            var self = this;
            $(document).on('gtm:beforePushData', function (event, data) {
                if (data.event === self.options.eventName) {
                    if (data.hasOwnProperty('ecommerce') && data.ecommerce.items.length > 0) {
                        data.ecommerce.value = 0;
                        data.ecommerce.items.forEach(function (item) {
                            self.options.computedIds.push(item.item_id);
                            data.ecommerce.value =  (data.ecommerce.value + item.price);
                        });
                    }
                }
            })
        },

        _listenAfterPushData() {
            var self = this;
            $(document).on('gtm:afterPushData', function (event, data) {
                if (data.event === self.options.eventName) {
                    setTimeout(function (){
                        self.options.computedIds = [];
                    },1)
                }
            });
        },

        _listenToEventDataLoad() {
            var self = this;
            $(document).on('gtm:eventDataLoaded', function (event, data) {
                if (self.canProceed(data)) {
                    gtm.addToDataLayer(data);
                }
            });
        },

        _listenToAddToCart: function () {
            var self = this;
            $(document).on('ajax:addToCart', function (event, data) {
                self.form = data.form;
                self.sendData();
            });
        },

        sendData() {
            var request = this.createRequest();
            gtm.getProductEventData(request);
        },

        canProceed(data) {
            return data.hasOwnProperty('event')
                && data.event === this.options.eventName
                && !this.options.computedIds.includes(data.ecommerce.items[0].item_id)
                && !data.hasOwnProperty('gtm.uniqueEventId');
        },

        createRequest() {
            var request = {};
            var productId = 0;
            var productFormData = {};
            var formData = new FormData(this.form[0]);
            for (var [key, value] of formData.entries()) {
                if (key === 'product') {
                    productId = [value];
                }
                productFormData[key] = value;
            }
            request.event_name = this.options.eventName;
            request.product_ids = productId;
            request.product_form_data = productFormData;

            return request;
        },

    });

    return $.FusionLab.addToCart;
});
