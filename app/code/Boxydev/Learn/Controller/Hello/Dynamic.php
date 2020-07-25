<?php

namespace Boxydev\Learn\Controller\Hello;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Dynamic extends Action
{
    public function execute()
    {
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        // echo 'Hello '. $this->getRequest()->getParam('name');

        $page->getLayout()->getBlock('page.main.title')->setPageTitle(sprintf(
            'Hello %s',
            $this->getRequest()->getParam('name') ?? 'matthieu'
        ));

        return $page;
    }
}
