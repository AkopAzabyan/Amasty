<?php

namespace First\Hello\Controller\Hello;

use Magento\Framework\App\Action\Context;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Config;
use Magento\Framework\View\Result\PageFactory;


class World extends \Magento\Framework\App\Action\Action
{
    public $_pageFactory;


    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;

        return parent::__construct($context);
    }


    function execute()
    {
        return $this->_pageFactory->create();
    }

}



