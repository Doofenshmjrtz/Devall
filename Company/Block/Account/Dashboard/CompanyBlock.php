<?php
namespace Devall\Company\Block\Account\Dashboard;

use Devall\Company\Model\Company;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Devall\Company\Api\CompanyRepositoryInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Customer\Api\CustomerRepositoryInterface;

class CompanyBlock extends Template
{
    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $customerRepositoryInterface;

    /**
     * @var CustomerSession
     */
    private CustomerSession $customerSession;

    /**
     * @var CompanyRepositoryInterface
     */
    private CompanyRepositoryInterface $companyRepositoryInterface;

    /**
     * CompanyBlock constructor.
     * @param CustomerSession $customerSession
     * @param CompanyRepositoryInterface $companyRepositoryInterface
     * @param CustomerRepositoryInterface $customerRepositoryInterface
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        CustomerSession $customerSession,
        CompanyRepositoryInterface $companyRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->customerSession = $customerSession;
        $this->companyRepositoryInterface = $companyRepositoryInterface;
    }

    /**
     * @return bool
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function hasCompany(): bool
    {
        $customerId = $this->getCustomerId();
        $customer = $this->customerRepositoryInterface->getById($customerId);
        $companyId = $customer->getCustomAttribute(Company::COMPANY_ATTRIBUTE_CODE);
        return !empty($companyId);
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerSession->getId();
    }

    /**
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getCompany()
    {
        $customerId = $this->getCustomerId();
        $customer = $this->customerRepositoryInterface->getById($customerId);
        $companyId = $customer->getCustomAttribute(Company::COMPANY_ATTRIBUTE_CODE)->getValue();
        return $this->companyRepositoryInterface->getById($companyId);
    }

    /**
     * @return string
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getName(): string
    {
        return $this->getCompany()->getName();
    }

    /**
     * @return string
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getCountry(): string
    {
        return $this->getCompany()->getCountry();
    }

    /**
     * @return string
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getStreet(): string
    {
        return $this->getCompany()->getStreet();
    }

    /**
     * @return int
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getNumber(): int
    {
        return $this->getCompany()->getNumber();
    }

    /**
     * @return string
     */
    public function getCompanyEditUrl(): string
    {
        return $this->getUrl('company/customer/edit/');
    }
}
