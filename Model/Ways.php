<?php

namespace ModMage\PmReport\Model;

use ModMage\PmReport\Api\Data\WaysInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;

class Ways extends AbstractModel implements WaysInterface, IdentityInterface
{

    protected function _construct()
    {
        $this->_init('ModMage\PmReport\Model\ResourceModel\Ways');
    }

    public function getIdentities()
    {
        return [$this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }

    public function getId()
    {
        return parent::getData(self::ID);
    }

    public function getDate()
    {
        return $this->getData(self::DATE);
    }

    public function getPm()
    {
        return $this->getData(self::PM);
    }

    public function getQty()
    {
        return $this->getData(self::QTY);
    }

    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }



    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    public function setDate($date)
    {
        return $this->setData(self::DATE, $date);
    }

    public function setPm($pm)
    {
        return $this->setData(self::PM, $pm);
    }

    public function setQty($qty)
    {
        return $this->setData(self::QTY, $qty);
    }

    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

}
