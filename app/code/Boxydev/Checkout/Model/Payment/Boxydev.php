<?php

namespace Boxydev\Checkout\Model\Payment;

use Magento\Payment\Model\InfoInterface;
use Magento\Payment\Model\Method\Cc;
use Magento\Quote\Api\Data\CartInterface;

class Boxydev extends Cc
{
    protected $_code = 'boxydev';

    public function capture(InfoInterface $payment, $amount)
    {
        dump($payment);

        throw new \Magento\Framework\Validator\Exception(__('Payment capturing error.'));
    }

    public function isAvailable(?CartInterface $quote = null)
    {
        return true;
    }
}
