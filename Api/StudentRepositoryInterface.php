<?php
namespace Hoan\Student\Api;

interface StudentRepositoryInterface
{
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
    public function save(\Hoan\Student\Api\Data\StudentInterface $student);

    /**
     * Retrieve student.
     *
     * @param string $email
     * @param int|null $websiteId
     * @return \Hoan\Student\Api\Data\StudentInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($email, $websiteId = null);

    /**
     * Get student by student ID.
     *
     * @param int $studentId
     * @return \Hoan\Student\Api\Data\StudentInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If student with the specified ID does not exist.
     */
    public function getById($studentId);

    /**
     * Retrieve student which match a specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Hoan\Student\Api\Data\StudentSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete student.
     *
     * @param \Hoan\Student\Api\Data\StudentInterface $student
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Hoan\Student\Api\Data\StudentInterface $student);

    /**
     * Delete student by student ID.
     *
     * @param int $studentId
     * @return bool true on success
     */
    public function deleteById($studentId);
}
