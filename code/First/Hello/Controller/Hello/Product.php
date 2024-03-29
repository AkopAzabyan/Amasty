<?php

namespace First\Hello\Controller\Hello;

use Exception;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Checkout\Model\Cart;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Data\Form\FormKey;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Helper\Image;

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

    /**
     * @var Image
     */
    private $image;

    public function __construct(
        Image $image,
        JsonFactory $resultJsonFactory,
        CollectionFactory $collectionFactory,
        ManagerInterface $messageManager,
        Context $context,
        FormKey $formKey,
        Cart $cart,
        Http $request,
        ProductRepositoryInterface $productRepository,
        array $data = []
    ) {

        $this->formKey = $formKey;
        $this->cart = $cart;
        $this->request = $request;
        $this->productRepository = $productRepository;
        $this->data = $data;
        $this->messageManager = $messageManager;
        $this->collectionFactory = $collectionFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
        $this->image = $image;
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
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage('Error');
        }
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $res = $this->resultJsonFactory->create();
        $arrayProduct = [];
        if ($this->getRequest()->isAjax()) {
            $getParamSku = $this->getRequest()->getParam('sku');
            $collection = $this->collectionFactory->create()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('sku', ["like" => $getParamSku . "%"]);
            foreach ($collection as $product) {
                $imageUrl = $this->image->init($product, 'product_page_image_medium')->getUrl();
                $product->setImage($imageUrl);
                array_push($arrayProduct, $product->getData());
            }

            return $res->setData($arrayProduct);
        }
        return $this->_pageFactory->create();
    }
}
