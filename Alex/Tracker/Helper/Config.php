<?php

namespace Alex\Tracker\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class Config extends AbstractHelper
{
    const ASYNC_MODE = 'async';
    const SYNC_MODE = 'sync';
    const XML_CONFIG_PATH_IS_ACTIVE = 'alex_tracker/general/enabled';
    const XML_CONFIG_PATH_MODE = 'alex_tracker/general/mode';

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * Config constructor.
     *
     * @param Context               $context
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(Context $context, StoreManagerInterface $storeManager)
    {
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            static::XML_CONFIG_PATH_IS_ACTIVE,
            ScopeInterface::SCOPE_STORES,
            $this->storeManager->getStore()->getId()
        );
    }

    /**
     * @return string
     */
    public function getMode(): string
    {
        return (string)$this->scopeConfig->getValue(static::XML_CONFIG_PATH_MODE);
    }
}
