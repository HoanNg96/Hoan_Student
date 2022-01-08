<?php

namespace Hoan\Student\Controller\Adminhtml\Listing;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @param \Magento\Backend\Model\View\Result\RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * @param \Hoan\Student\Model\StudentRepository
     */
    private $studentRepository;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
        \Hoan\Student\Model\StudentRepository $studentRepository
    ) {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->studentRepository = $studentRepository;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('student_id');
        if ($id) {
            try {
                // init model and delete
                $this->studentRepository->deleteById($id);
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the student.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['student_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a student to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
