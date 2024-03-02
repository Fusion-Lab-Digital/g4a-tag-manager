define([
    'jquery',
    'Magento_Checkout/js/model/quote'

], function (
    $
    , quote) {
    'use strict';

    return {

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

});
