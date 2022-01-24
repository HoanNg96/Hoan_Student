<?php

namespace Hoan\Student\Block\Adminhtml\Student\Form\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('student_widget_form_tabs');
        // form id (form.php)
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Student Edit Tabs'));
    }

    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'main',
            [
                'label' => __('Main Tab'),
                // html attribute
                'title' => __('main'),
                // call to child block (by alias in layout xml file)
                'content' => $this->getChildHtml('main'),
                'active' => true
            ]
        );
        $this->addTab(
            'labels',
            [
                'label' => __('Sub Tab'),
                'title' => __('sub'),
                'content' => $this->getChildHtml('sub')
            ]
        );

        return parent::_beforeToHtml();
    }
}
