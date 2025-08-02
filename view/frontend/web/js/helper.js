define([], function () {
    'use strict';

    return {

        getProductQuantityFromOptions(quantities, productIdentifier) {
            var result = 0;
            Object.keys(quantities).forEach(function (identifier) {
                if (identifier == productIdentifier) {
                    result = quantities[identifier];
                }
            });
            return result;
        },

        getProductPriceFromOptions(prices, productIdentifier) {
            var result = 0;
            Object.keys(prices).forEach(function (identifier) {
                if (identifier == productIdentifier) {
                    result = prices[identifier];
                }
            });
            return result;
        }

    };

});
