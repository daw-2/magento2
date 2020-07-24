<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Checkout\Controller\Checkout;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\DataObject;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Model\Quote;

class CrossProducts extends Action
{
    /**
     * @var Quote
     */
    private $quote;

    /**
     * @var FormKey
     */
    private $formKey;

    /**
     * @var CartRepositoryInterface
     */
    private $cartRepository;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
        Context $context,
        \Magento\Checkout\Model\Session $session,
        CartRepositoryInterface $cartRepository,
        FormKey $formKey,
        ProductRepositoryInterface $productRepository
    ) {
        parent::__construct($context);
        $this->quote = $session->getQuote();
        $this->formKey = $formKey;
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    public function execute()
    {
        $requestData = $this->getRequest()->getContent();
        $products = json_decode($requestData, true);

        foreach ($products as $product) {
            $instance = $this->productRepository->getById((int) $product['value']);
            $request = new DataObject([
                'form_key' => $this->formKey->getFormKey(),
                'qty' => 1
            ]);
            $this->quote->addProduct($instance, $request);
        }

        $this->cartRepository->save($this->quote);

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)
            ->setData(['success' => 'ok']);
    }
}
