<?php

namespace ModMage\PmReport\Model\System\Message;

use Magento\Framework\Notification\MessageInterface;
use ModMage\PmReport\Model\ResourceModel\Ways\CollectionFactory;
use ModMage\PmReport\Helper\Config;

class PaymentChangeNotification implements MessageInterface
{
    protected $urlInterface;
    protected $collectionFactory;
    protected $config;

    public function __construct(
        \Magento\Framework\UrlInterface $urlInterface,
        CollectionFactory               $collectionFactory,
        Config                          $config
    )
    {
        $this->urlInterface = $urlInterface;
        $this->collectionFactory = $collectionFactory;
        $this->config = $config;
    }

    const MESSAGE_IDENTITY = 'custom_system_notification';

    public function getIdentity()
    {
        return self::MESSAGE_IDENTITY;
    }

    public function isDisplayed()
    {
        $setDays = $this->config->getNotificationDays();
        $from = date('Y-m-d H:i:s', time() - (3600 * 24 * $setDays));
        $to = date('Y-m-d H:i:s');

        $collection = $this->collectionFactory->create()
            ->addFieldToSelect('*')
            ->addFieldToFilter('date', array('from' => $from, 'to' => $to));

        foreach ($collection as $item) {
            $warning = $item->getStatus();
            if ($warning == 'warning') {
                return true;
            }
        }
        // return true will show the system notification, here you have to check your condition to display notification and base on that return true or false
        return false;
    }

    public function getText()
    {
        return __('Warning! The number of methods is less than set in config. ' . 'Qty of warnings - ' . $this->getQtyOfItems() . ' <a href="' . $this->urlInterface->getUrl('payment_history/ways/index', ['_current' => true]) . '">Link on report</a>');
    }

    public function getSeverity()
    {
        return self::SEVERITY_NOTICE;
    }

    public function getQtyOfItems()
    {
        $setDays = $this->config->getNotificationDays();
        $from = date('Y-m-d H:i:s', time() - (3600 * 24 * $setDays));
        $to = date('Y-m-d H:i:s');

        $collection = $this->collectionFactory->create()
            ->addFieldToSelect('*')
            ->addFieldToFilter('date', array('from' => $from, 'to' => $to));
        $qty = 0;
        foreach ($collection as $item) {
            $warning = $item->getStatus();
            if ($warning == 'warning') {
                $qty++;
            }
        }
        return $qty;
    }
}
