<?php
namespace ModMage\PmReport\Model\ResourceModel;

class PaymentHistory extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb{
    public function _construct(){
        $this->_init("payment_history","id");
    }
}
