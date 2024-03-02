define([
    'jquery',
    'underscore',
    'FusionLab_Ga4/js/gtm',
    'FusionLab_Ga4/js/mixins/checkout/checkout-gtm-events',
    'Magento_Checkout/js/model/quote'
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
            quote.paymentMethod.subscribe(function () {
                self.createRequest();
            });
            return this;
        },

        canProceed() {
            return quote && quote.paymentMethod();
        },

        createRequest() {
            if (this.canProceed()) {
                var request = JSON.parse(JSON.stringify(window.gtm.begin_checkout));
                request.event = 'add_payment_info';
                request.ecommerce.payment_type = quote.paymentMethod().method;
                gtmCheckout.adjustProductQuantitiesFromQuote(request);
                if(!_.isEqual(request,this.request)){
                    this.request = request;
                    gtm.addToDataLayer(request);
                }
            }
        },

    };

    return function (paymentMixin) {
        return paymentMixin.extend(mixin);
    };
});
