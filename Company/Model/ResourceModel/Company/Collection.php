<?php

namespace Devall\Company\Model\ResourceModel\Company;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use \Devall\Company\Model\Company;
use Devall\Company\Model\ResourceModel\Company as CompanyResourceModel;

class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Company::class, CompanyResourceModel::class);
    }
}

