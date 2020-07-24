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
use Magento\Backend\App\Action;

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
        Action\Context $context,
        SlideFactory $slideFactory,
        ResourceSlide $resourceSlide
    ) {
        parent::__construct($context);
        $this->slideFactory = $slideFactory;
        $this->resourceSlide = $resourceSlide;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            $slide = $this->slideFactory->create();
            $this->resourceSlide->load($slide, $id);
            try {
                $this->resourceSlide->delete($slide);
                $this->messageManager->addSuccessMessage(__('Slide deleted'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }

        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
