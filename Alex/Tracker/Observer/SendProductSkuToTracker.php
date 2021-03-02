<?php

namespace Alex\Tracker\Observer;

use Alex\Tracker\Model\QuoteTrackingService;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Alex\Tracker\Helper\Config;

class SendProductSkuToTracker implements ObserverInterface
{
    /**
     * @var Config
     */
    private $configHelper;

    /**
     * @var QuoteTrackingService
     */
    private $quoteTrackingService;

    /**
     * SendProductSkuToTracker constructor.
     *
     * @param Config               $config
     * @param QuoteTrackingService $quoteTrackingService
     */
    public function __construct(Config $config, QuoteTrackingService $quoteTrackingService)
    {
        $this->quoteTrackingService = $quoteTrackingService;
        $this->configHelper = $config;
    }

    /**
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        if (!$this->configHelper->isEnabled()) {
            return;
        }

        $this->quoteTrackingService->execute($observer->getEvent()->getQuoteItem());
    }
}
