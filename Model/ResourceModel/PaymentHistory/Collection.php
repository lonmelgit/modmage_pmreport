<?php
namespace ModMage\PmReport\Model\ResourceModel\PaymentHistory;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
    public function _construct(){
        $this->_init("ModMage\PmReport\Model\PaymentHistory","ModMage\PmReport\Model\ResourceModel\PaymentHistory");
    }

}
