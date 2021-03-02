<?php

namespace Alex\Tracker\Model\ResourceModel;

use Alex\Tracker\Api\Data\TrackerInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Tracker extends AbstractDb
{
    const TABLE_NAME = 'tracked_data';

    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init(static::TABLE_NAME, TrackerInterface::ID);
    }
}
