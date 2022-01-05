<?php
namespace Hoan\Student\Model;

use Hoan\Student\Api\StudentRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

class StudentRepository implements StudentRepositoryInterface
{
    /**
     * @param \Hoan\Student\Model\ResourceModel\Student
     */
    private $resource;

    /**
     * @param \Hoan\Student\Model\StudentFactory
     */
    private $studentFactory;

    /**
     * @param \Hoan\Student\Model\ResourceModel\Student\Collection
     */
    private $studentCollectionFactory;

    /**
     * @param \Hoan\Student\Api\Data\StudentSearchResultsInterface
     */
    private $searchResultsFactory;

    /**
     * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface
     */
    private $collectionProcessor;

    public function __construct(
        \Hoan\Student\Model\ResourceModel\Student $resource,
        \Hoan\Student\Model\StudentFactory $studentFactory,
        \Hoan\Student\Model\ResourceModel\Student\CollectionFactory $studentCollectionFactory,
        \Hoan\Student\Api\Data\StudentSearchResultsInterfaceFactory $searchResultsFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor = null
    )
    {
        $this->resource = $resource;
        $this->studentFactory = $studentFactory;
        $this->studentCollectionFactory = $studentCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }

    /**
     * Create or update student
     * 
     * @param \Hoan\Student\Api\Data\StudentInterface $student
     * @return \Hoan\Student\Api\Data\StudentInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\State\InputMismatchException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Hoan\Student\Api\Data\StudentInterface $student)
    {
        try {
            $this->resource->save($student);
        } catch (LocalizedException $exception) {
            throw new CouldNotSaveException(
                __('Could not save the student: %1', $exception->getMessage()),
                $exception
            );
        } catch (\Throwable $exception) {
            throw new CouldNotSaveException(
                __('Could not save the student: %1', __('Something went wrong while saving the student.')),
                $exception
            );
        }
        return $student;
    }

    /**
     * Retrieve student.
     *
     * @param string $email
     * @param int|null $websiteId
     * @return \Hoan\Student\Api\Data\StudentInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($email, $websiteId = null)
    {
    }

    /**
     * Get student by student ID.
     *
     * @param int $studentId
     * @return \Hoan\Student\Api\Data\StudentInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If student with the specified ID does not exist.
     */
    public function getById($studentId)
    {
        $student = $this->studentFactory->create();
        $this->resource->load($student, $studentId);
        if (!$student->getStudentId()) {
            throw new NoSuchEntityException(__('The student with the ID: "%1" doesn\'t exist.', $studentId));
        }
        return $student;
    }

    /**
     * Retrieve student which match a specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Hoan\Student\Api\Data\StudentSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Hoan\Student\Model\ResourceModel\Student\Collection $collection */
        $collection = $this->studentCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var \Hoan\Student\Api\Data\StudentSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete student.
     *
     * @param \Hoan\Student\Api\Data\StudentInterface $student
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Hoan\Student\Api\Data\StudentInterface $student)
    {
        try {
            $this->resource->delete($student);
        } catch (LocalizedException $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete student by student ID.
     *
     * @param int $studentId
     * @return bool true on success
     */
    public function deleteById($studentId)
    {
        return $this->delete($this->getById($studentId));
    }

    /**
     * Retrieve collection processor
     *
     * @deprecated 102.0.0
     * @return CollectionProcessorInterface
     */
    private function getCollectionProcessor()
    {
        //phpcs:disable Magento2.PHP.LiteralNamespaces
        if (!$this->collectionProcessor) {
            $this->collectionProcessor = \Magento\Framework\App\ObjectManager::getInstance()->get(
                \Hoan\Student\Model\Api\SearchCriteria\StudentCollectionProcessor::class
            );
        }
        return $this->collectionProcessor;
    }
}
