<?php

namespace First\Hello\Plugin;

use First\Hello\Controller\Hello\Product;

class PluginCart
{
    public $product;

    public function __construct(
        Product $product
    )
    {
        $this->product = $product;
    }

    public function beforeExecute(\Magento\Checkout\Controller\Cart\Add $subject)
    {
        $this->product->addToCart();
        return [];
    }
}

