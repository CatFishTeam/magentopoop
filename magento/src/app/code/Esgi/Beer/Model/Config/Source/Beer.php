<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Esgi\Beer\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Esgi\Beer\Model\ResourceModel\Beer\Collection;
use Esgi\Beer\Model\ResourceModel\Beer\CollectionFactory;

/**
 * Options provider for countries list
 *
 * @api
 * @since 100.0.2
 */
class Beer implements ArrayInterface
{
    /**
     * Countries
     *
     * @var CollectionFactory $breweryCollectionFactory
     */
    protected $breweryCollectionFactory;

    /**
     * Options array
     *
     * @var array
     */
    protected $options;

    /**
     * Beer constructor
     *
     * @param CollectionFactory $beerCollectionFactory
     */
    public function __construct(
        CollectionFactory $beerCollectionFactory
    ) {
        $this->beerCollectionFactory = $beerCollectionFactory;
    }

    /**
     * Return options array
     *
     * @param boolean $isMultiselect
     * @param string|array $foregroundCountries
     * @return array
     */
    public function toOptionArray($isMultiselect = false, $foregroundCountries = ''): array
    {
        if (!$this->options) {
            /** @var Collection $collection */
            $collection = $this->beerCollectionFactory->create();
            $this->options = $collection->toOptionArray();
        }

        $options = $this->options;
        if (!$isMultiselect) {
            array_unshift($options, ['value' => '', 'label' => __('--Please Select--')]);
        }

        return $options;
    }
}
