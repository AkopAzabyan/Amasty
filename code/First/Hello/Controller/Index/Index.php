<?php

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use First\Hello\Model\PostFactory;

namespace First\Hello\Controller\Index;

/**
 * Class Index
 * @package First\Hello\Controller\Index
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var
     */
    private $pageFactory;
    /**
     * @var
     */
    private $postFactory;

    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     * @param \First\Hello\Model\PostFactory $postFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        PostFactory $postFactory
    )
    {
        $this->pageFactory = $pageFactory;
        $this->postFactory = $postFactory;
        return parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $post = $this->_postFactory->create();
        $collection = $post->getCollection();
        foreach ($collection as $item) {
            echo "<pre>";
            print_r($item->getData());
            echo "</pre>";
        }
        exit();
        return $this->_pageFactory->create();
    }
}