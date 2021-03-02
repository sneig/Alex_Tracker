<?php

namespace Alex\Tracker\Model\Source\Config;

use Magento\Framework\Data\OptionSourceInterface;

class Mode implements OptionSourceInterface
{
    /**
     * @var array
     */
    private $modeOptions;

    /**
     * Mode constructor.
     *
     * @param array $modeOptions
     */
    public function __construct(array $modeOptions)
    {
        $this->modeOptions = $modeOptions;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return $this->modeOptions;
    }
}
