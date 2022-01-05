<?php

namespace Hoan\Student\Controller\Index;

class Save extends \Magento\Framework\App\Action\Action
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
     * @param \Hoan\Student\Model\StudentFactory
     */
    private $studentFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Hoan\Student\Model\StudentRepository $studentRepository,
        \Magento\Framework\App\Cache\TypeListInterface $typeList,
        \Magento\Framework\App\Cache\Frontend\Pool $pool,
        \Hoan\Student\Model\StudentFactory $studentFactory
    ) {
        $this->studentRepository = $studentRepository;
        $this->cacheTypeList = $typeList;
        $this->cacheFrontendPool = $pool;
        $this->studentFactory = $studentFactory;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        //  catch button form submit
        if (isset($_POST['editbtn'])) {
            $student = $this->studentRepository->getById(filter_input(INPUT_POST, 'editbtn'));

            $student->setStudentId(filter_input(INPUT_POST, 'editbtn'));
            $student->setStudentName(filter_input(INPUT_POST, 'name'));
            $student->setStudentBirthday(filter_input(INPUT_POST, 'brithday'));
            $student->setStudentImg(filter_input(INPUT_POST, 'image'));
            $student->setUpdatedAt(date('Y-m-d H:i:s'));
        } elseif (isset($_POST['createbtn'])) {
            $student = $this->studentFactory->create();

            $student->setStudentName(filter_input(INPUT_POST, 'name'));
            $student->setStudentBirthday(filter_input(INPUT_POST, 'brithday'));
            $student->setStudentImg(filter_input(INPUT_POST, 'image'));
            $student->setCreatedAt(date('Y-m-d H:i:s'));
            $student->setUpdatedAt(date('Y-m-d H:i:s'));
        }

        $this->studentRepository->save($student);

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
