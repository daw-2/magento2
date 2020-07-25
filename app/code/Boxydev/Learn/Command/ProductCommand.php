<?php

namespace Boxydev\Learn\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ProductCommand extends Command
{
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        string $name = null
    ) {
        parent::__construct($name);

        $this->collectionFactory = $collectionFactory;
    }

    protected function configure()
    {
        $this
            ->setName('boxydev:product:see')
            ->setDefinition(
                new InputDefinition([
                    new InputArgument('number', InputArgument::OPTIONAL, 'Blabla', 10),
                    new InputOption('sort', 's', InputOption::VALUE_REQUIRED, 'Blabla', 'id'),
                    new InputOption('order', 'o', InputOption::VALUE_REQUIRED, 'Blabla', 'asc')
                ])
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sort = $input->getOption('sort');
        $order = $input->getOption('order');

        $collection = $this->collectionFactory->create();
        $collection
            ->addAttributeToSelect(['name', 'price'])
            ->joinField('quantity', 'cataloginventory_stock_item', 'qty', 'product_id = entity_id')
            ->setOrder($sort, strtoupper($order))
            ->setPageSize($input->getArgument('number'));

        dump($collection->getSelect()->__toString());

        $products = [];
        foreach ($collection->getItems() as $productItem) {
            $products[] = [
                $productItem->getSku(), $productItem->getName(),
                $productItem->getPrice(), $productItem->getQuantity(),
            ];
        }

        $table = new Table($output);

        $table
            ->setHeaders(['SKU', 'name', 'price', 'quantity'])
            ->setRows($products);

        $table->render();
    }
}
