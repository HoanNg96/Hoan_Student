<?php

namespace Hoan\Student\Ui\Component\Listing;

use Hoan\Student\Ui\DataProvider\AddFilterInterface;
use Magento\Framework\Api\Filter;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;

/**
 * Adds fulltext filter for CMS Page title attribute.
 */
class FulltextFilter implements AddFilterInterface
{
    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * @param \Magento\Framework\Api\Search\FilterGroupBuilder $filterGroupBuilder
     */
    private $filterGroupBuilder;

    /**
     * @param FilterBuilder $filterBuilder
     */
    public function __construct(
        FilterBuilder $filterBuilder,
        \Magento\Framework\Api\Search\FilterGroupBuilder $filterGroupBuilder
    ) {
        $this->filterBuilder = $filterBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
    }

    /**
     * @inheritdoc
     */
    public function addFilter(SearchCriteriaBuilder $searchCriteriaBuilder, Filter $filter)
    {
        $filter = $this->filterBuilder->setField('student_name')
            ->setValue(sprintf('%%%s%%', $filter->getValue()))
            ->setConditionType('like')
            ->create();
        $searchCriteriaBuilder->addFilter($filter);
    }
}
