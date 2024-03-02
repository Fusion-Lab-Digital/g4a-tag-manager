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
        }

    };

});
