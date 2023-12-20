<?php

namespace ModMage\PmReport\Controller\Adminhtml\Ways;

class Delete extends \Magento\Backend\App\Action
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $title = "";
            try {
                $model = $this->_objectManager->create(\ModMage\PmReport\Model\Ways::class);
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();
                $this->messageManager->addSuccess(__('The record has been deleted.'));
                $this->_eventManager->dispatch(
                    'ways_ship_on_delete',
                    ['title' => $title, 'status' => 'success']
                );
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'ways_ship_on_delete',
                    ['title' => $title, 'status' => 'fail']
                );
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }

        $this->messageManager->addError(__('We can\'t find a methods to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
