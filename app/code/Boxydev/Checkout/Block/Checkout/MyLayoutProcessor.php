<?php

namespace Boxydev\Checkout\Block\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

class MyLayoutProcessor implements LayoutProcessorInterface
{
    public function process($jsLayout)
    {
        $customField = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
                'tooltip' => [
                    'description' => 'On peut ajouter un tooltip',
                ],
            ],
            'provider' => 'checkoutProvider',
            'dataScope' => 'shippingAddress.custom_attributes.custom_field',
            'label' => 'Custom Attribute',
            'sortOrder' => 0,
            'validation' => [
                'required-entry' => true
            ],
        ];

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['custom_field'] = $customField;

        return $jsLayout;
    }
}
