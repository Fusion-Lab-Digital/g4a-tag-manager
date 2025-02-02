<a href="https://fusionlab.gr?utm_source=github&utm_medium=ga4&utm_campaign=module" target="_blank">
<img align="center" width="250" height="100" src="https://fusionlab.gr/fusion-lab-logo-neg-cropped.svg"/>
</a>


# Fusion Lab - Google Analytics 4 Extension

## 📌 Overview
**Fusion Lab Google Analytics 4 Extension** seamlessly integrates [Google Analytics 4 (GA4)](https://support.google.com/analytics/answer/10089681?hl=en) using [Google Tag Manager](https://tagmanager.google.com/), enabling advanced tracking for your Magento 2 store.

Includes all core events necessary for comprehensive analytics through GTM from your Magento 2 installation.

Optimized for speed through async code execution to append data to the dataLayer instead of on page load.

The extension is also compatible with [Content Security Policy (CSP)](https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP).

JSON File provided for your GTM container.

Semi PWA backend provided through rest endpoint to fetch product data.

## ⚡ Features
- Magento 2.4.x support.
- Includes settings JSON file that you can import to your [Google Tag Manager](https://tagmanager.google.com/) Container.
- Compatible with [Content Security Policy (CSP)](https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP).
- - dynamic nonce
- Events Included
  - page_view
  - add_to_cart
  - remove_from_cart
  - view_item_list
  - view_item
  - view_cart
  - begin_checkout
  - add_payment_info
  - add_shipping_info
  - purchase
- Multi Website / Storeview Support

## 🛠️ Installation

### Install via Composer 2.x
We recommend to install this module via a compatible version of [Composer 2.x](https://getcomposer.org/download/) for your Magento 2 Installtion.

See your [Magento 2 Requirements here](https://experienceleague.adobe.com/en/docs/commerce-operations/installation-guide/system-requirements). 
```bash
composer require fusionlab-digital/ga4-tag-manager
php bin/magento module:enable FusionLab_GA4
php bin/magento setup:upgrade
php bin/magento s:d:c
php bin/magento s:s:d {Your Themes}
php bin/magento cache:flush
```

### Manual Installation (not recommended)
1. This module has a dependency to [FusionLab_Core](https://github.com/Fusion-Lab-Digital/m2.core) which you must first install. See the github page for installation instructions.
2. Download the module and extract it into `app/code/FusionLab/Ga4`
3. Run the following Magento CLI commands:
```bash
php bin/magento module:enable FusionLab_GA4 FusionLab_Core
php bin/magento setup:upgrade
php bin/magento s:d:c
php bin/magento s:s:d {Your Themes}
php bin/magento cache:flush
```

## 🚀 Setup
Open the Admin and navigate to <b>Menu -> FusionLab -> Google Analytics 4</b>

1. Enable the Module
2. Provide your GTM Container ID
3. (recommended) Download the JSON file and import it to your GTM Container. Make sure you know what you are doing if other tags are present.
4. Expand Event Settings and apply the configuration for item id, brand, and concat category
5. (only for `view_item_list`) Expand Product Settings to apply the product list selector. Default value `.products.wrapper,grid.products-grid` is for clean theme.


## ⚙️ Configuration Documentation
| Field                                       | Area             | Documentation
|---------------------------------------------|------------------|-|
| Enable Module?                              | General Settings | Enables or Disables the functionality of the module.
| GTM Container Id	                           | General Settings | Your GTM Container Id. Can be found at your [Google Tag Manager](https://tagmanager.google.com/) container
| Download JSON File	                         | General Settings | Setup File that you can import into your [Google Tag Manager](https://tagmanager.google.com/) container. See Image in the Admin for Instructions.
| Use as Item Id	                             | Event Settings   | Is used for for `ecommerce.items[].item_id`. Make sure if you have Google Shopping XML this value is the same as your XML export.
| Brand Attribute Code		                      | Event Settings   | Is used  for `ecommerce.items[].item_brand`. 
| Concat Category Attributes into 1 field?			 | Event Settings   | If yes then the categories will show in item_category as Women/Shoes/Running Shoes. If no then the item_category up to item_category5 will be filled.
| Product List Selector			                    | Product Settings | Is used for the `view_item_list` event. The selector is needed so the code gathers all the products to append to the data layer.

## ✅ Compatibility
- Works with Magento 2.4.x
- ⚠️ Should also work with any version of Magento 2 that Supports >=php7.4
- Tested with Magento Luma Theme
- Tested with Magento Custom Theme


## 📄 License

This module is licensed under the Apache 2.0 License. See [LICENSE](LICENSE) for details.

## 📩 Support

For any issues, feature requests, or inquiries, please open an issue on [GitHub Issues](https://github.com/Fusion-Lab-Digital/m2.core/issues), contact us at info@fusionlab.gr, or visit our website at [fusionlab.gr](https://fusionlab.gr/?utm_source=github&utm_medium=ga4&utm_campaign=module) for more information.
