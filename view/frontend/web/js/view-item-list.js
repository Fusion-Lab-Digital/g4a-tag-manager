define([
    'jquery',
    'FusionLab_Ga4/js/gtm',
    'FusionLab_Ga4/js/abstract'
], function ($, gtm) {
    'use strict';

    $.widget('FusionLab.viewItemList', $.FusionLab.abstractGtm, {

        options: {
            productIds: [],
            selector: '.products.wrapper,grid.products-grid',
            categories: [],
            listElement: null,
            eventName: 'view_item_list'
        },

        /**
         *
         * @inheritDoc
         */
        _create: function () {
            this._super();
            this.initiate();
            this._listenForAppendedProducts();
        },

        /**
         *
         * @private
         */
        _listenForAppendedProducts: function () {
            //Trigger this event from anywhere in the code and the products will get send with view_item_list event to tag manager
            var self = this;
            $(document).on('gtm:productsLoaded', function () {
                self.initiate();
            })
        },

        initiate: function () {
            this.setSelector();
            if (this.options.listElement === null) {
                console.error('No list element has been found.')
                return;
            }
            var productIds = this.getProductIds();
            productIds = this.removeProcessedIds(productIds);
            var request = this.createRequest(productIds);
            gtm.getProductEventData(request);
        },

        setSelector() {
            if (this.options.selector.length === 0) {
                console.error('No Selector for list has been set');
                return;
            }
            this.options.listElement = $(this.options.selector);
        },

        getProductIds() {
            var products = $(this.options.listElement).find('[data-product-id]');
            var ids = [];
            products.each(function (index, item) {
                ids.push(parseInt($(item).attr('data-product-id')));
            });
            return ids;
        },

        removeProcessedIds(ids) {
            var self = this;
            return ids.filter(function (id) {
                return !self.options.productIds.includes(id);
            });
        },

    });

    return $.FusionLab.viewItemList;
});
