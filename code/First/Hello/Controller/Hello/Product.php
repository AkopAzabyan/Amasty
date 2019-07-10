<?php

namespace First\Hello\Controller\Hello;

use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Checkout\Model\Cart;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Data\Form\FormKey;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;


class Product extends \Magento\Framework\App\Action\Action
{

    /**
     * @var FormKey
     */
    private $formKey;

    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var Http
     */
    private $request;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var array
     */
    private $data;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;

    public function __construct(
        JsonFactory $resultJsonFactory,
        CollectionFactory $collectionFactory,
        ManagerInterface $messageManager,
        Context $context,
        FormKey $formKey,
        Cart $cart,
        Http $request,
        ProductRepositoryInterface $productRepository,
        array $data = [])
    {

        $this->formKey = $formKey;
        $this->cart = $cart;
        $this->request = $request;
        $this->productRepository = $productRepository;
        $this->data = $data;
        $this->messageManager = $messageManager;
        $this->collectionFactory = $collectionFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function addToCart()
    {
        try {
            $sku = $this->request->getPost('sku');
            $product = $this->productRepository->get($sku);
            $productId = $product->getId();
            $params = array(
                'form_key' => $this->formKey->getFormKey(),
                'product' => $productId,
                'qty' => 1
            );
            //$product = $this->product->load($productId);
            $this->cart->addProduct($product, $params);
            $this->cart->save();
            $this->messageManager->addSuccessMessage('Sucessfull!');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Error');
        }


    }

    public function getCollection($sku)
    {
        $productCollection = $this->collectionFactory->create();
        $productCollection->addAttributeToSelect('*');
        /*$productCollection->addFieldToFilter('sku', ['like' => '%' . $sku . "%"]);
        return $productCollection;*/
        $productCollection->setPageSize(3);
        return $productCollection;
    }

    public function execute()
    {
        /* $res = $this->resultJsonFactory->create();
         if (isset($this->getRequest()->getParam('sku'))) {
             $getParamSku = $this->getRequest()->getParam('sku');
             $collection = $this->getCollection('sku');
         }*/
        return $this->_pageFactory->create();

    }
}
