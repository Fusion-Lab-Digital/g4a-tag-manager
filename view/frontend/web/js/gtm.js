define([
    'jquery',
], function ($) {
    'use strict';

    return {

        getProductEventData: function (data) {
            var self = this;
            var request = {request:data}
            $.ajax({
                url: self._buildURL(),
                data: JSON.stringify(request),
                type: 'post',
                contentType: 'application/json',
                dataType: 'json',
            }).done(function (response) {
                $(document).trigger('gtm:eventDataLoaded', response);
            }).fail(function () {
                console.error('Failed to get product data')
            });

        },

        addToDataLayer: function (data) {
            $(document).trigger('gtm:beforePushData', data);
            if(data){
                window.dataLayer.push(data);
            }
            $(document).trigger('gtm:afterPushData', data);
        },

        _buildURL(){
            return window.BASE_URL + 'rest/V1/ga4/event-data';
        }

    };

});
