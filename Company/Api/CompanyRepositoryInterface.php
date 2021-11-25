<?php

namespace Devall\Company\Api;

interface CompanyRepositoryInterface
{
    public function getById($id);

    public function save(\Devall\Company\Api\Data\CompanyInterface $company);

    public function delete(\Devall\Company\API\Data\CompanyInterface $company);

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}

