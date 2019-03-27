<?php

declare(strict_types=1);

namespace Esgi\Beer\Api;

/**
 * Esgi beer CRUD interface.
 * @api
 */
interface BeerRepositoryInterface
{
    /**
     * Save block.
     *
     * @param \Esgi\Beer\Api\Data\BeerInterface $beer
     * @return \Esgi\Beer\Api\Data\BeerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\BeerInterface $beer);

    /**
     * Retrieve $beer.
     *
     * @param int $beerId
     * @return \Esgi\Beer\Api\Data\BeerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($beerId);

    /**
     * Retrieve breweries matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Esgi\Beer\Api\Data\BeerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete beer.
     *
     * @param \Esgi\Beer\Api\Data\BeerInterface $beer
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\BeerInterface $beer);

    /**
     * Delete beer by ID.
     *
     * @param int $beerId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($beerId);
}
