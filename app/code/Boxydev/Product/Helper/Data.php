<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Product\Helper;

class Data extends \Magento\Catalog\Helper\Data
{
    public function getProduct()
    {
        // echo 'I\'m an override'; die();

        return parent::getProduct();
    }
}
