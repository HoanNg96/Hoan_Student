<?php

namespace Hoan\Student\Block\Adminhtml\Student\Form;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected function _construct()
    {
        $this->_objectId = 'student_id';
        $this->_blockGroup = 'Hoan_Student';
        $this->_controller = 'adminhtml_student_form';
        parent::_construct();
        $this->buttonList->remove('delete');
    }
}
