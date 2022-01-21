<?php

namespace Hoan\Student\Block\Adminhtml\Student\Form;

/**
 * Class GenericButton
 * @package Magento\Customer\Block\Adminhtml\Edit
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @param \Hoan\Student\Api\StudentRepositoryInterface
     */
    private $studentRepository;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Hoan\Student\Api\StudentRepositoryInterface $studentRepository
    ) {
        $this->context = $context;
        $this->studentRepository = $studentRepository;
    }

    /**
     * Return Student ID
     *
     * @return int|null
     */
    public function getStudentId()
    {
        try {
            return $this->studentRepository->getById(
                $this->context->getRequest()->getParam('student_id')
            )->getStudentId();
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
