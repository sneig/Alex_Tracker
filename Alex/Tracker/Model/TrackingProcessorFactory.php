<?php

namespace Alex\Tracker\Model;

use Alex\Tracker\Model\TrackingProcessor\TrackingProcessorInterface;
use Magento\Framework\Exception\LocalizedException;

class TrackingProcessorFactory
{
    /**
     * @var array
     */
    private $processors;

    /**
     * TrackingProcessorFactory constructor.
     *
     * @param array $processors
     */
    public function __construct(array $processors)
    {
        $this->processors = $processors;
    }

    /**
     * @param string $type
     *
     * @return TrackingProcessorInterface
     * @throws LocalizedException
     */
    public function createProcessor(string $type): TrackingProcessorInterface
    {
        $processor = $this->processors[$type] ?? null;
        if (!($processor instanceof TrackingProcessorInterface)) {
            throw new LocalizedException(__('Processor should be instance of %1', TrackingProcessorInterface::class));
        }

        return $processor;
    }
}
