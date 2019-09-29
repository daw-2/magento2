define([
    'Magento_Payment/js/view/payment/cc-form'
], function (Component) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Boxydev_Checkout/payment/boxydev'
        },

        getCode: function () {
            return 'boxydev';
        },

        isActive: function () {
            return true;
        }
    });
});
