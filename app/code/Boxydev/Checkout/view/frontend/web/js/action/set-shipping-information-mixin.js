define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
], function ($, wrapper, quote) {
    'use strict';

    return function (setShippingInformationAction) {
        return wrapper.wrap(setShippingInformationAction, function (originalAction) {
            var shippingAddress = quote.shippingAddress();
            if (shippingAddress['extension_attributes'] === undefined) {
                shippingAddress['extension_attributes'] = {};
            }

            for (var key in shippingAddress.customAttributes) {
                var attribute_code = shippingAddress.customAttributes[key].attribute_code;
                shippingAddress['extension_attributes'][attribute_code] = shippingAddress.customAttributes[key].value;
            }

            // exécuter la fonction orginal (Magento_Checkout/js/action/set-shipping-information)
            return originalAction();
        });
    };
});
