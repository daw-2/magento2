<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Setup;

use Boxydev\Slider\Model\ResourceModel\Slide as ResourceSlide;
use Boxydev\Slider\Model\Slide;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.2') < 0) {
            /** @var ResourceSlide $resourceSlide */
            $resourceSlide = $this->objectManager->create(ResourceSlide::class);

            for ($i = 1; $i <= 10; $i++) {
                /** @var Slide $slide */
                $slide = $this->objectManager->create(Slide::class);
                $slide->setData([
                    'name' => 'slide-' . $i,
                    'image' => 'slide-' . $i . '.jpg'
                ]);
                $resourceSlide->save($slide);
            }
        }

        $setup->endSetup();
    }
}
