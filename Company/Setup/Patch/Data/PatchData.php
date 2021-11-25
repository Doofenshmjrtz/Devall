<?php
namespace Devall\Company\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Devall\Company\Model\CompanyFactory;
Use Devall\Company\Model\ResourceModel\Company as CompanyResourceModel;


class PatchData implements DataPatchInterface, PatchVersionInterface
{
    public CompanyFactory $companyFactory;
    public CompanyResourceModel $companyResourceModel;
    public ModuleDataSetupInterface $moduleDataSetup;
    public function __construct(
        CompanyFactory $companyFactory,
        CompanyResourceModel $companyResourceModel,
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->companyFactory = $companyFactory;
        $this->companyResourceModel = $companyResourceModel;
        $this->moduleDataSetup=$moduleDataSetup;
    }
    public function apply()
    {
        //Install data row into contact_details table
        $this->moduleDataSetup->startSetup();
        $company = $this->companyFactory->create();
        $company->setName('Company N4');
        $company->setSize('17');
        $company->setCountry('Georgia');
        $company->setStreet('Betlemi Street');
        $company->setNumber('69');
        $this->companyResourceModel->save($company);
        $this->moduleDataSetup->endSetup();
    }
    public static function getDependencies()
    {
        return [];
    }
    public static function getVersion()
    {
        return '1.0.1';
    }
    public function getAliases()

    {
        return [];
    }
}
