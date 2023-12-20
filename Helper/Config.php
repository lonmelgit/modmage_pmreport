<?php

namespace ModMage\PmReport\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    const EXTENSION_KEY = 'payment_history_config';
    const EXTENSION_ENABLED = 'general/enabled';
    const AFFIRM = 'methods/affirm_gateway';
    const AMAZON = 'methods/amazon_payment_v2';
    const PAY_PAL = 'methods/paypal_express';
    const M2EPROPAYMENT = 'methods/m2epropayment';
    const BRAINTREE = 'methods/braintree';
    const MAGEWORKS = 'methods/mageworx_ordereditor_payment_method';
    const STRIPE = 'methods/stripe_payments_express';
    const CHECKMONEY = 'methods/checkmo';
    const NOTIFICATION = 'general/notification';
    const PERIOD = 'general/period';


    public function getConfig($key, $store = null)
    {
        return $this->scopeConfig->getValue(self::EXTENSION_KEY . '/' . $key, ScopeInterface::SCOPE_STORE, $store);
    }

    public function getEnabled($store = null)
    {
        return $this->getConfig(self::EXTENSION_ENABLED, $store);
    }

    public function getAffirm($store = null)
    {
        return $this->getConfig(self::AFFIRM, $store);
    }

    public function getAmazon($store = null)
    {
        return $this->getConfig(self::AMAZON, $store);
    }

    public function getPayPal($store = null)
    {
        return $this->getConfig(self::PAY_PAL, $store);
    }

    public function getM2epropayment($store = null)
    {
        return $this->getConfig(self::M2EPROPAYMENT, $store);
    }

    public function getBraintree($store = null)
    {
        return $this->getConfig(self::BRAINTREE, $store);
    }

    public function getMageWorks($store = null)
    {
        return $this->getConfig(self::MAGEWORKS, $store);
    }

    public function getStripe($store = null)
    {
        return $this->getConfig(self::STRIPE, $store);
    }

    public function getCheckMoney($store = null)
    {
        return $this->getConfig(self::CHECKMONEY, $store);
    }

    public function getNotificationDays($store = null)
    {
        return $this->getConfig(self::NOTIFICATION, $store);
    }

    public function getPeriodForOrderCollection($store = null)
    {
        return $this->getConfig(self::PERIOD, $store);
    }
}
