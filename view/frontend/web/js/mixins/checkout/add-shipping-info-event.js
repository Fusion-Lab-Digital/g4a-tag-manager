define([
    'jquery',
    'underscore',
    'FusionLab_Ga4/js/gtm',
    'FusionLab_Ga4/js/mixins/checkout/checkout-gtm-events',
    'Magento_Checkout/js/model/quote',
], function (
    $,
    _,
    gtm,
    gtmCheckout,
    quote
) {
    "use strict";


    var mixin = {

        request: {},

        initialize() {

            this._super();
            this.createRequest();
            var self = this;
            quote.shippingMethod.subscribe(function (oldVal,newVal) {
                self.createRequest();
            });
            return this;
        },

        canProceed() {
            return quote && !quote.isVirtual() && quote.shippingMethod();
        },

        createRequest() {
            if (this.canProceed()) {
                var request = JSON.parse(JSON.stringify(window.gtm.begin_checkout));
                request.event = 'add_shipping_info';
                request.ecommerce.shipping_tier = quote.shippingMethod().carrier_title;
                gtmCheckout.adjustProductQuantitiesFromQuote(request);
                if(!_.isEqual(request,this.request)){
                    this.request = request;
                    gtm.addToDataLayer(request);
                }
            }
        },

        adjustProductQuantitiesFromQuote(request) {
            request.ecommerce.items.forEach(function (item) {
                quote.getItems().forEach(function (product) {
                    if (item.item_id === product.product_id || item.item_id === product.sku || product.hasOwnProperty('product') && item.item_id === product.product.sku) {
                        item.quantity = product.qty;
                    }
                })
            });
        }

    };

    return function (shippingMixin) {
        return shippingMixin.extend(mixin);
    };
});
