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
     * @param \Hoan\Student\Helper\Image
     */
    private $imageHelper;

    /**
     * @param string name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \Hoan\Student\Model\ResourceModel\Student\CollectionFactory $collection
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Hoan\Student\Model\ResourceModel\Student\CollectionFactory $collectionFactory,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Hoan\Student\Helper\Image $imageHelper,
        array $meta = [],
        array $data = []
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->imageHelper = $imageHelper;
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
            $studentData = $student->getData();
            if (isset($studentData['student_img']) && $studentData['student_img'] != "") {
                $imageData = json_decode($studentData['student_img'], true);
                $strpos = strpos($imageData[0]['type'], '/');
                $type = substr($imageData[0]['type'], 0, $strpos);
                $studentData['student_img'] = [
                    [
                        'name'        => $imageData[0]['name'],
                        'url'         => $this->imageHelper->getBaseImageUrl() . $imageData[0]['url'],
                        // 'id'          => $imageData[0]['id'],
                        'size'        => $imageData[0]['size'],
                        // for showing img preview
                        'type'        => $type
                    ]
                ];
            }
            $this->loadedData[$student->getStudentId()] = $studentData;
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
