<?php

declare(strict_types=1);

namespace Esgi\Beer\Api;

/**
 * Esgi job CRUD interface.
 * @api
 */
interface BreweryRepositoryInterface
{
    /**
     * Save block.
     *
     * @param \Esgi\Beer\Api\Data\BreweryInterface $department
     * @return \Esgi\Beer\Api\Data\BreweryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\BreweryInterface $department);

    /**
     * Retrieve $department.
     *
     * @param int $departmentId
     * @return \Esgi\Beer\Api\Data\BreweryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($departmentId);

    /**
     * Retrieve departments matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Esgi\Beer\Api\Data\BrewerySearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete department.
     *
     * @param \Esgi\Beer\Api\Data\BreweryInterface $department
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\BreweryInterface $department);

    /**
     * Delete department by ID.
     *
     * @param int $departmentId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($departmentId);
}
