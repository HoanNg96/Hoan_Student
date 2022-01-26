<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Hoan\Student\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

/**
 * Class Thumbnail
 *
 * @api
 * @since 100.0.2
 */
class Thumbnail extends \Magento\Ui\Component\Listing\Columns\Column
{
    const NAME = 'thumbnail';

    const ALT_FIELD = 'name';

    /**
     * @var \Hoan\Student\Helper\Image
     */
    private $imageHelper;

    /**
     * @param \Hoan\Student\Model\StudentRepository
     */
    private $studentRepository;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param \Hoan\Student\Helper\Image $imageHelper
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Hoan\Student\Helper\Image $imageHelper,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Hoan\Student\Model\StudentRepository $studentRepository,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->imageHelper = $imageHelper;
        $this->urlBuilder = $urlBuilder;
        $this->studentRepository = $studentRepository;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as &$item) {
                $student = $this->studentRepository->getById($item[\Hoan\Student\Api\Data\StudentInterface::STUDENT_ID]);
                $studentImage = $student->getStudentImg();
                if ($studentImage != "" && $studentImage != null) {
                    $imageData = json_decode($studentImage, true);
                    $item[$fieldName . '_src'] = $this->imageHelper->getBaseImageUrl() . $imageData[0]['url'];
                    $item[$fieldName . '_alt'] = $this->getAlt($item) ?: $imageData[0]['name'];
                    $item[$fieldName . '_orig_src'] = $this->imageHelper->getBaseImageUrl() . $imageData[0]['url'];
                }
                $item[$fieldName . '_link'] = $this->urlBuilder->getUrl(
                    'student/form/edit',
                    [\Hoan\Student\Api\Data\StudentInterface::STUDENT_ID => $student->getStudentId(), 'store' => $this->context->getRequestParam('store')]
                );
            }
        }

        return $dataSource;
    }

    /**
     * Get Alt
     *
     * @param array $row
     *
     * @return null|string
     */
    protected function getAlt($row)
    {
        $altField = $this->getData('config/altField') ?: self::ALT_FIELD;
        return $row[$altField] ?? null;
    }
}
