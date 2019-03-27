<?php

declare(strict_types=1);

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Esgi\Beer\Model;

use Esgi\Beer\Api\BeerRepositoryInterface;
use Esgi\Beer\Api\Data;
use Esgi\Beer\Model\ResourceModel\Beer as BeerResource;
use Esgi\Beer\Model\BeerFactory;
use Esgi\Beer\Model\ResourceModel\Beer\CollectionFactory as BeerCollectionFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class BlockRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class BeerRepository implements BeerRepositoryInterface
{
    /**
     * @var BeerResource
     */
    protected $resource;

    /**
     * @var BeerFactory
     */
    protected $beerFactory;

    /**
     * @var BeerCollectionFactory
     */
    protected $beerCollectionFactory;

    /**
     * @var Data\BeerSearchResultsInterface
     */
    protected $searchResultsFactory;

    /**
     * @param BeerResource $resource
     * @param BeerFactory $beerFactory
     * @param BeerCollectionFactory $beerCollectionFactory
     * @param Data\BeerSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        BeerResource $resource,
        BeerFactory $beerFactory,
        \Esgi\Beer\Api\Data\BeerInterfaceFactory $dataBeerFactory,
        BeerCollectionFactory $beerCollectionFactory,
        Data\BeerSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->beerFactory = $beerFactory;
        $this->beerCollectionFactory = $beerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save Beer data
     *
     * @param \Esgi\Beer\Api\Data\BeerInterface $beer
     * @return Beer
     * @throws CouldNotSaveException
     */
    public function save(Data\BeerInterface $beer)
    {
        try {
            $this->resource->save($beer);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $beer;
    }

    /**
     * Load Beer data by given Beer Identity
     *
     * @param string $beerId
     * @return Beer
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($beerId)
    {
        $beer = $this->beerFactory->create();
        $this->resource->load($beer, $beerId);
        if (!$beer->getId()) {
            throw new NoSuchEntityException(__('Beer with id "%1" does not exist.', $beer));
        }

        return $beer;
    }

    /**
     * Load Beer data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Esgi\Beer\Api\Data\BeerSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var \Esgi\Beer\Model\ResourceModel\Beer\Collection $collection */
        $collection = $this->beerCollectionFactory->create();

        /** @var Data\BeerSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * Delete Beer
     *
     * @param \Esgi\Beer\Api\Data\BeerInterface $beer
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\BeerInterface $beer)
    {
        try {
            $this->resource->delete($beer);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * Delete Beer by given Beer Identity
     *
     * @param string $beerId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($beerId)
    {
        return $this->delete($this->getById($beerId));
    }
}
