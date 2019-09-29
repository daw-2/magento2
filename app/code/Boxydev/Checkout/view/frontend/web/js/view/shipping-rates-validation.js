define([
    'uiComponent',
    'Magento_Checkout/js/model/shipping-rates-validator',
    'Magento_Checkout/js/model/shipping-rates-validation-rules',
    'Boxydev_Checkout/js/model/shipping-rates-validator',
    'Boxydev_Checkout/js/model/shipping-rates-validation-rules'
], function (
    Component,
    defaultShippingRatesValidator,
    defaultShippingRatesValidationRules,
    shippingRatesValidator,
    shippingRatesValidationRules
) {
    'use strict';

    defaultShippingRatesValidator.registerValidator('boxydevshipping', shippingRatesValidator);
    defaultShippingRatesValidationRules.registerRules('boxydevshipping', shippingRatesValidationRules);

    return Component;
});
