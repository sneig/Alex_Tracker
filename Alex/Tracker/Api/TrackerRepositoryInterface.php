<?php

namespace Alex\Tracker\Api;

use Alex\Tracker\Api\Data\TrackerInterface;
use Alex\Tracker\Api\Data\TrackingSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface TrackerRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $criteria
     *
     * @return TrackingSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria): TrackingSearchResultsInterface;

    /**
     * @param TrackerInterface $tracker
     *
     * @return TrackerInterface
     */
    public function save(TrackerInterface $tracker): TrackerInterface;
}
