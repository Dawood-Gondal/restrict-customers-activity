<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_RestrictCustomersActivity
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\RestrictCustomersActivity\Plugin;

use Magento\Customer\Model\AccountManagement as CustomerAccountManagement;
use Magento\Customer\Api\Data\CustomerInterface;
use M2Commerce\RestrictCustomersActivity\Helper\Data as RestrictionHelper;
use M2Commerce\RestrictCustomersActivity\Model\Restriction\Validation as RestrictionValidation;

/**
 * Class AccountManagement
 */
class AccountManagement
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
     * {@inheritdoc}
     */
    public function beforeAuthenticate(
        CustomerAccountManagement $subject,
        $email,
        $password
    ) {
        $this->restrictionValidation->validate(RestrictionHelper::RESTRICT_BY_EMAIL, $email);
        return [$email, $password];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeCreateAccount(
        CustomerAccountManagement $subject,
        CustomerInterface         $customer,
        $password = null,
        $redirectUrl = ''
    ) {
        $this->restrictionValidation->validate(RestrictionHelper::RESTRICT_BY_EMAIL, $customer->getEmail());
        return [$customer, $password, $redirectUrl];
    }
}
