<?php

namespace ModMage\PmReport\Controller\Adminhtml\Ways;

use Magento\Backend\App\Action;
use ModMage\PmReport\Model\Ways;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    private $waysFactory;

    private $waysRepository;


    public function __construct(
        \Magento\Backend\Model\Auth\Session           $authSession,
        Action\Context                                $context,
        DataPersistorInterface                        $dataPersistor,
        \ModMage\PmReport\Model\WaysFactory           $waysFactory = null,
        \ModMage\PmReport\Api\WaysRepositoryInterface $waysRepository = null
    )
    {
        $this->authSession = $authSession;
        $this->dataPersistor = $dataPersistor;
        $this->waysFactory = $waysFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\ModMage\PmReport\Model\WaysFactory::class);
        $this->waysRepository = $waysRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\ModMage\PmReport\Api\WaysRepositoryInterface::class);
        parent::__construct($context);
    }


    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (empty($data['id'])) {
                $data['id'] = null;
            }

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                try {
                    $model = $this->waysRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This record no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }
            $model = $this->waysFactory->create();

            $model->setData($data);

            $this->_eventManager->dispatch(
                'payment_history_prepare_save',
                ['ways' => $model, 'request' => $this->getRequest()]
            );

            try {
                $this->waysRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the record.'));
                $this->dataPersistor->clear('payment_history');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the record.'));
            }

            $this->dataPersistor->set('payment_history', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
