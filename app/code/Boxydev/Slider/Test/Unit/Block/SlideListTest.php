<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Test\Unit\Block;

use Boxydev\Slider\Block\SlideList;
use Boxydev\Slider\Helper\Data;
use Boxydev\Slider\Model\ResourceModel\Slide\Collection;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Framework\View\Element\BlockInterface;
use PHPUnit\Framework\TestCase;

class SlideListTest extends TestCase
{
    /**
     * @var SlideList
     */
    protected $_block;

    /**
     * @var Collection
     */
    protected $collectionMock;

    /**
     * @var Data
     */
    protected $helperBlock;

    protected function setUp()
    {
        $this->collectionMock = $this->getMockBuilder(Collection::class)
            ->setMethods(['addFieldToFilter'])
            ->disableOriginalConstructor()
            ->getMock();
        $this->collectionMock->method('addFieldToFilter')->willReturn($this->collectionMock);

        $this->helperBlock = $this->getMockBuilder(Data::class)
            ->setMethods(['getConfig'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->_block = (new ObjectManager($this))->getObject(SlideList::class, [
            'collection' => $this->collectionMock,
            'helper' => $this->helperBlock
        ]);
    }

    public function testInstance()
    {
        $this->assertInstanceOf(BlockInterface::class, $this->_block);
    }

    public function testCollection()
    {
        $this->helperBlock->method('getConfig')->willReturn(5);
        $this->assertSame(5, $this->_block->getSlides()->getPageSize());
    }
}
