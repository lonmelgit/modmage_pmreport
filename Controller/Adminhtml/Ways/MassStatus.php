<?php

namespace ModMage\PmReport\Controller\Adminhtml\Ways;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use ModMage\PmReport\Model\ResourceModel\Ways\CollectionFactory;

class MassStatus extends \Magento\Backend\App\Action
{
    protected $filter;
    protected $collectionFactory;

    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        $changeStatus = 0;
        $status = $this->getRequest()->getParam("is_active");
        foreach ($collection as $ways) {
            $ways->setStatus($status)->save();
            $changeStatus++;
        }

        if ($changeStatus) {
            $this->messageManager->addSuccess(__('A total of %1 record(s) were updated.', $changeStatus));
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
