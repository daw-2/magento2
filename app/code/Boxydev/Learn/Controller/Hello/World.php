<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Learn\Controller\Hello;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

class World extends Action
{
    public function execute()
    {
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $page->addHandle('boxydev_hello_world');
        $result->getLayout()->getUpdate()->addHandle('boxydev_common');
        $result->getLayout()->getUpdate()->getHandles();
        $page->getConfig()->getTitle()->set(ucfirst($this->_request->getModuleName()));

        return $page;
    }
}
