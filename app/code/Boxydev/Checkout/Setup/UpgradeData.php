<?php

namespace Boxydev\Checkout\Setup;

use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\ResourceModel\Attribute;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var EavSetup
     */
    private $eavSetup;

    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * @var Attribute
     */
    private $attributeResource;

    public function __construct(EavSetup $eavSetup, Config $eavConfig, Attribute $attributeResource)
    {
        $this->eavSetup = $eavSetup;
        $this->eavConfig = $eavConfig;
        $this->attributeResource = $attributeResource;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.2') < 0) {
            $setup->getConnection()->addColumn(
                $setup->getTable('quote_address'),
                'custom_field',
                [
                    'type' => Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Custom field',
                    'after' => 'fax',
                ]
            );
        }

        if (version_compare($context->getVersion(), '0.0.3') < 0) {
            $this->eavSetup->addAttribute(
                AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
                'custom_field',
                [
                    'label' => 'Custom field',
                    'input' => 'text',
                    'visible' => true,
                    'required' => false,
                    'position' => 150,
                    'user_defined' => true,
                    'system' => false,
                    'group'=> 'General'
                ]
            );

            $attribute = $this->eavConfig->getAttribute(AddressMetadataInterface::ENTITY_TYPE_ADDRESS, 'custom_field');
            $attribute->setData('used_in_forms', [
                'adminhtml_customer_address', 'customer_register_address', 'customer_address_edit', 'checkout_register_address'
            ]);

            $this->attributeResource->save($attribute);
        }

        $setup->endSetup();
    }
}
