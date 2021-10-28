<?php

namespace Devall\Company\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface CompanySearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Devall\Company\Api\Data\CompanyInterface[]
     */
    public function getItems(): array;

    /**
     * @param \Devall\Company\Api\Data\CompanyInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
