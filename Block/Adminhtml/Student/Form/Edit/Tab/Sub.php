<?php
namespace Hoan\Student\Block\Adminhtml\Student\Form\Edit\Tab;

class Sub extends \Magento\Backend\Block\Widget\Form\Generic
{
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('student_data');

        $form = $this->_formFactory->create();

        $fieldset = $form->addFieldset(
            'fieldset_2', // fieldset html id
            [
                'legend' => __('Fieldset 2'), // Ui label - <legend>
                'class' => 'fieldset-wide' // html class
            ]
        );

        $fieldset->addField(
            'student_birthday',
            'date',
            [
                'name' => 'student_birthday',
                'label' => __('Student Birthday'),
                'id' => 'student_birthday',
                'title' => __('Student Birthday'),
                'date_format' => 'dd-MM-y',
            ]
        );

        // set pre-defined values for form
        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
