<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Model\Slide;

use Boxydev\Slider\Model\ResourceModel\Slide\Collection;
use Boxydev\Slider\Model\Slide;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $loadedData = [];

    /**
     * @var Collection $collection
     */
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Collection $collection,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collection;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        $items = $this->collection->getItems();
        /** @var Slide $slide */
        foreach ($items as $slide) {
            $this->loadedData[$slide->getId()] = $slide->getData();
        }

        return $this->loadedData;
    }
}
