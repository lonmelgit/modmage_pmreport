<?php
namespace ModMage\PmReport\Model;

class PaymentHistory extends \Magento\Framework\Model\AbstractModel{
    public function _construct(){
        $this->_init("ModMage\PmReport\Model\ResourceModel\PaymentHistory");
    }
}
