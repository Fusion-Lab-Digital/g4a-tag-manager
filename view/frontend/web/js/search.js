define([
  "jquery",
  "FusionLab_Ga4/js/gtm",
  "FusionLab_Ga4/js/abstract",
], function ($, gtm) {
  "use strict";

  $.widget("FusionLab.search", $.FusionLab.abstractGtm, {
    options: {
      eventName: "search",
    },

    _create: function () {
      this._super();
      this.initiate();
    },

    initiate: function () {
      const params = new URLSearchParams(window.location.search);
      const query = params.get("q");
      if (query) {
        gtm.addToDataLayer({
          event: this.options.eventName,
          search_term: query,
        });
      }
    },
  });

  return $.FusionLab.search;
});
