<?php

namespace Alex\Tracker\Model\TrackingProcessor;

use Alex\Tracker\Api\Data\TransferInterface;
use Magento\Framework\MessageQueue\PublisherInterface;

class AsyncProcessor implements AsyncProcessorInterface
{
    /**
     * @var PublisherInterface
     */
    private $publisher;

    /**
     * AsyncProcessor constructor.
     * @param PublisherInterface $publisher
     */
    public function __construct(PublisherInterface $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * @param TransferInterface $transfer
     * @return bool
     */
    public function execute(TransferInterface $transfer): bool
    {
        $this->publisher->publish('track_product.action', $transfer);
        return true;
    }
}
