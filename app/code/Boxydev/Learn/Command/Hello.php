<?php

namespace Boxydev\Learn\Command;

use Magento\Framework\Event\Manager;
use Magento\Framework\ObjectManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloCommand extends Command
{
    /**
     * @var Manager
     */
    private $eventManager;

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    public function __construct(
        Manager $eventManager,
        ObjectManagerInterface $objectManager,
        string $name = null
    ) {
        parent::__construct($name);

        $this->eventManager = $eventManager;
        $this->objectManager = $objectManager;
    }

    protected function configure()
    {
        $this->setName('boxydev:hello');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->eventManager->dispatch('boxydev_hello_event', ['key' => 'value']);

        $object1 = new MyClass();
        $this->objectManager->configure([
            'preferences' => [
                MyClass::class => MyClass2::class,
            ],
            MyClass2::class => [
                'arguments' => [
                    'name' => 'toto',
                ],
            ],
            'MyClass3' => [
                'type' => MyClass::class,
            ],
        ]);
        $object2 = $this->objectManager->create(MyClass::class);
        $object3 = $this->objectManager->create('MyClass3');
        dump($object1, $object2, $object3);

        $output->writeln('Hello World');
    }
}

class MyClass
{
    public function __construct($name = null)
    {
        $this->name = $name;
    }
}

class MyClass2
{
    public function __construct($name = null)
    {
        $this->name = $name;
    }
}
