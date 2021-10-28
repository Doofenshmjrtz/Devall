<?php
namespace Devall\Company\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface CompanyInterface extends ExtensibleDataInterface
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const COUNTRY = 'country';
    const STREET = 'street';
    const NUMBER = 'street_number';
    const COMPANY_SIZE = 'size';

    public function setEntityId($id);

    public function getEntityId();

    public function setName($name);

    public function getName();

    public function setCountry($country);

    public function getCountry();

    public function setStreet($street);

    public function getStreet();

    public function setNumber($number);

    public function getNumber();

    public function setSize($size);

    public function getSize();
}


