<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Test\Unit\Model;

use Boxydev\Slider\Model\Slide;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Framework\UrlInterface;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Model\StoreManagerInterface;
use PHPUnit\Framework\TestCase;

class SlideTest extends TestCase
{
    /**
     * @var Slide
     */
    protected $_model;

    protected function setUp()
    {
        $storeInterfaceMock = $this->getMockBuilder(StoreInterface::class)
            ->setMethods(['getBaseUrl'])
            ->getMockForAbstractClass();
        $storeInterfaceMock
            // ->expects($this->once()) // La méthode est appelée une seule fois
            ->method('getBaseUrl')
            ->with(UrlInterface::URL_TYPE_MEDIA)
            ->willReturn('http://localhost/media/');

        $storeManagerMock = $this->createMock(StoreManagerInterface::class);
        $storeManagerMock->method('getStore')->willReturn($storeInterfaceMock);

        $this->_model = (new ObjectManager($this))->getObject(Slide::class, [
            'storeManager' => $storeManagerMock
        ]);
    }

    public function testInstance()
    {
        $this->assertInstanceOf(AbstractModel::class, $this->_model);
    }

    /**
     * @dataProvider slides
     */
    public function testModel($image, $url)
    {
        $this->_model->setImage($image);
        $this->assertSame($url, $this->_model->getImageUrl());
    }

    public function slides()
    {
        return [
            ['chaton.jpg', 'http://localhost/media/boxydev/slide/chaton.jpg'],
            ['titi.jpg', 'http://localhost/media/boxydev/slide/titi.jpg']
        ];
    }
}