<?php
namespace Devall\Company\Block;

use Devall\Company\Model\Company;
use Devall\Company\Model\ResourceModel\Company\Collection;
use Magento\Framework\Api\AttributeInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Devall\Company\Model\CompanyRepository;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Customer\Api\CustomerRepositoryInterface;

class SelectCompany extends Template
{
    /**
     * @var Collection
     */
    private Collection $collection;
    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $customerRepositoryInterface;
    /**
     * @var CompanyRepository
     */
    private CompanyRepository $companyRepository;
    /**
     * @var CustomerSession
     */
    private CustomerSession $customerSession;


    /**
     * CompanyList constructor.
     * @param CustomerSession $customerSession
     * @param CompanyRepository $companyRepository
     * @param CustomerRepositoryInterface $customerRepositoryInterface
     * @param Template\Context $context
     * @param Collection $collection
     * @param array $data
     */
    public function __construct(
        CustomerSession $customerSession,
        CompanyRepository $companyRepository,
        CustomerRepositoryInterface $customerRepositoryInterface,
        Template\Context $context,
        Collection $collection,
        array $data = []
    ) {
        $this->collection = $collection;
        parent::__construct($context, $data);
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->customerSession = $customerSession;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @return Collection
     */
    public function getCompanies(){
        return $this->collection;
    }

    /**
     * Return the save action Url.
     *
     * @return string
     */
    public function getAction() {
        return $this->getUrl('company/customer/editpost/');
    }

    /**
     * @return int
     */
    public function getCustomerId() {
        return $this->customerSession->getId();
    }

    /**
     * returns company id of current customer or false if company is not assigned yet.
     * @return false|int
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getCurrentCompanyId()
    {
        $companyAttribute = $this->getCompanyAttribute();
        if (!empty($companyAttribute)) {
            return $companyAttribute->getValue();
        }
        return false;
    }

    /**
     * @return Company
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getCompany(){
        $companyId = $this->getCompanyAttribute()->getValue();
        return $this->companyRepository->getById($companyId);
    }

    /**
     * @return AttributeInterface
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getCompanyAttribute(){
        $customerId = $this->getCustomerId();
        $customer = $this->customerRepositoryInterface->getById($customerId);
        return $customer->getCustomAttribute(Company::COMPANY_ATTRIBUTE_CODE);
    }

    /**
     * @return array|Collection[]
     */
    public function getListApi(){
        return $this->companyRepository->getListApi();
    }
}
