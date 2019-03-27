<?php

declare(strict_types=1);

namespace Esgi\Beer\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for beer brewery search results.
 * @api
 */
interface BrewerySearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get departments list.
     *
     * @return \Esgi\Beer\Api\Data\BreweryInterface[]
     */
    public function getItems();

    /**
     * Set departments list.
     *
     * @param \Esgi\Beer\Api\Data\BreweryInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
