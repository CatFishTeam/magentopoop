<?php

declare(strict_types=1);

namespace Esgi\Beer\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for beer brewery search results.
 * @api
 */
interface BeerSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get beerr list.
     *
     * @return \Esgi\Beer\Api\Data\BeerInterface[]
     */
    public function getItems();

    /**
     * Set beerr list.
     *
     * @param \Esgi\Beer\Api\Data\BeerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
