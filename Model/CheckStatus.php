<?php

namespace ModMage\PmReport\Model;

use Magento\Framework\App\Helper\Context;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use ModMage\PmReport\Helper\Config;

class CheckStatus
{
    protected $paymentHistory;
    protected $backendHelper;
    protected $collectionFactory;
    protected $config;
    protected $logger;


    public function __construct(
        Context                                       $context,
        \ModMage\PmReport\Model\PaymentHistoryFactory $paymentHistory,
        \Magento\Backend\Helper\Data                  $backendHelper,
        CollectionFactory                             $collectionFactory,
        Config                                        $config,
    )
    {
        $this->paymentHistory = $paymentHistory;
        $this->backendHelper = $backendHelper;
        $this->collectionFactory = $collectionFactory;
        $this->config = $config;
        $this->logger = $context->getLogger();
    }

    public function checkStatus()
    {
        $period = $this->config->getPeriodForOrderCollection();
        $from = date('Y-m-d H:i:s', time() - (3600 * $period));
        $to = date('Y-m-d H:i:s');

        $orders = $this->collectionFactory->create()
            ->addAttributeToFilter('created_at', array('from' => $from, 'to' => $to));

        $qtyArray = [];
        $qtyAffirm = 0;
        $qtyAmazon = 0;
        $qtyPaypal = 0;
        $qtyM2epropayment = 0;
        $qtyBraintree = 0;
        $qtyMageWorx = 0;
        $qtyStripe = 0;
        $qtyCheck = 0;


        foreach ($orders as $order) {
            $payment = $order->getPayment();
            $methodCode = $payment->getMethod();

            if ($methodCode == "affirm_gateway" && $this->config->getAffirm() == !null) {
                $qtyAffirm++;
                $qtyArray['affirm_gateway'] = $qtyAffirm;
            }

            if ($methodCode == "amazon_payment_v2" && $this->config->getAmazon() == !null) {
                $qtyAmazon++;
                $qtyArray['amazon_payment_v2'] = $qtyAmazon;
            }

            if ($methodCode == "paypal_express" && $this->config->getPayPal() == !null) {
                $qtyPaypal++;
                $qtyArray['paypal_express'] = $qtyPaypal;
            }

            if ($methodCode == "m2epropayment" && $this->config->getM2epropayment() == !null) {
                $qtyM2epropayment++;
                $qtyArray['m2epropayment'] = $qtyM2epropayment;
            }

            if ($methodCode == "braintree" && $this->config->getBraintree() == !null) {
                $qtyBraintree++;
                $qtyArray['braintree'] = $qtyBraintree;
            }

            if ($methodCode == "mageworx_ordereditor_payment_method" && $this->config->getMageWorks() == !null) {
                $qtyMageWorx++;
                $qtyArray['mageworx_ordereditor_payment_method'] = $qtyMageWorx;
            }

            if ($methodCode == "stripe_payments_express" && $this->config->getStripe() == !null) {
                $qtyStripe++;
                $qtyArray['stripe_payments_express'] = $qtyStripe;
            }

            if ($methodCode == "checkmo" && $this->config->getCheckMoney() == !null) {
                $qtyCheck++;
                $qtyArray['checkmo'] = $qtyCheck;
            }
        }

        foreach ($qtyArray as $key => $qty) {

            $setQty = 0;
            switch ($key) {
                case "affirm_gateway":
                    $setQty = $this->config->getAffirm();
                    break;
                case "amazon_payment_v2":
                    $setQty = $this->config->getAmazon();
                    break;
                case "paypal_express":
                    $setQty = $this->config->getPayPal();
                    break;
                case "m2epropayment":
                    $setQty = $this->config->getM2epropayment();
                    break;
                case "braintree":
                    $setQty = $this->config->getBraintree();
                    break;
                case "mageworx_ordereditor_payment_method":
                    $setQty = $this->config->getMageWorks();
                    break;
                case "stripe_payments_express":
                    $setQty = $this->config->getStripe();
                    break;
                case "checkmo":
                    $setQty = $this->config->getCheckMoney();
                    break;
            }

            if ($setQty > $qty) {
                $status = "warning";
            } else {
                $status = "ok";
            }

            try {
                $model = $this->paymentHistory->create();

                $model->addData([
                    "date" => $from,
                    "pm" => $key,
                    "qty" => $qty,
                    "status" => $status
                ]);
                $model->save();
            } catch (\Exception $e) {
                $this->logger->error($e);
            }
        }
    }
}
