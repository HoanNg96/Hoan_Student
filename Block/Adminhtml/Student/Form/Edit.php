<?php

namespace Hoan\Student\Block\Adminhtml\Student\Form;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected function _construct()
    {
        $this->_objectId = 'student_id';
        // module name
        $this->_blockGroup = 'Hoan_Student';
        // namespace separated by "_"
        $this->_controller = 'adminhtml_student_form';
        parent::_construct();

        // $this->addButton(
        //     'continute',
        //     [
        //         'label' => __('Save & Continute'),
        //         'class' => 'save',
        //         'data_attribute' => [
        //             'mage-init' => ['button' => ['event' => 'saveAndContinue', 'target' => '#edit_form']]
        //         ]
        //     ],
        //     1
        // );
    }

    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/listing/');
    }

    /**
     * Get URL for delete button.
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/listing/delete', [$this->_objectId => (int)$this->getRequest()->getParam($this->_objectId)]);
    }
}
