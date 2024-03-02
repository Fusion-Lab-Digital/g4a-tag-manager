define([
    'jquery',
    'FusionLab_Ga4/js/gtm'

], function ($, gtm) {
    'use strict';

    $.widget('FusionLab.abstractGtm', {

        options: {
            eventName: '',
            categories: []
        },

        _create: function () {
            this._listenToEventDataLoad();
            this._listenToBeforePush();
        },

        _listenToEventDataLoad() {
            var self = this;
            $(document).on('gtm:eventDataLoaded', function (event, data) {
                if (self.canProceed(data)) {
                    gtm.addToDataLayer(data);
                }
            });
        },

        _listenToBeforePush() {
            var self = this;
            $(document).on('gtm:beforePushData', function (event, data) {
                self.sanitizeDataBeforePush(data);
            })
        },

        sanitizeDataBeforePush(obj) {

            var self = this;

            if (typeof obj !== 'object' || obj === null) {
                return obj;
            }

            if (Array.isArray(obj)) {
                const sanitizedArray = obj.map(function (item) {
                    return self.sanitizeDataBeforePush(item);
                }).filter(item => item !== null && item !== undefined);

                obj.length = 0;
                Array.prototype.push.apply(obj, sanitizedArray);
                return obj;
            }

            for (const key in obj) {
                if (obj.hasOwnProperty(key)) {
                    const sanitizedValue = self.sanitizeDataBeforePush(obj[key]);
                    if (sanitizedValue === null || sanitizedValue === undefined) {
                        delete obj[key];
                    } else {
                        obj[key] = sanitizedValue;
                    }
                }
            }

            return obj;
        },

        canProceed(data) {
            return data && data.hasOwnProperty('event')
                && data.event === this.options.eventName;
        },

        createRequest(ids) {
            var request = {};
            request.event_name = this.options.eventName;
            request.product_ids = ids;
            request.categories = this.options.categories.map(function (item) {
                return item.label;
            });

            return request;
        },

        sanitizeCategories() {
            this.options.categories = this.options.categories.filter(function (item) {
                return item.id !== 'product';
            });
        },

    });

    return $.FusionLab.abstractGtm;
});
