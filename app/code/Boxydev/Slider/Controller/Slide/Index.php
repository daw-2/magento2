<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Controller\Slide;

use Boxydev\Slider\Api\SlideRepositoryInterface;
use Boxydev\Slider\Model\SlideFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

class Index extends Action
{
    /**
     * @var SlideRepositoryInterface
     */
    private $slideRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var SlideFactory
     */
    private $slideFactory;

    public function __construct(
        Context $context,
        SlideRepositoryInterface $slideRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SlideFactory $slideFactory
    ) {
        parent::__construct($context);
        $this->slideRepository = $slideRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->slideFactory = $slideFactory;
    }

    public function execute()
    {
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        /* $slide = $this->slideFactory->create();
        $slide->setData(['name' => 'toto', 'image' => 'toto.jpg']);
        $this->slideRepository->save($slide); */

        /* $slide = $this->slideRepository->getById(27);
        dump($slide->getName()); */

        /* $result = $this->slideRepository->getList($this->searchCriteriaBuilder->addFilter('name', 'slide-3', 'eq')->create());
        foreach ($result->getItems() as $item) {
            dump($item->getData());
        } */

        // $this->slideRepository->deleteById(27);

        return $page;
    }
}
