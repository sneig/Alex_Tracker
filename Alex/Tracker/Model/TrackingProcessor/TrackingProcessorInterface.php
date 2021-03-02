<?php

namespace Alex\Tracker\Model\TrackingProcessor;

use Alex\Tracker\Api\Data\TransferInterface;

interface TrackingProcessorInterface
{
    /**
     * @param TransferInterface $transfer
     *
     * @return bool
     */
    public function execute(TransferInterface $transfer): bool;
}
