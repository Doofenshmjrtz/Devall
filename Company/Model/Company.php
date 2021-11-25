<?php

namespace Devall\Company\Model;

use Devall\Company\Api\Data\CompanyInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class Company extends AbstractExtensibleModel implements CompanyInterface
{
    /**
     * Customer attribute code
     */
    const COMPANY_ATTRIBUTE_CODE = 'customer_pan_number';

    protected function _construct()
    {
        $this->_init(ResourceModel\Company:: class);
    }

    /**
     * @inheritdoc
     */
    public function getEntityId()
    {
        return $this->_getData(self::ENTITY_ID);
    }

    /**
     * @inheritdoc
     */
    public function setEntityId($id)
    {
        $this->setData(self::ENTITY_ID, $id);
    }

    public function getName(): string
    {
        return $this->_getData(self::NAME);
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * @inheritdoc
     */
    public function getCountry()
    {
        return $this->_getData(self::COUNTRY);
    }

    /**
     * @inheritdoc
     */
    public function setCountry($country)
    {
        $this->setData(self::COUNTRY, $country);
    }

    /**
     * @inheritdoc
     */
    public function getStreet()
    {
        return $this->_getData(self::STREET);
    }

    /**
     * @inheritdoc
     */
    public function setStreet($street)
    {
        $this->setData(self::STREET, $street);
    }

    /**
     * @inheritdoc
     */
    public function getNumber()
    {
        return $this->_getData(self::NUMBER);
    }

    /**
     * @inheritdoc
     */
    public function setNumber($number)
    {
        $this->setData(self::NUMBER, $number);
    }

    /**
     * @inheritdoc
     */
    public function getSize()
    {
        return $this->_getData(self::COMPANY_SIZE);
    }

    /**
     * @inheritdoc
     */
    public function setSize($size)
    {
        $this->setData(self::COMPANY_SIZE, $size);
    }

}
