<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\MyModule\Test\Unit\Model;

use Boxydev\MyModule\Model\Thing;
use Magento\Framework\Model\AbstractModel;
use PHPUnit\Framework\TestCase;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

class ThingTest extends TestCase
{
    protected $_model;

    protected function setUp()
    {
        $this->_model = (new ObjectManager($this))->getObject(Thing::class);
    }

    public function testModel()
    {
        $this->assertInstanceOf(AbstractModel::class, $this->_model);
    }
}
