<?php

namespace Hoan\Student\Controller\Adminhtml\Form;

class Create extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Hoan_Student::create';

    const PAGE_TITLE = 'Student Create';

    /**
     * @param \Magento\Backend\Model\View\Result\ForwardFactory
     */
    private $forwardFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $forwardFactory
    ) {
        $this->forwardFactory = $forwardFactory;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        // return $resultForward;
        $resultForward = $this->forwardFactory->create();
        $resultForward->forward('edit');
        return $resultForward;
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
