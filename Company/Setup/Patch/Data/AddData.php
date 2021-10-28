<?php

namespace Devall\Company\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddData implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {
        /**
         * Install product link types
         */
        $data = [
            ['name' => 'Company N1', 'country' => 'Latvia', 'street' => 'Shandor Petephi St.', 'street_number' => '42', 'size' => '9'],
            ['name' => 'Company N2', 'country' => 'USA', 'street' => 'Santa Maria St.', 'street_number' => '10', 'size' => '50'],
            ['name' => 'Company N3', 'country' => 'Georgia', 'street' => 'Chavchavadze St.', 'street_number' => '16', 'size' => '29'],
        ];

        foreach ($data as $bind) {
            $this->moduleDataSetup->getConnection()->insertForce(
                $this->moduleDataSetup->getTable(
                    'company'
                ),
                $bind
            );
        }

        /**
         * install product link attributes
         */
//        $data = [
//            [
//                'link_type_id' => \XXX\YYY\Model\Catalog\Product\Link::LINK_TYPE_COLORVARIANT,
//                'product_link_attribute_code' => 'position',
//                'data_type' => 'int',
//            ]
//        ];
//
//        $this->moduleDataSetup->getConnection()->insertMultiple(
//            $this->moduleDataSetup->getTable('catalog_product_link_attribute'),
//            $data
//        );
    }

    public function getAliases()
    {
        return [];
    }

    public static function getDependencies()
    {
        return [];
    }
}
