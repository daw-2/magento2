define([
    'uiComponent',
    'Magento_Checkout/js/model/payment/additional-validators',
    'Boxydev_Checkout/js/model/validator'
], function (Component, additionalValidators, validator) {
    'use strict';

    additionalValidators.registerValidator(validator);

    return Component.extend({});
});
