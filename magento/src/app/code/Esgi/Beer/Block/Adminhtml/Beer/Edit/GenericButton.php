<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Esgi\Beer\Block\Adminhtml\Beer\Edit;

use Magento\Backend\Block\Widget\Context;
use Esgi\Beer\Api\BeerRepositoryInterface;
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
     * @var BeerRepositoryInterface
     */
    protected $breweryRepository;

    /**
     * @param Context $context
     * @param BeerRepositoryInterface $breweryRepository
     */
    public function __construct(
        Context $context,
        BeerRepositoryInterface $breweryRepository
    ) {
        $this->context              = $context;
        $this->breweryRepository = $breweryRepository;
    }

    /**
     * Return Beer brewery ID
     *
     * @return int|null
     */
    public function getBeerId()
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
