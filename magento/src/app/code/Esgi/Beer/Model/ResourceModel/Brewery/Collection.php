<?php

declare(strict_types=1);

namespace Esgi\Beer\Model\ResourceModel\Brewery;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = 'entity_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Esgi\Beer\Model\Brewery', 'Esgi\Beer\Model\ResourceModel\Brewery');
    }

}
