<?php

namespace First\Hello\Plugin;

use First\Hello\Controller\Hello\Product;

class PluginCart
{
    /**
     * @var Product
     */
    private $product;

    /**
     * PluginCart constructor.
     * @param Product $product
     */
    public function __construct(
        Product $product
    )
    {

        $this->product = $product;
    }

    /**
     * @param \Magento\Checkout\Controller\Cart\Add $subject
     * @return array
     */
    public function beforeExecute(\Magento\Checkout\Controller\Cart\Add $subject)
    {
        $this->product->addToCart();
        return [];
    }
}

