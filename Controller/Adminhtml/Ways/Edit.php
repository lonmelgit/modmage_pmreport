<?php

namespace ModMage\PmReport\Controller\Adminhtml\Ways;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action
{

    protected $_coreRegistry;

    protected $resultPageFactory;


    public function __construct(
        Action\Context                             $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry                $registry
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create(\ModMage\PmReport\Model\Ways::class);

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This methods no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('payment_history', $model);


        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit payment history record') : __('Add payment history record'),
            $id ? __('Edit payment history record') : __('Add payment history record')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Payment history records'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('Add  payment history record'));

        return $resultPage;
    }


    protected function _initAction()
    {

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('ModMage_PmReport::payment_history')
            ->addBreadcrumb(__('Payment history records'), __('Payment history records'))
            ->addBreadcrumb(__('Manage payment history records'), __('Manage payment history records'));
        return $resultPage;
    }
}
