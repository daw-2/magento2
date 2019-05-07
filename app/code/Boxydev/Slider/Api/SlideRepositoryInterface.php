<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Api;

use Boxydev\Slider\Api\Data\SlideInterface;
use Magento\Framework\Api\Search\SearchCriteriaInterface;

interface SlideRepositoryInterface
{
    public function save(SlideInterface $slide);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(SlideInterface $slide);

    public function deleteById($id);
}
