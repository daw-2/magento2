<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\MyModule\Test\Integration\Controller;

use Magento\TestFramework\TestCase\AbstractController;

class IndexTest extends AbstractController
{
    public function testPageIsDisplayed()
    {
        $this->dispatch('boxydev/thing');

        $this->assertSame(200, $this->getResponse()->getStatusCode());
    }
}
