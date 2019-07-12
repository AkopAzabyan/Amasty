<?php
namespace First\Hello\Controller\Hello;

use Magento\Framework\App\Action\Context;
use First\Hello\Helper\Data;

class Config extends \Magento\Framework\App\Action\Action
{

    private $helperData;

    /**
     * Config constructor.
     * @param Context $context
     * @param Data $helperData
     */
    public function __construct(
        Context $context,
        Data $helperData

    ) {
        $this->helperData = $helperData;
        return parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        echo $this->helperData->getGeneralConfig('enable');
        echo $this->helperData->getGeneralConfig('display_text');
        exit();

    }
}