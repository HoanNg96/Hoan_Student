<?php

namespace Hoan\Student\Controller\Test;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Hoan\Student\Model\ResourceModel\Student\CollectionFactory
     */
    private $collection;

    /**
     * @param \Hoan\Student\Model\StudentRepository
     */
    private $studentRepository;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Hoan\Student\Model\ResourceModel\Student\CollectionFactory $collection,
        \Hoan\Student\Model\StudentRepository $studentRepository
    ) {
        $this->_pageFactory = $pageFactory;
        $this->collection = $collection;
        $this->studentRepository = $studentRepository;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
