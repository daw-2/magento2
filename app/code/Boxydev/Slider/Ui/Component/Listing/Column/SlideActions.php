<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class SlideActions extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        return $dataSource;
    }
}