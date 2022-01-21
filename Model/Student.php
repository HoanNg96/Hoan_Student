<?php
namespace Hoan\Student\Model;

class Student extends \Magento\Framework\Model\AbstractModel implements \Hoan\Student\Api\Data\StudentInterface
{
    const CACHE_TAG = 'hoan_student_student';

    /**
     * Model cache tag for clear cache in after save and after delete
     *
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'student';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Hoan\Student\Model\ResourceModel\Student::class);
    }

    /**
     * Return a unique id for the model.
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getStudentId()];
    }

    /**
     * Get Student Id
     * 
     * @return int|null
     */
    public function getStudentId() {
        return $this->getData(self::STUDENT_ID);
    }

    /**
     * Set Student Id
     * 
     * @param int $studentId
     * @return \Hoan\Student\Api\Data\StudentInterface
     */
    public function setStudentId($studentId) {
        $this->setData(self::STUDENT_ID, $studentId);
    }

    /**
     * Get Student Name
     * 
     * @return string|null
     */
    public function getStudentName() {
        return $this->getData(self::STUDENT_NAME);
    }
    
    /**
     * Set Student Name
     * 
     * @param string $studentName
     * @return \Hoan\Student\Api\Data\StudentInterface
     */
    public function setStudentName($studentName) {
        $this->setData(self::STUDENT_NAME, $studentName);
    }

    /**
     * Get Student Birthday
     * 
     * @return string|null
     */
    public function getStudentBirthday() {
        return $this->getData(self::STUDENT_BIRTHDAY);
    }

    /**
     * Set Student Birthday
     * 
     * @param string $studentBirthday
     * @return \Hoan\Student\Api\Data\StudentInterface
     */
    public function setStudentBirthday($studentBirthday) {
        $this->setData(self::STUDENT_BIRTHDAY, $studentBirthday);
    }

    /**
     * Get Student Image
     * 
     * @return string|null
     */
    public function getStudentImg() {
        return $this->getData(self::STUDENT_IMG);
    }
    
    /**
     * Set Student Image
     * 
     * @param string $studentImg
     */
    public function setStudentImg($studentImg) {
        $this->setData(self::STUDENT_IMG, $studentImg);
        return $this;
    }

    /**
     * Get created at time
     *
     * @return string|null
     */
    public function getCreatedAt() {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set created at time
     *
     * @param string $createdAt
     * @return \Hoan\Student\Api\Data\StudentInterface
     */
    public function setCreatedAt($createdAt) {
        $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated at time
     *
     * @return string|null
     */
    public function getUpdatedAt() {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set updated at time
     *
     * @param string $updatedAt
     * @return \Hoan\Student\Api\Data\StudentInterface
     */
    public function setUpdatedAt($updatedAt) {
        $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
