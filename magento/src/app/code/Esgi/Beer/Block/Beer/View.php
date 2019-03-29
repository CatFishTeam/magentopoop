<?php
namespace Esgi\Beer\Block\Beer;

use Esgi\Beer\Model\BeerRepository;
use Esgi\Beer\Model\BreweryRepository;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Esgi\Beer\Model\ResourceModel\Beer\Collection;
use Esgi\Beer\Model\ResourceModel\Beer\CollectionFactory;

/**
 * Beer block
 */
class View extends Template
{
    protected $collectionFactory;
    protected $beerRepository;
    protected $breweryRepository;

    public function __construct(
        CollectionFactory $collectionFactory,
        Context $context,
        BeerRepository $beerRepository,
        BreweryRepository $breweryRepository,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->beerRepository = $beerRepository;
        $this->breweryRepository = $breweryRepository;
        parent::__construct($context, $data);
    }

    public function getBeer()
    {
        $id = $this->getRequest()->getParam('id');

        return $this->beerRepository->getById($id);
    }

    public function getBrewery()
    {
        $id = $this->getRequest()->getParam('id');
        $beer = $this->beerRepository->getById($id);

        return $this->breweryRepository->getById($beer->getData('brewery_id'));
    }
}
