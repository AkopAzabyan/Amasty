<?php
namespace First\Hello\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Context;

class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Post constructor.
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('firsthello_post', 'post_id');
    }
}