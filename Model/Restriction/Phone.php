<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_RestrictCustomersActivity
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\RestrictCustomersActivity\Model\Restriction;

use M2Commerce\RestrictCustomersActivity\Helper\Data as RestrictionHelper;
use M2Commerce\RestrictCustomersActivity\Model\Restriction\Filter as RestrictionFilter;

/**
 * Class Phone
 */
class Phone implements RestrictionInterface
{
    /**
     * @var RestrictionHelper
     */
    protected $restrictionHelper;

    /**
     * @var RestrictionFilter
     */
    protected $restrictionFilter;

    /**
     * @param RestrictionHelper $restrictionHelper
     * @param RestrictionFilter $restrictionFilter
     */
    public function __construct(
        RestrictionHelper $restrictionHelper,
        RestrictionFilter $restrictionFilter
    ) {
        $this->restrictionHelper = $restrictionHelper;
        $this->restrictionFilter = $restrictionFilter;
    }

    /**
     * Check if restriction is valid in allow mode
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        $phonePatterns = $this->restrictionHelper->getRestrictionPatterns(
            RestrictionHelper::RESTRICT_BY_PHONE,
            'patterns'
        );

        if (!empty($phonePatterns)) {
            return $this->restrictionFilter->isAnyPatternValid($value, $phonePatterns);
        }
        return true;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->restrictionHelper->getPhoneRestrictionMessage();
    }
}
