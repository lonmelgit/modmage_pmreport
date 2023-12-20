<?php

namespace ModMage\PmReport\Cron;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Module\Manager;
use ModMage\PmReport\Model\CheckStatus;

class Run
{
    private $moduleManager;

    public function __construct(Manager $moduleManager)
    {
        $this->moduleManager = $moduleManager;
    }

    public function execute()
    {
        $moduleManager = $this->moduleManager;

        if ($moduleManager->isEnabled('ModMage_PmReport')) {
            $checkStatus = ObjectManager::getInstance()->get(CheckStatus::class);
            $checkStatus->checkStatus();
        }
    }
}
