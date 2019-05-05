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
use Boxydev\Slider\Model\Slide;
use Boxydev\Slider\Model\SlideFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Action
{
    /**
     * @var SlideFactory
     */
    private $slideFactory;

    /**
     * @var ResourceSlide
     */
    private $resourceSlide;

    public const ADMIN_RESOURCE = 'Boxydev_Slider::slide_save';

    public function __construct(
        Action\Context $context,
        SlideFactory $slideFactory,
        ResourceSlide $resourceSlide
    ) {
        parent::__construct($context);
        $this->slideFactory = $slideFactory;
        $this->resourceSlide = $resourceSlide;
    }

    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Boxydev_Slider::head');

        $slideData = $this->getRequest()->getPostValue();

        if ($slideData) {
            /** @var Slide $slide */
            $slide = $this->slideFactory->create();

            if ($id = $this->getRequest()->getParam('id')) {
                $this->resourceSlide->load($slide, $id);
            }

            $slide->addData([
                'name' => $slideData['name'],
                'image' => $slideData['image']
            ]);

            $this->resourceSlide->save($slide);

            $this->messageManager->addSuccessMessage(__('Success'));

            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }

        return $resultPage;
    }
}
