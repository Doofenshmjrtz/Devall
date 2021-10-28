<?php


namespace Devall\Beqa\view\ViewModel;


use Magento\Framework\View\Element\Block\ArgumentInterface;

class ViewModel implements ArgumentInterface
{
    public function pass($string): string
    {
        return $string;
    }
}
