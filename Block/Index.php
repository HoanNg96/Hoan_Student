<?php
namespace Hoan\Student\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Hoan\Student\Model\StudentRepository
     */
    private $studentRepository;

    /**
     * @param \Magento\Framework\Api\SearchCriteriaBuilderFactory
     */
    private $searchCriteriaBuilderFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Hoan\Student\Model\StudentRepository $studentRepository,
        \Magento\Framework\Api\SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
        array $data = []
    ) {
        $this->studentRepository = $studentRepository;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        parent::__construct($context, $data);
    }

    public function getStudents()
    {
        $searchCriteriaBuilder = $this->searchCriteriaBuilderFactory->create();
        $searchCriteria = $searchCriteriaBuilder->create();

        $studentList = $this->studentRepository->getList($searchCriteria);
        return $studentList;
    }
}
