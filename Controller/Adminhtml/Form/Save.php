<?php

namespace Hoan\Student\Controller\Adminhtml\Form;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Hoan_Student::save';

    /**
     * @param \Magento\Framework\App\Request\DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @param \Hoan\Student\Model\StudentFactory
     */
    private $studentFactory;

    /**
     * @param \Hoan\Student\Api\StudentRepositoryInterface
     */
    private $studentRepository;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param \Hoan\Student\Model\StudentFactory|null $studentFactory
     * @param \Hoan\Student\Api\StudentRepositoryInterface|null $studentRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Hoan\Student\Model\StudentFactory $studentFactory = null,
        \Hoan\Student\Api\StudentRepositoryInterface $studentRepository = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->studentFactory = $studentFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Hoan\Student\Model\StudentFactory::class);;
        $this->studentRepository = $studentRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Hoan\Student\Api\StudentRepositoryInterface::class);
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // get data from uicomponent form
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (empty($data['student_id'])) {
                $data['student_id'] = null;
            }

            /** @var \Hoan\Student\Model\Student $model */
            $model = $this->studentFactory->create();

            $studentId = $this->getRequest()->getParam('student_id');
            if ($studentId) {
                try {
                    $model = $this->studentRepository->getById($studentId);
                    // updated time only if data change
                    $oldData = $model->getData();
                    $newData = $data;
                    array_splice($newData, -2);
                    $oldData['student_birthday'] = strtotime($oldData['student_birthday']);
                    $newData['student_birthday'] = strtotime($newData['student_birthday']);
                    $diff = array_diff($oldData, $newData);
                    if(!empty($diff)) {
                        $data['updated_at'] = time();
                    }
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This student no longer exists.'));
                    return $resultRedirect->setPath('*/listing/');
                }
            }

            $model->setData($data);

            try {
                $this->studentRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the student.'));
                $this->dataPersistor->clear('student');
                return $this->processStudentReturn($model, $data, $resultRedirect);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the student.'));
            }

            // get/set/clear data to current session
            $this->dataPersistor->set('student', $data);
            return $resultRedirect->setPath('*/*/edit', ['student_id' => $studentId]);
        }
        return $resultRedirect->setPath('*/listing/');
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

    /**
     * Process and set the block return
     *
     * @param \Hoan\Student\Model\Student $model
     * @param array $data
     * @param \Magento\Framework\Controller\ResultInterface $resultRedirect
     * @return \Magento\Framework\Controller\ResultInterface
     */
    private function processStudentReturn($model, $data, $resultRedirect)
    {
        $redirect = $data['back'] ?? 'close';

        if ($redirect === 'continue') {
            $resultRedirect->setPath('*/*/edit', ['student_id' => $model->getStudentId()]);
        } else if ($redirect === 'close') {
            $resultRedirect->setPath('*/listing/');
        } else if ($redirect === 'duplicate') {
            $duplicateModel = $this->studentFactory->create(['data' => $data]);
            $duplicateModel->setStudentId(null);
            $duplicateModel->setStudentName($data['student_name'] . '-1');
            $this->studentRepository->save($duplicateModel);
            $studentId = $duplicateModel->getStudentId();
            $this->messageManager->addSuccessMessage(__('You duplicated the student.'));
            $this->dataPersistor->set('student', $data);
            $resultRedirect->setPath('*/*/edit', ['student_id' => $studentId]);
        }
        return $resultRedirect;
    }
}
