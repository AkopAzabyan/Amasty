<?php

namespace First\Hello\Controller;

use First\Hello\Helper\Data;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ResponseInterface;

class CustomRouter implements \Magento\Framework\App\RouterInterface
{

    /**
     * @var ActionFactory
     */
    private $actionFactory;
    /**
     * @var ResponseInterface
     */
    private $response;
    /**
     * @var Data
     */
    private $data;

    /**
     * CustomRouter constructor.
     * @param ActionFactory $actionFactory
     * @param ResponseInterface $response
     * @param Data $data
     */
    public function __construct(
        ActionFactory $actionFactory,
        ResponseInterface $response,
        Data $data
    )
    {

        $this->actionFactory = $actionFactory;
        $this->response = $response;
        $this->data = $data;
    }

    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');

        $url = $this->data->getGeneralConfig('display_text');

        if ($identifier == $url && !$request->getParam('isRouteFirstHello')) {
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