<?php

namespace Hoan\Student\Block\Adminhtml\Student\Form\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('student_data');

        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'enctype' => 'multipart/form-data',
                    'action' => $this->getData('action'),
                    'method' => 'post'
                ]
            ]
        );

        // $form->setHtmlIdPrefix('student_manager_');

        $fieldset = $form->addFieldset(
            'student_details', // fieldset html id
            [
                'legend' => __('Student Data'), // Ui label - <legend>
                'class' => 'fieldset-wide' // html class
            ]
        );

        $fieldset->addField(
            'student_id',
            'hidden',
            [
                'name' => 'student-id',
                'id' => 'student-id-id'
            ]
        );

        $fieldset->addField(
            'student_name', // database column
            'text', // input type
            [
                'name' => 'student-name', // input name
                'label' => __('Student Name'), // Ui label
                'id' => 'student-name-id', //
                'title' => __('Student Name'), // html title
                'class' => 'required-entry', // html class
                'required' => true, // required
            ],
            'student_birthday'
        );

        $fieldset->addField(
            'student_birthday',
            'text',
            [
                'name' => 'student-birthday',
                'label' => __('Student Birthday'),
                'id' => 'student-birthday-id',
                'title' => __('Student Birthday')
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
