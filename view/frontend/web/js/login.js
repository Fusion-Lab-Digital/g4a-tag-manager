define([
  "jquery",
  "FusionLab_Ga4/js/gtm",
  "FusionLab_Ga4/js/abstract",
], function ($, gtm) {
  "use strict";

  $.widget("FusionLab.login", $.FusionLab.abstractGtm, {
    options: {
      currency: "USD",
      method: "Magento",
      eventName: "login",
    },

    _create: function () {
      this._super();
      this.initiate();
    },

    initiate: function () {
      gtm.addToDataLayer({
        event: this.options.eventName,
        method: this.options.method,
      });
    },
  });

  return $.FusionLab.login;
});
