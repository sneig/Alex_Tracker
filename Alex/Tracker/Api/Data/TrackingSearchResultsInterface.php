<?php

namespace Alex\Tracker\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;
use Alex\Tracker\Api\Data\TrackerInterface;

interface TrackingSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Alex\Tracker\Api\Data\TrackerInterface[]
     */
    public function getItems();
}
