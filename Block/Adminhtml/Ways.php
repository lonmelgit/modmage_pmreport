<?php
namespace ModMage\PmReport\Block\Adminhtml;

class Ways extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_ways';
        $this->_blockGroup = 'ModMage_PmReport';
        $this->_headerText = __('Manage payment methods history changes');

        parent::_construct();

        if ($this->_isAllowedAction('ModMage_PmReport::save')) {
            $this->buttonList->update('add', 'label', __('Add Names'));
        } else {
            $this->buttonList->remove('add');
        }
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
