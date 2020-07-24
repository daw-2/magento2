<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Test\Integration;

use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Module\ModuleList;
use Magento\TestFramework\ObjectManager;
use PHPUnit\Framework\TestCase;

class ModuleTest extends TestCase
{
    public function testModuleIsRegistered()
    {
        $registrar = new ComponentRegistrar();

        $this->assertArrayHasKey('Boxydev_Slider', $registrar->getPaths(ComponentRegistrar::MODULE));
    }

    public function testModuleIsEnabled()
    {
        $objectManager = ObjectManager::getInstance();
        $moduleList = $objectManager->create(ModuleList::class);

        $this->assertTrue($moduleList->has('Boxydev_Slider'));
    }
}
