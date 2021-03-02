<?php

namespace Alex\Tracker\Model;

use Alex\Tracker\Api\Data\TransferInterface;
use Alex\Tracker\Api\Data\TransferInterfaceFactory;
use Alex\Tracker\Helper\Config;
use Alex\Tracker\Model\TrackingProcessor\TrackingProcessorInterface;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Quote\Model\Quote\Item;

class QuoteTrackingService
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var TrackingProcessorFactory
     */
    private $trackingProcessorFactory;

    /**
     * @var TransferInterfaceFactory
     */
    private $transferFactory;

    /**
     * QuoteTrackingService constructor.
     * @param Config $config
     * @param TrackingProcessorFactory $trackingProcessorFactory
     * @param TransferInterfaceFactory $transferFactory
     */
    public function __construct(
        Config $config,
        TrackingProcessorFactory $trackingProcessorFactory,
        TransferInterfaceFactory $transferFactory
    ) {
        $this->transferFactory = $transferFactory;
        $this->trackingProcessorFactory = $trackingProcessorFactory;
        $this->config = $config;
    }

    /**
     * @param Item $cartItem
     *
     * @return bool
     */
    public function execute(Item $cartItem): bool
    {
        if ($cartItem->getParentItem()) {
            return false;
        }
        return $this->getProcessor()->execute($this->createTransferObject($cartItem));
    }

    /**
     * @param Item $cartItem
     * @return TransferInterface
     */
    private function createTransferObject(Item $cartItem): TransferInterface
    {
        return $this->transferFactory->create(
            [
                'sku' => $cartItem->getSku(),
                'price' => (float)number_format($cartItem->getPrice(), 2)
            ]
        );
    }

    /**
     * @return TrackingProcessorInterface
     */
    private function getProcessor(): TrackingProcessorInterface
    {
        return $this->trackingProcessorFactory->createProcessor($this->config->getMode());
    }
}
