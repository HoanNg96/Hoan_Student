<?php

namespace Hoan\Student\Controller\Adminhtml\Form;

class Edit extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Hoan_Student::edit';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Hoan\Student\Model\StudentFactory
     */
    private $studentFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Hoan\Student\Model\StudentFactory $studentFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->studentFactory = $studentFactory;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $studentId = $this->getRequest()->getParam('student_id');
        /** @var $student \Hoan\Student\Model\Student */
        $student = $this->studentFactory->create();

        if ($studentId) {
            $student->load($studentId);
            if (!$student->getStudentId()) {
                $this->messageManager->addErrorMessage(__('This student no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/listing/');
            }
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->_pageFactory->create();
        $resultPage->setActiveMenu(static::ADMIN_RESOURCE);
        $resultPage->addBreadcrumb(
            $studentId ? __('Student Edit') : __('Student Create'),
            $studentId ? __('Student Edit') : __('Student Create')
        );
        $resultPage->getConfig()->getTitle()->prepend(
            $studentId ? __('Student Edit') : __('Student Create')
        );

        return $resultPage;
    }

    /**
     * Is the user allowed to view the page.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
    }
}
