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

use Boxydev\Slider\Model\ResourceModel\Slide\Collection;
use Boxydev\Slider\Model\ResourceModel\Slide\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class SlideWidget extends Template implements BlockInterface
{
    protected $_template = 'widget/slide.phtml';

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
    }

    public function getSlides()
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection->setPageSize($this->getData('slides'));

        return $collection;
    }
}
