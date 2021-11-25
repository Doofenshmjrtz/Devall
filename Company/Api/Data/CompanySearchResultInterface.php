<?php

namespace Devall\Company\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface CompanySearchResultInterface extends SearchResultsInterface
{
    /**
     * @return CompanyInterface[]
     */
    public function getItems(): array;

    /**
     * @param CompanyInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
