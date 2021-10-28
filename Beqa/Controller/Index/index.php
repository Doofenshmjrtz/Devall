<?php


namespace Devall\Beqa\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class index extends Action
{
    public function execute()
    {
        $page = $this->resultFactory->create(resultFactory::TYPE_PAGE);
        $block = $page->getLayout()->getBlock('devall.beqa.layout.template');
        $block->setData("passedFromController", "This string is passed from the Controller");
        return $page;
    }
}
