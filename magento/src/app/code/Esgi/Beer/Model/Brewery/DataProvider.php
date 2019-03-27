<?php

namespace Esgi\Beer\Model\Brewery;

use Esgi\Beer\Model\ResourceModel\Brewery\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Esgi\Beer\Model\ResourceModel\Brewery\Collection
     */
    protected $collection;
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string                 $name
     * @param string                 $primaryFieldName
     * @param string                 $requestFieldName
     * @param CollectionFactory      $breweryCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array                  $meta
     * @param array                  $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $breweryCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->collection    = $breweryCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \Esgi\Beer\Model\Brewery $brewery */
        foreach ($items as $brewery) {
            $this->loadedData[$brewery->getId()] = $brewery->getData();
        }

        $data = $this->dataPersistor->get('beer_brewery');

        if (!empty($data)) {
            $brewery = $this->collection->getNewEmptyItem();
            $brewery->setData($data);
            $this->loadedData[$brewery->getId()] = $brewery->getData();
            $this->dataPersistor->clear('beer_brewery');
        }

        return $this->loadedData;
    }
}
