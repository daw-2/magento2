<?php

namespace Boxydev\Checkout\Plugin;

class ShippingAddressManagement
{
    public function beforeAssign(
        \Magento\Quote\Model\ShippingAddressManagement $subject,
        $cartId,
        \Magento\Quote\Api\Data\AddressInterface $address
    ) {
        $attributes = $address->getExtensionAttributes();

        if (!empty($attributes)) {
            $address->setCustomField($attributes->getCustomField());
        }
    }
}
