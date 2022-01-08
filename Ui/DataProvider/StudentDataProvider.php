<?php

namespace Hoan\Student\Ui\DataProvider;

class StudentDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param \Hoan\Student\Model\ResourceModel\Student\CollectionFactory
     */
    protected $collection;

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
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    /**
     * @inheritdoc
     */
    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        $this->collection->addFieldToFilter(['student_id', 'student_name'],
            [
                ['like' => '%' . $filter->getValue() . '%'],
                ['like' => '%' . $filter->getValue() . '%']
            ]);
    }
}
