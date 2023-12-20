<?php

namespace ModMage\PmReport\Model\Ways\Source;

use Magento\Framework\Data\OptionSourceInterface;

class PaymentMethods implements OptionSourceInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'affirm_gateway', 'label' => __('Affirm')],
            ['value' => 'amazon_payment_v2', 'label' => __('Amazon Pay')],
            ['value' => 'paypal_express', 'label' => __('PayPal Express Checkout')],
            ['value' => 'm2epropayment', 'label' => __('M2E Pro Payment')],
            ['value' => 'braintree', 'label' => __('Credit Card (Braintree)')],
            ['value' => 'mageworx_ordereditor_payment_method', 'label' => __('MAGEWORKS')],
            ['value' => 'stripe_payments_express', 'label' => __('Wallet payment via Stripe')],
            ['value' => 'checkmo', 'label' => __('Check / Money order')]
        ];
    }
}
