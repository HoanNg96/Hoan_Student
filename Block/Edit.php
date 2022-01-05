<?php
namespace Hoan\Student\Block;

class Edit extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Hoan\Student\Model\StudentRepository
     */
    private $studentRepository;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Hoan\Student\Model\StudentRepository $studentRepository,
        array $data = []
    ) {
        $this->studentRepository = $studentRepository;
        parent::__construct($context, $data);
    }

    public function getCurrentStudent()
    {
        $student_id = $this->getRequest()->getParams('student_id');
        $student = $this->studentRepository->getById($student_id);
        return $student;
    }
}
