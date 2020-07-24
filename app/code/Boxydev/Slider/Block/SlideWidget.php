<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Block;

use Boxydev\Slider\Api\SlideRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class SlideWidget extends Template implements BlockInterface
{
    protected $_template = 'widget/slide.phtml';

    /**
     * @var SlideRepositoryInterface
     */
    private $repository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    public function __construct(
        Template\Context $context,
        SlideRepositoryInterface $repository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        array $data = []
    ) {
        parent::__construct($context);
        $this->repository = $repository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
    }

    public function getSlides()
    {
        $slides = $this->repository->getList(
            $this->searchCriteriaBuilder
                ->addFilter(
                    $this->filterBuilder->create()
                        ->setField('name')
                        ->setValue('test')
                        ->setConditionType('eq')
                )
                ->create()
                ->setPageSize($this->getData('slides'))
        );

        return $slides->getItems();
    }
}
