<?php

namespace Boxydev\Learn\Block;

use Magento\Framework\View\Element\Template;

class Hello extends Template
{
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);

        $this->setA(1);
        $this->setB(2);
    }
}
