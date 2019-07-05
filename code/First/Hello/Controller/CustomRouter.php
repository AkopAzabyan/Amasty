<?php

namespace First\Hello\Controller;

use First\Hello\Helper\Data;

class CustomRouter implements \Magento\Framework\App\RouterInterface
{

    protected $actionFactory;
    protected $_response;
    protected $data;
    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Magento\Framework\App\ResponseInterface $response,
    Data $data
    ) {
        $this->data = $data;
        $this->actionFactory = $actionFactory;
        $this->_response = $response;
    }
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');

        $url=$this->data->getGeneralConfig('display_text');

        if($identifier == $url && !$request->getParam('isRouteFirstHello')) {
            $request->setModuleName('firsthello')-> //module name
            setControllerName('hello')-> //controller name
            setActionName('world')-> //action name
            setParam('isRouteFirstHello', true); //custom parameters
        } else {
            return false;
        }
        return $this->actionFactory->create(
            'Magento\Framework\App\Action\Forward',
            ['request' => $request]
        );
    }
}