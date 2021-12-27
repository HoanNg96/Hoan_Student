<?php
namespace Hoan\Student\Api\Data;

interface StudentSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get students list.
     *
     * @return \Hoan\Student\Api\Data\StudentInterface[]
     */
    public function getItems();

    /**
     * Set students list.
     *
     * @param \Hoan\Student\Api\Data\StudentInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
