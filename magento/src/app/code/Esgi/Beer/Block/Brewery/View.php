<?php
namespace Esgi\Beer\Block\Brewery;

use Esgi\Beer\Model\BreweryRepository;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Esgi\Beer\Model\ResourceModel\Beer\Collection;
use Esgi\Beer\Model\ResourceModel\Beer\CollectionFactory;

/**
 * Brewery block
 */
class View extends Template
{
    protected $collectionFactory;
    protected $breweryRepository;

    public function __construct(
        CollectionFactory $collectionFactory,
        Context $context,
        BreweryRepository $breweryRepository,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->breweryRepository = $breweryRepository;
        parent::__construct($context, $data);
    }

    public function getBrewery()
    {
        $id = $this->getRequest()->getParam('id');

        return $this->breweryRepository->getById($id);
    }
}
