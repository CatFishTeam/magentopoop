<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Esgi\Beer\Block\Adminhtml\Brewery\Edit;

use Magento\Backend\Block\Widget\Context;
use Esgi\Beer\Api\BreweryRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var BreweryRepositoryInterface
     */
    protected $breweryRepository;

    /**
     * @param Context $context
     * @param BreweryRepositoryInterface $breweryRepository
     */
    public function __construct(
        Context $context,
        BreweryRepositoryInterface $breweryRepository
    ) {
        $this->context              = $context;
        $this->breweryRepository = $breweryRepository;
    }

    /**
     * Return Beer brewery ID
     *
     * @return int|null
     */
    public function getBreweryId()
    {
        try {
            return $this->breweryRepository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
