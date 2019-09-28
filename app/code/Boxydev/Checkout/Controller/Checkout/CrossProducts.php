<?php

namespace Boxydev\Checkout\Controller\Checkout;

use Magento\Checkout\Model\Cart;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Data\Form\FormKey;

class CrossProducts extends Action
{
    /**
     * @var Cart
     */
    protected $cart;

    /**
     * @var FormKey
     */
    protected $formKey;

    public function __construct(
        Context $context,
        Cart $cart,
        FormKey $formKey
    ) {
        parent::__construct($context);
        $this->cart = $cart;
        $this->formKey = $formKey;
    }

    public function execute()
    {
        $requestData = $this->getRequest()->getContent();
        $products = json_decode($requestData, true);

        $request = [
            'form_key' => $this->formKey->getFormKey(),
            'qty' => 1
        ];

        foreach ($products as $product) {
            $this->cart->addProduct((int) $product['value'], $request);
        }

        $this->cart->save();

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData(['success' => 'ok']);
    }
}
