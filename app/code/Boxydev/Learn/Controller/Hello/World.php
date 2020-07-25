<?php

namespace Boxydev\Learn\Controller\Hello;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RawFactory;

class World extends Action
{
    /**
     * @var RawFactory
     */
    private $rawFactory;

    public function __construct(Context $context, RawFactory $rawFactory)
    {
        parent::__construct($context);

        $this->rawFactory = $rawFactory;
    }

    public function execute()
    {
        $raw = $this->rawFactory->create();
        $raw->setContents('<h1>'.__('Hello World').'</h1>');

        return $raw;
    }
}
