<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Model;

use Boxydev\Slider\Model\ResourceModel\Slide as SlideResource;
use Magento\Framework\Model\AbstractModel;

class Slide extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(SlideResource::class);
    }
}
