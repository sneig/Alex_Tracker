<?php

namespace Alex\Tracker\Api\Data;

interface TrackerInterface
{
    const TRACKING_CODE = 'tracking_code';
    const TRACKING_MESSAGE = 'tracking_message';
    const SKU = 'sku';
    const CREATED_AT = 'created_at';
    const ID = 'entity_id';

    /**
     * @param string $trackingCode
     *
     * @return TrackerInterface
     */
    public function setTrackingCode(string $trackingCode): TrackerInterface;

    /**
     * @param string $message
     *
     * @return TrackerInterface
     */
    public function setTrackingMessage(string $message): TrackerInterface;

    /**
     * @param string $sku
     *
     * @return TrackerInterface
     */
    public function setSku(string $sku): TrackerInterface;

    /**
     * @return string
     */
    public function getSku(): string;

    /**
     * @return string
     */
    public function getTrackingMessage(): string;

    /**
     * @return string
     */
    public function getTrackingCode(): string;

    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return TrackerInterface
     */
    public function setId($id);
}
