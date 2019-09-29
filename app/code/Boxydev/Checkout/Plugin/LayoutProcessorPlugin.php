<?php

namespace Boxydev\Checkout\Plugin;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

class LayoutProcessorPlugin
{
    public function aroundProcess(
        LayoutProcessor $subject,
        \Closure $proceed,
        $jsLayout
    ) {
        $result = $proceed($jsLayout);

        // unset($result['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['afterMethods']['children']['discount']);

        // Ici, on peut faire la même chose que dans le XML
        $result['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['before-form']['children']['custom-checkout-form']['children']['custom-checkout-form-fields']['children'][] = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'customCheckoutForm',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
            ],
            'provider' => 'checkoutProvider',
            'dataScope' => 'customCheckoutForm.text_field_dynamic',
            'label' => 'Text Field Dynamic',
            'sortOrder' => 1,
            'validation' => [
                'required-entry' => true,
            ],
        ];

        return $result;
    }
}
