<?php
namespace Yoma\DefaultPayment\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Store\Model\StoreManagerInterface;
use Yoma\DefaultPayment\Helper\Data;

/**
 * Class DefaultPaymentConfigProvider
 * @package Yoma\DefaultPayment\Model
 */
class DefaultPaymentConfigProvider implements ConfigProviderInterface
{
    /**
     * @var Data
     */
    protected $configHelper;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(
        Data $configHelper,
        StoreManagerInterface $storeManager
    ) {
        $this->configHelper = $configHelper;
        $this->storeManager = $storeManager;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getConfig()
    {
        $config = [];
        $store = $this->storeManager->getStore();
        if ($store) {
            $config['default_payment_method'] = $this->configHelper->getDefaultPaymentMethod($store->getId());
        }
        return $config;
    }
}
