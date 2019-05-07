<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\MyModule\Test\Integration;

use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Module\ModuleList;
use Magento\TestFramework\ObjectManager;
use PHPUnit\Framework\TestCase;

class MyModuleTest extends TestCase
{
    public function testTheModuleIsRegistered()
    {
        $registrar = new ComponentRegistrar();
        $paths = $registrar->getPaths(ComponentRegistrar::MODULE);
        $this->assertArrayHasKey('Boxydev_MyModule', $paths);
    }

    public function testTheModuleIsKnownAndEnabled()
    {
        $objectManager = ObjectManager::getInstance();
        /** @var ModuleList $moduleList */
        $moduleList = $objectManager->create(ModuleList::class);
        $this->assertTrue($moduleList->has('Boxydev_MyModule'));
    }
}
