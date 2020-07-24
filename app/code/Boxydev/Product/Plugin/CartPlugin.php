<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Product\Plugin;

use Magento\Quote\Model\Quote;
use Psr\Log\LoggerInterface;

class CartPlugin
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function beforeAddProduct(
        Quote $subject,
        $product,
        $request = null,
        $processMode = \Magento\Catalog\Model\Product\Type\AbstractType::PROCESS_MODE_FULL
    ) {
        $this->logger->debug('PLUGIN AVANT addProduct', ['request' => $request->getData()]);
        $request->setQty(10);

        return [$product, $request, $processMode];
    }

    public function aroundAddProduct(
        Quote $subject,
        \Closure $proceed,
        $product,
        $request = null,
        $processMode = \Magento\Catalog\Model\Product\Type\AbstractType::PROCESS_MODE_FULL
    ) {
        $result = $proceed($product, $request, $processMode);

        return $result;
    }
}
