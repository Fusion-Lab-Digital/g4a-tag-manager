define([
  "jquery",
  "FusionLab_Ga4/js/gtm",
  "FusionLab_Ga4/js/abstract",
], function ($, gtm) {
  "use strict";

  $.widget("FusionLab.addToWishlist", $.FusionLab.abstractGtm, {
    options: {
      productIds: [],
      categories: [],
      currency: "USD",
      value: 0,
      eventName: "add_to_wishlist",
    },

    _create: function () {
      this._super();
      this.listenToBeforePushData();
      this.initiate();
    },

    listenToBeforePushData: function () {
      var self = this;
      $(document).on("gtm:beforePushData", function (event, data) {
        if (self.isCorrectEvent(data)) {
          self.adjustDataLayerData(data);
        }
      });
    },

    adjustDataLayerData: function (data) {
      data.ecommerce.currency = this.options.currency;
      data.ecommerce.value = data.ecommerce.items[0].price;
    },

    initiate: function () {
      gtm.getProductEventData(this.createRequest());
    },

    createRequest: function () {
      var request = {};
      request.event_name = this.options.eventName;
      request.product_ids = this.options.productIds;
      this.sanitizeCategories();
      if (this.options.categories.length > 0) {
        request.include_categories = false;
        request.categories = this.options.categories.map(function (item) {
          return item.label;
        });
      }
      return request;
    },
  });

  return $.FusionLab.addToWishlist;
});
