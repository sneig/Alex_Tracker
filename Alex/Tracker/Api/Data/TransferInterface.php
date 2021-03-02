<?php

namespace Alex\Tracker\Api\Data;

interface TransferInterface
{
    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @return string
     */
    public function getSku(): string;
}
