<?php

namespace First\Hello\Controller\Hello;

use Magento\Framework\App\Action\Context;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Config;
use Magento\Framework\View\Result\PageFactory;
use First\Hello\Model\CsvImportHandler;


class World extends \Magento\Framework\App\Action\Action
{
    public $_pageFactory;
    public $csvImportHandler;

    public function __construct(
        CsvImportHandler $csvImportHandler,
        Context $context,
        PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->csvImportHandler = $csvImportHandler;
        return parent::__construct($context);
    }

    function execute()
    {
        $this->csvImportHandler->importFromCsvFile();
        return $this->_pageFactory->create();
    }

}



