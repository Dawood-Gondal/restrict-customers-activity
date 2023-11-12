<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_RestrictCustomersActivity
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\RestrictCustomersActivity\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use M2Commerce\RestrictCustomersActivity\Helper\Data as RestrictionHelper;
use M2Commerce\RestrictCustomersActivity\Model\Restriction\Validation as RestrictionValidation;

/**
 * Class CheckoutSubmitBefore
 */
class CheckoutSubmitBefore implements ObserverInterface
{
    /**
     * @var RestrictionValidation
     */
    private $restrictionValidation;

    /**
     * @param RestrictionValidation $restrictionValidation
     */
    public function __construct(
        RestrictionValidation $restrictionValidation
    ) {
        $this->restrictionValidation = $restrictionValidation;
    }

    /**
     * @param Observer $observer
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(Observer $observer)
    {
        $quote = $observer->getEvent()->getQuote();
        // Restricting by Email
        $this->restrictionValidation->validate(RestrictionHelper::RESTRICT_BY_EMAIL, $quote->getCustomerEmail());

        // Restricting by Phone Number
        $this->restrictionValidation->validate(RestrictionHelper::RESTRICT_BY_PHONE, $quote->getShippingAddress()->getTelephone());
        $this->restrictionValidation->validate(RestrictionHelper::RESTRICT_BY_PHONE, $quote->getBillingAddress()->getTelephone());
    }
}
