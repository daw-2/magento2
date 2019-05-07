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
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\TestFramework\ObjectManager;
use PHPUnit\Framework\TestCase;

class ThingTest extends TestCase
{
    /**
     * @var \Boxydev\MyModule\Model\Thing
     */
    protected $_model;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->_model = $objectManager->getObject(Thing::class);
    }

    public function testModel()
    {
        $this->assertInstanceOf(AbstractModel::class, $this->_model);
        $this->assertSame('toto', $this->_model->getName());
    }
}
