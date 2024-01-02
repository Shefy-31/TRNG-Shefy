<?php
/**
 * @package Ceymox_CustomShipping
 */

declare(strict_types=1);

namespace Ceymox\CustomShipping\Model;

use Magento\Quote\Model\Quote\Address\RateResult\Error;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Shipping\Model\Simplexml\Element;

class Carrier extends AbstractCarrier implements CarrierInterface
{
    public const CODE = 'customshipping';
    /**
     * @var string
     */
    protected $_code = self::CODE;

    /**
     * Construct
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param ErrorFactory $rateErrorFactory
     * @param LoggerInterface $logger
     * @param ResultFactory $rateFactory
     * @param MethodFactory $rateMethodFactory
     * @param ResultFactory $trackFactory
     * @param ErrorFactory $trackErrorFactory
     * @param StatusFactory $trackStatusFactory
     * @param RegionFactory $regionFactory
     * @param CountryFactory $countryFactory
     * @param CurrencyFactory $currencyFactory
     * @param Data $directoryData
     * @param StockRegistryInterface $stockRegistry
     * @param FormatInterface $localeFormat
     * @param array $data
     */
    public function __construct(
        protected \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        protected \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        protected \Psr\Log\LoggerInterface $logger,
        protected \Magento\Shipping\Model\Rate\ResultFactory $rateFactory,
        protected \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        protected \Magento\Shipping\Model\Tracking\ResultFactory $trackFactory,
        protected \Magento\Shipping\Model\Tracking\Result\ErrorFactory $trackErrorFactory,
        protected \Magento\Shipping\Model\Tracking\Result\StatusFactory $trackStatusFactory,
        protected \Magento\Directory\Model\RegionFactory $regionFactory,
        protected \Magento\Directory\Model\CountryFactory $countryFactory,
        protected \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        protected \Magento\Directory\Helper\Data $directoryData,
        protected \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        protected \Magento\Framework\Locale\FormatInterface $localeFormat,
        array $data = []
    ) {
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    /**
     * Get allowed methods
     */

    public function getAllowedMethods()
    {
        return $this;
    }
    
    /**
     * Collect and get rates
     *
     * @param RateRequest $request
     * @return Result|bool|null
     */
    public function collectRates(RateRequest $request)
    {

        $specificCountry = 'IN';
        $specificState = 586;

        $countryId = $request->getDestCountryId();
        $regionId = $request->getDestRegionId();

        if ($countryId == $specificCountry && $specificState == $regionId) {
            $result = $this->rateFactory->create();
            $method = $this->rateMethodFactory->create();
            $method->setCarrier($this->_code);
            $method->setCarrierTitle('Free Shipping');
            $method->setMethod($this->_code);
            $method->setMethodTitle('Free Shipping');
            $method->setCost(0.00);
            $method->setPrice(0.00);
            $result->append($method);
            return $result;
        }
    }
    
    /**
     * Processing additional validation to check is carrier applicable.
     *
     * @param \Magento\Framework\DataObject $request
     * @return $this|bool|\Magento\Framework\DataObject
     */
    public function proccessAdditionalValidation(\Magento\Framework\DataObject $request)
    {
        return true;
    }
}
