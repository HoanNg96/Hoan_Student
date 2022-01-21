<?php

namespace Hoan\Student\Controller\Adminhtml\Listing;

class InlineEdit extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Hoan_Student::student';

    /**
     * @param \Magento\Framework\Controller\Result\JsonFactory
     */
    private $jsonFactory;

    /**
     * @param \Hoan\Student\Model\StudentRepository
     */
    private $studentRepository;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Hoan\Student\Model\StudentRepository $studentRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Hoan\Student\Model\StudentRepository $studentRepository
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->studentRepository = $studentRepository;
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $studentItems = $this->getRequest()->getParam('items', []);
            if (!count($studentItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($studentItems) as $studentId) {
                    /** @var \Hoan\Student\Model\Student $student */
                    $student = $this->studentRepository->getById($studentId);
                    try {
                        $student->setData(array_merge($student->getData(), $studentItems[$studentId]));
                        $student->setUpdatedAt(time());
                        $this->studentRepository->save($student);
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithStudentId(
                            $student,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add block title to error message
     *
     * @param \Hoan\Student\Api\Data\StudentInterface $student
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithStudentId(\Hoan\Student\Api\Data\StudentInterface $student, $errorText)
    {
        return '[Student ID: ' . $student->getStudentId() . '] ' . $errorText;
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
