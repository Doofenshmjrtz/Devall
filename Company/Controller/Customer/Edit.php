<?php


namespace Devall\Company\Controller\Customer;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Action
{
    public function execute()
    {
        return $this->resultFactory->create(resultFactory::TYPE_PAGE);
    }
}
