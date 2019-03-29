<?php
namespace Esgi\Beer\Block\Beer;

use Esgi\Beer\Model\BeerRepository;
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

    public function __construct(
        CollectionFactory $collectionFactory,
        Context $context,
        BeerRepository $beerRepository,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->beerRepository = $beerRepository;
        parent::__construct($context, $data);
    }

    public function getBeer()
    {
        $id = $this->getRequest()->getParam('id');

        return $this->beerRepository->getById($id);
    }
}
