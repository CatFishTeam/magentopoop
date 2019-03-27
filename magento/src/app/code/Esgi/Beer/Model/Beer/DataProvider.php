<?php

namespace Esgi\Beer\Model\Beer;

use Esgi\Beer\Model\ResourceModel\Beer\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Esgi\Beer\Model\ResourceModel\Beer\Collection
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
     * @param CollectionFactory      $beerCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array                  $meta
     * @param array                  $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $beerCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->collection    = $beerCollectionFactory->create();
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
        /** @var \Esgi\Beer\Model\Beer $beer */
        foreach ($items as $beer) {
            $this->loadedData[$beer->getId()] = $beer->getData();
        }

        $data = $this->dataPersistor->get('beer_beer');

        if (!empty($data)) {
            $beer = $this->collection->getNewEmptyItem();
            $beer->setData($data);
            $this->loadedData[$beer->getId()] = $beer->getData();
            $this->dataPersistor->clear('beer_beer');
        }

        return $this->loadedData;
    }
}
