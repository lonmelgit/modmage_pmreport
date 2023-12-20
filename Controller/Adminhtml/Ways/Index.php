<?php

namespace ModMage\PmReport\Controller\Adminhtml\Ways;

use ModMage\PmReport\Helper\Config;
use \Magento\Framework\Exception\NoSuchEntityException;
use ModMage\PmReport\Model\ResourceModel\Ways\CollectionFactory;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    protected $config;
    protected $collectionFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context        $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        CollectionFactory                          $collectionFactory,
        Config                                     $config

    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->config = $config;
        $this->collectionFactory = $collectionFactory;
    }


    public function execute()
    {
        if ($this->config->getEnabled()) {
            $resultPage = $this->resultPageFactory->create();
            $resultPage->getConfig()->getTitle()->prepend(__('All records'));
        } else {
            $this->messageManager->addErrorMessage('Please enable module ModMage_PmReport');
            $resultPage = $this->resultRedirectFactory->create();
            return $resultPage->setRefererOrBaseUrl();
        }

        return $resultPage;
    }
}
