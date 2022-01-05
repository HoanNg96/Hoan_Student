<?php

namespace Hoan\Student\Controller\Index;

class Delete extends \Magento\Framework\App\Action\Action
{
    /**
     * @param \Hoan\Student\Model\StudentRepository
     */
    private $studentRepository;

    /**
     * @param \Magento\Framework\App\Cache\TypeListInterface
     */
    private $cacheTypeList;

    /**
     * @param \Magento\Framework\App\Cache\Frontend\Pool
     */
    private $cacheFrontendPool;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Hoan\Student\Model\StudentRepository $studentRepository,
        \Magento\Framework\App\Cache\TypeListInterface $typeList,
        \Magento\Framework\App\Cache\Frontend\Pool $pool
    ) {
        $this->studentRepository = $studentRepository;
        $this->cacheTypeList = $typeList;
        $this->cacheFrontendPool = $pool;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $student_id = $this->getRequest()->getParam('student_id');
        $this->studentRepository->deleteById($student_id);

        $types = [
            'config',
            'layout',
            'block_html',
            'collections',
            'reflection',
            'db_ddl',
            'compiled_config',
            'eav',
            'config_integration',
            'config_integration_api',
            'full_page', 'translate',
            'config_webservice',
            'vertex'
        ];
        foreach ($types as $type) {
            $this->cacheTypeList->cleanType($type);
        }
        foreach ($this->cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('student/index/index');
        return $resultRedirect;
    }
}
