define([
    'uiComponent',
    'Magento_Checkout/js/model/payment/renderer-list'
], function (Component, rendererList) {
    'use strict';

    rendererList.push(
        {
            type: 'boxydev',
            component: 'Boxydev_Checkout/js/view/payment/method-renderer/boxydev-method'
        },
    );

    return Component.extend({});
});
