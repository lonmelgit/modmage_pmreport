<?php

namespace ModMage\PmReport\Model\ResourceModel\Ways;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    protected $_eventPrefix = 'payment_history_collection';

    protected $_eventObject = 'ways_collection';

    public function _construct()
    {
        $this->_init(
            'ModMage\PmReport\Model\Ways',
            'ModMage\PmReport\Model\ResourceModel\Ways'
        );
    }
}
