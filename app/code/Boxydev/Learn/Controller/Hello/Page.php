<?php

namespace Boxydev\Learn\Controller\Hello;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;

class Page extends Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);

        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        // dump($page->getLayout()->getUpdate()->getHandles());
        $page->getLayout()->getBlock('page.main.title')->setPageTitle('TITRE');
        $page->addHandle('boxydev_hello_world');
        $result->getLayout()->getUpdate()->addHandle('boxydev_common');
        $result->getLayout()->getUpdate()->getHandles();
        $page->getConfig()->getTitle()->set(ucfirst($this->_request->getModuleName()));

        return $page;
    }
}
