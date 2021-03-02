<?php

namespace Alex\Tracker\Model;

use Alex\Tracker\Api\Data\TrackerInterface;
use Magento\Framework\Model\AbstractModel;

class Tracker extends AbstractModel implements TrackerInterface
{
    /**
     * @param string $trackingCode
     *
     * @return TrackerInterface
     */
    public function setTrackingCode(string $trackingCode): TrackerInterface
    {
        return $this->setData(TrackerInterface::TRACKING_CODE, $trackingCode);
    }

    /**
     * @param string $message
     *
     * @return TrackerInterface
     */
    public function setTrackingMessage(string $message): TrackerInterface
    {
        return $this->setData(TrackerInterface::TRACKING_MESSAGE, $message);
    }

    /**
     * @param string $sku
     *
     * @return TrackerInterface
     */
    public function setSku(string $sku): TrackerInterface
    {
        return $this->setData(TrackerInterface::SKU, $sku);
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return (string)$this->getData(TrackerInterface::SKU);
    }

    /**
     * @return string
     */
    public function getTrackingMessage(): string
    {
        return (string)$this->getData(TrackerInterface::TRACKING_MESSAGE);
    }

    /**
     * @return string
     */
    public function getTrackingCode(): string
    {
        return (string)$this->getData(TrackerInterface::TRACKING_CODE);
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string)$this->getData(TrackerInterface::CREATED_AT);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init(\Alex\Tracker\Model\ResourceModel\Tracker::class);
    }
}
