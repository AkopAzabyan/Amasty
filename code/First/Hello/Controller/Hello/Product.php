<?php

namespace First\Hello\Controller\Hello;

use Magento\Framework\Message\ManagerInterface;
use Magento\Checkout\Model\Cart;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Data\Form\FormKey;
use Magento\Catalog\Api\ProductRepositoryInterface;



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

    public function __construct(
        ManagerInterface $messageManager,
        Context $context,
        FormKey $formKey,
        Cart $cart,
        Http $request,
        ProductRepositoryInterface $productRepository,
        array $data = [])
    {
        parent::__construct($context);
        $this->formKey = $formKey;
        $this->cart = $cart;
        $this->request = $request;
        $this->productRepository = $productRepository;
        $this->data = $data;
        $this->messageManager = $messageManager;
    }

    public function execute()
    {
        try
        {
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
        }
        catch (\Exception $e){
            $this->messageManager->addErrorMessage('Error');
        }


    }
}
