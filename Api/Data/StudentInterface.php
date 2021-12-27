<?php
namespace Hoan\Student\Api\Data;

interface StudentInterface
{
    const STUDENT_ID = "student_id";
    const STUDENT_NAME = "student_name";
    const STUDENT_BIRTHDAY = "student_birthday";
    const STUDENT_IMG = "student_img";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";

    /**
     * Get Student Id
     * 
     * @return int|null
     */
    public function getStudentId();

    /**
     * Set Student Id
     * 
     * @param int $studentId
     * @return $this
     */
    public function setStudentId($studentId);

    /**
     * Get Student Name
     * 
     * @return string|null
     */
    public function getStudentName();
    
    /**
     * Set Student Name
     * 
     * @param string $studentName
     * @return $this
     */
    public function setStudentName($studentName);

    /**
     * Get Student Birthday
     * 
     * @return string|null
     */
    public function getStudentBirthday();

    /**
     * Set Student Birthday
     * 
     * @param string $studentBirthday
     * @return $this
     */
    public function setStudentBirthday($studentBirthday);

    /**
     * Get Student Image
     * 
     * @return string|null
     */
    public function getStudentImg();
    
    /**
     * Set Student Image
     * 
     * @param string $studentImg
     */
    public function setStudentImg($studentImg);

    /**
     * Get created at time
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created at time
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated at time
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated at time
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);
}
