<?php
namespace Hoan\Student\Block\Adminhtml\Student\Form\Edit\Tab;

class Main extends \Magento\Backend\Block\Widget\Form\Generic
{
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('student_data');

        // 'data' param was get from main form (form.php)
        $form = $this->_formFactory->create();

        $fieldset = $form->addFieldset(
            'fieldset_1', // fieldset html id
            [
                'legend' => __('Fieldset 1'), // Ui label - <legend>
                'class' => 'fieldset-wide' // html class
            ]
        );

        $fieldset->addField(
            'student_id',
            'hidden',
            [
                'name' => 'student_id',
                'id' => 'student_id'
            ]
        );

        $fieldset->addField(
            'student_name', // database column
            'text', // input type
            [
                'name' => 'student_name', // input name
                'label' => __('Student Name'), // Ui label
                'id' => 'student_name', //
                'title' => __('Student Name'), // html title
                'class' => 'required-entry', // html class
                'required' => true, // required
            ],
            'student_birthday'
        );

        // set pre-defined values for form
        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
