<?php

namespace Alex\Tracker\Model;

use Alex\Tracker\Api\Data\TransferInterface;

class Transfer implements TransferInterface
{
    /**
     * @var float
     */
    private $price;

    /**
     * @var string
     */
    private $sku;

    /**
     * Transfer constructor.
     *
     * @param string $sku
     * @param float  $price
     */
    public function __construct(string $sku, float $price)
    {
        $this->sku = $sku;
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return (float)$this->price;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }
}
