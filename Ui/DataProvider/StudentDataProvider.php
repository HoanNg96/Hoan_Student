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
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Hoan\Student\Model\ResourceModel\Student\CollectionFactory $collection,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collection->create();
    }
}
