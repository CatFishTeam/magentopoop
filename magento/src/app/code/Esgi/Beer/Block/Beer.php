<?php
// app/code/Esgi/Beer/Block/Beer.php
namespace Esgi\Beer\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Esgi\Beer\Model\ResourceModel\Beer\Collection;
use Esgi\Beer\Model\ResourceModel\Beer\CollectionFactory;

/**
 * Beer block
 */
class Beer extends Template
{
    protected $collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory,
        Context $context,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getBeers()
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();

        return $collection->getItems();
    }
}
