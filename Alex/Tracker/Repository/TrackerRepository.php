<?php

namespace Alex\Tracker\Repository;

use Alex\Tracker\Api\Data\TrackerInterface;
use Alex\Tracker\Api\Data\TrackingSearchResultsInterface;
use Alex\Tracker\Api\TrackerRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Alex\Tracker\Model\ResourceModel\Tracker\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Alex\Tracker\Model\ResourceModel\Tracker as TrackerResource;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;
use Alex\Tracker\Api\Data\TrackingSearchResultsInterfaceFactory;

class TrackerRepository implements TrackerRepositoryInterface
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var TrackingSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var TrackerResource
     */
    private $trackerResource;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * TrackerRepository constructor.
     *
     * @param CollectionFactory                     $collectionFactory
     * @param CollectionProcessorInterface          $collectionProcessor
     * @param TrackingSearchResultsInterfaceFactory $searchResultsFactory
     * @param TrackerResource                       $trackerResource
     * @param LoggerInterface                       $logger
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        TrackingSearchResultsInterfaceFactory $searchResultsFactory,
        TrackerResource $trackerResource,
        LoggerInterface $logger
    ) {
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->trackerResource = $trackerResource;
        $this->logger = $logger;
    }

    /**
     * @param SearchCriteriaInterface $criteria
     *
     * @return TrackingSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria): TrackingSearchResultsInterface
    {
        /** @var \Magento\Cms\Model\ResourceModel\Page\Collection $collection */
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);

        /** @var TrackingSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @param TrackerInterface $tracker
     *
     * @return TrackerInterface
     * @throws CouldNotSaveException
     */
    public function save(TrackerInterface $tracker): TrackerInterface
    {
        try {
            $this->trackerResource->save($tracker);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage());
        }

        return $tracker;
    }
}
