<?php

namespace Hoan\Student\Controller\Adminhtml\Listing;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Hoan_Student::student';

    const PAGE_TITLE = 'Student Listing';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Framework\App\Request\DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->_pageFactory = $pageFactory;
        $this->dataPersistor = $dataPersistor;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->_pageFactory->create();
        $resultPage->setActiveMenu(static::ADMIN_RESOURCE);
        $resultPage->addBreadcrumb(__(static::PAGE_TITLE), __(static::PAGE_TITLE));
        $resultPage->getConfig()->getTitle()->prepend(__(static::PAGE_TITLE));

        $this->dataPersistor->clear('student');

        return $resultPage;
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
