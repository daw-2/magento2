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

use Magento\Framework\Event\Manager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Hello extends Command
{
    /**
     * @var Manager
     */
    private $eventManager;

    public function __construct(
        Manager $eventManager,
        string $name = null
    ) {
        parent::__construct($name);
        $this->eventManager = $eventManager;
    }

    protected function configure()
    {
        $this
            ->setName('boxydev:hello')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->eventManager->dispatch('boxydev_hello_event', ['key' => 'value']);
        $output->writeln(__('Hello world'));
    }
}
