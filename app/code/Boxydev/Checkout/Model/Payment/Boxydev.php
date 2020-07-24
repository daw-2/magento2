<?php

/*
 * This file is part of the public package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        // Instancier Stripe avec la clé API privée
        // Idéalement, stocker la clé en BO
        \Stripe\Stripe::setApiKey('sk_test_oVCtBcho5lERfuAKA57WUg5E');

        // On doit "charger" le client avec son numéro de carte
        try {
            $customer = \Stripe\Customer::create([
                'email' => $payment->getOrder()->getBillingAddress()->getEmail(),
            ]);
            $card = \Stripe\Customer::createSource($customer->id, [
                'source' => [
                    'object' => 'card',
                    'number' => $payment->getCcNumber(),
                    'exp_month' => $payment->getCcExpMonth(),
                    'exp_year' => $payment->getCcExpYear(),
                    'cvc' => $payment->getCcCid()
                ]
            ]);
            $charge = \Stripe\Charge::create([
                'amount' => $amount * 100,
                'currency' => 'eur',
                'customer' => $customer->id
            ]);
        } catch (\Exception $e) {
            throw new \Magento\Framework\Validator\Exception(__($e->getMessage()));
        }

        $this->debugData([
            'order' => $payment->getCcNumber(),
            'billing' => $payment->getOrder()->getBillingAddress()->getName(),
            'amount' => $amount,
            'card' => $card,
        ]);

        // Changer le status de la commande et les informations de transactions

        // throw new \Magento\Framework\Validator\Exception(__('Payment capturing error.'));
    }

    public function isAvailable(?CartInterface $quote = null)
    {
        return true;
    }
}
