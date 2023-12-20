<?php
namespace ModMage\PmReport\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;

class Ways extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('payment_history', 'id');
    }
}
