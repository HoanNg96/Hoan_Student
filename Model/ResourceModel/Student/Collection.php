<?php
namespace Hoan\Student\Model\ResourceModel\Student;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = \Hoan\Student\Model\Student::STUDENT_ID;
    protected $_eventPrefix = 'hoan_student_student_collection';
    protected $_eventObject = 'student_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Hoan\Student\Model\Student::class, \Hoan\Student\Model\ResourceModel\Student::class);
    }
}
