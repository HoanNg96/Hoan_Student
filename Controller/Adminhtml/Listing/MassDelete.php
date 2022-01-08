<?php

namespace Hoan\Student\Controller\Adminhtml\Listing;

use Magento\Framework\Exception\LocalizedException;

class MassDelete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Hoan_Student::massdelete';

    /**
     * @param \Hoan\Student\Model\ResourceModel\Student\CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param \Magento\Ui\Component\MassAction\Filter
     */
    private $filter;

    /**
     * @param \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @param \Hoan\Student\Model\StudentRepository
     */
    private $studentRepository;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Hoan\Student\Model\ResourceModel\Student\CollectionFactory $collectionFactory,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Hoan\Student\Model\StudentRepository $studentRepository,
        \Psr\Log\LoggerInterface $logger = null
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;
        $this->studentRepository = $studentRepository ?:
            \Magento\Framework\App\ObjectManager::getInstance()->create(\Hoan\Student\Model\StudentRepository::class);
        $this->logger = $logger ?:
            \Magento\Framework\App\ObjectManager::getInstance()->create(\Psr\Log\LoggerInterface::class);
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $collectionObj = $this->collectionFactory->create();
        $collection = $this->filter->getCollection($collectionObj);
        $studentDeleted = 0;
        $studentDeletedError = 0;
        
        /** @var \Hoan\Student\Model\Student $student */
        foreach ($collection->getItems() as $student) {
            try {
                $this->studentRepository->delete($student);
                $studentDeleted++;
            } catch (LocalizedException $exception) {
                $this->logger->error($exception->getLogMessage());
                $studentDeletedError++;
            }
        }

        if ($studentDeleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $studentDeleted)
            );
        }

        if ($studentDeletedError) {
            $this->messageManager->addErrorMessage(
                __(
                    'A total of %1 record(s) haven\'t been deleted. Please see server logs for more details.',
                    $studentDeletedError
                )
            );
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('student/*/index');
        return $resultRedirect;
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
