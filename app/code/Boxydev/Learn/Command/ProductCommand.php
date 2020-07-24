<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Learn\Command;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\ObjectManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductCommand extends Command
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var ProductFactory
     */
    private $productFactory;

    public function __construct(
        ObjectManagerInterface $objectManager,
        ProductFactory $productFactory,
        string $name = null
    ) {
        parent::__construct($name);
        $this->objectManager = $objectManager;
        $this->productFactory = $productFactory;
    }

    protected function configure()
    {
        $this->setName('boxydev:product');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $product = $this->objectManager->create(Product::class);
        dump(get_class($product));
        dump(get_class($this->productFactory->create()));

        $output->writeln(__('Hello world'));
    }
}
