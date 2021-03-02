<?php

namespace Alex\Tracker\Model\ResourceModel\Tracker;

use Alex\Tracker\Model\Tracker;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Tracker::class, \Alex\Tracker\Model\ResourceModel\Tracker::class);
    }
}
