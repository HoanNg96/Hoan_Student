<?php

namespace Hoan\Student\Ui\DataProvider;

class StudentFormDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param \Hoan\Student\Model\ResourceModel\Student\CollectionFactory
     */
    protected $collection;

    /**
     * @param \Magento\Framework\App\Request\DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @param string name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \Hoan\Student\Model\ResourceModel\Student\CollectionFactory $collection
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Hoan\Student\Model\ResourceModel\Student\CollectionFactory $collectionFactory,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \Hoan\Student\Model\Student $student */
        foreach ($items as $student) {
            $this->loadedData[$student->getStudentId()] = $student->getData();
        }

        $data = $this->dataPersistor->get('student');
        if (!empty($data)) {
            $student = $this->collection->getNewEmptyItem();
            $student->setData($data);
            $this->loadedData[$student->getStudentId()] = $student->getData();
            $this->dataPersistor->clear('student');
        }

        return $this->loadedData;
    }
}
