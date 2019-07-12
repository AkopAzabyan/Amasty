<?php


namespace First\Hello\Model\ResourceModel;

/**
 * Class Collection
 * @package First\Hello\Model\ResourceModel
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'post_id';
    protected $_eventPrefix = 'firsthello_post_collection';
    protected $_eventObject = 'post_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('First\Hello\Model\Post', 'First\Hello\Model\ResourceModel\Post');
    }

}