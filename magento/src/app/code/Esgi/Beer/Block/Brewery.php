<?php
// app/code/Esgi/Job/Block/Department.php
namespace Esgi\Beer\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Esgi\Beer\Model\ResourceModel\Brewery\Collection;
use Esgi\Beer\Model\ResourceModel\Brewery\CollectionFactory;

/**
 * Brewery block
 */
class Brewery extends Template
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

    public function getDepartments()
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();

        return $collection->getItems();
    }
}
