<?php

namespace Hoan\Student\Block\Adminhtml\Student\Form\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    // for upload file
                    'enctype' => 'multipart/form-data',
                    'action' => $this->getData('action'),
                    'method' => 'post'
                ]
            ]
        );

        // use <form> tag to wrap fieldset, fields
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
