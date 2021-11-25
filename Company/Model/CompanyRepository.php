<?php

declare(strict_types=1);

namespace Devall\Company\Model;

use Devall\Company\Api\CompanyRepositoryInterface;
use Devall\Company\Api\Data\CompanyInterface;
use Devall\Company\Api\Data\CompanySearchResultInterface;
use Devall\Company\Model\ResourceModel\Company;
use Devall\Company\Model\ResourceModel\Company\Collection;
use Devall\Company\Model\ResourceModel\Company\CollectionFactory;
use Exception;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\AlreadyExistsException;

class CompanyRepository implements CompanyRepositoryInterface
{
    /**
     * @var CompanyFactory
     */
    public CompanyFactory $companyFactory;

    /**
     * @var Company
     */
    public Company $ResourceModel;

    /**
     * @var CollectionFactory
     */
    public CollectionFactory $collectionFactory;

    /**
     * @var Collection
     */
    public Collection $collection;

    /**
     * @var Company
     */
    private Company $companyResourceModel;

    /**
     * @var SearchCriteriaBuilder
     */
    protected SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * CompanyRepository constructor.
     * @param CompanyFactory $companyFactory
     * @param Company $companyResourceModel
     * @param CollectionFactory $collectionFactory
     * @param Collection $collection
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        CompanyFactory $companyFactory,
        Company $companyResourceModel,
        CollectionFactory $collectionFactory,
        Collection $collection,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->collection = $collection;
        $this->companyFactory = $companyFactory;
        $this->companyResourceModel = $companyResourceModel;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getById($id): \Devall\Company\Model\Company
    {
        $company = $this->companyFactory->create();
        $this->companyResourceModel->load($company, $id);
        return $company;
    }

    /**
     * @throws AlreadyExistsException
     */
    public function save(CompanyInterface $company): CompanyInterface
    {
        $this->companyResourceModel->save($company);
        return $company;
    }

    /**
     * @throws Exception
     */
    public function delete(CompanyInterface $company): void
    {
        $this->companyResourceModel->delete($company);
    }

    public function getList(SearchCriteriaInterface $searchCriteria): CompanySearchResultInterface
    {
        $collection = $this->collectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return CompanySearchResultInterface
     */
    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection): CompanySearchResultInterface
    {
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    public function getByIdApi($id): array
    {
        return $this->getById($id)->getData();
    }

    public function getListApi(): array
    {
        return $this->collection->getData();
    }
}
