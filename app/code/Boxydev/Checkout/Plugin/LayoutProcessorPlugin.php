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

        unset($result['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['afterMethods']['children']['discount']);

        return $result;
    }
}
