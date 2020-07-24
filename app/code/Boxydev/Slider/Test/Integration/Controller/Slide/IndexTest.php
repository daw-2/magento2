<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Test\Integration\Controller\Slide;

use Magento\TestFramework\TestCase\AbstractController;

class IndexTest extends AbstractController
{
    public function testPageIsDisplayed()
    {
        $this->dispatch('boxydev/slide');

        $this->assertSame(200, $this->getResponse()->getStatusCode());
    }

    public function testPageHasATitle()
    {
        $this->dispatch('boxydev/slide');

        dump($this->getResponse());
    }
}
