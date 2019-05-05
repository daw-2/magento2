<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Controller\Adminhtml\Slide;

use Boxydev\Slider\Model\ResourceModel\Slide as ResourceSlide;
use Boxydev\Slider\Model\SlideFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Delete extends Action
{
    /**
     * @var SlideFactory
     */
    private $slideFactory;

    /**
     * @var ResourceSlide
     */
    private $resourceSlide;

    public function __construct(
        Context $context,
        SlideFactory $slideFactory,
        ResourceSlide $resourceSlide
    ) {
        parent::__construct($context);
        $this->slideFactory = $slideFactory;
        $this->resourceSlide = $resourceSlide;
    }

    public function execute()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            $slide = $this->slideFactory->create();
            $this->resourceSlide->load($slide, $id);
            $this->resourceSlide->delete($slide);
        }

        $this->messageManager->addSuccessMessage(__('Slide deleted'));

        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
