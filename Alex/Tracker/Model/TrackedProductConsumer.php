<?php

namespace Alex\Tracker\Model;

use Alex\Tracker\Api\Data\TransferInterface;
use Alex\Tracker\Model\TrackingProcessor\SyncProcessorInterface;

class TrackedProductConsumer
{
    /**
     * @var SyncProcessorInterface
     */
    private $syncProcessor;

    /**
     * TrackedProductConsumer constructor.
     *
     * @param SyncProcessorInterface $syncProcessor
     */
    public function __construct(SyncProcessorInterface $syncProcessor)
    {
        $this->syncProcessor = $syncProcessor;
    }

    /**
     * @param TransferInterface $transfer
     */
    public function process(TransferInterface $transfer)
    {
        $this->syncProcessor->execute($transfer);
    }
}
