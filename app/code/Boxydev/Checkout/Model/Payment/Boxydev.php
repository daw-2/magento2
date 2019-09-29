<?php

namespace Boxydev\Checkout\Model\Payment;

use Magento\Payment\Model\InfoInterface;
use Magento\Payment\Model\Method\Cc;
use Magento\Quote\Api\Data\CartInterface;

class Boxydev extends Cc
{
    const CODE = 'boxydev';

    protected $_code = self::CODE;

    protected $_canCapture = true;

    public function capture(InfoInterface $payment, $amount)
    {
        $this->debugData([
            'order' => $payment->getCcNumber(),
            'billing' => $payment->getOrder()->getBillingAddress()->getName(),
            'amount' => $amount
        ]);

        throw new \Magento\Framework\Validator\Exception(__('Payment capturing error.'));
    }

    public function isAvailable(?CartInterface $quote = null)
    {
        return true;
    }
}
