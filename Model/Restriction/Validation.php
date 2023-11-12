<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_RestrictCustomersActivity
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\RestrictCustomersActivity\Model\Restriction;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Phrase;
use M2Commerce\RestrictCustomersActivity\Helper\Data as RestrictionHelper;

/**
 * Class Validation
 */
class Validation
{
    /**
     * @var RestrictionHelper
     */
    protected $restrictionHelper;

    /**
     * @var Pool
     */
    protected $restrictionPool;

    /**
     * @param RestrictionHelper $restrictionHelper
     * @param Pool $restrictionPool
     */
    public function __construct(
        RestrictionHelper $restrictionHelper,
        Pool              $restrictionPool
    ) {
        $this->restrictionHelper = $restrictionHelper;
        $this->restrictionPool = $restrictionPool;
    }

    /**
     * @param $restriction
     * @param $value
     * @return bool
     * @throws LocalizedException
     */
    public function validate($restriction, $value)
    {
        if ($this->restrictionHelper->isRestrictionEnabled($restriction)) {
            $observers = $this->restrictionPool->get($restriction);
            if (!empty($observers)) {
                foreach ($observers as $observer) {
                    $isValid = $observer->isValid($value);
                    if ($isValid) {
                        $this->throwException($observer->getErrorMessage());
                    }
                }
            }
        }

        return true;
    }

    /**
     * @param $message
     * @return mixed
     * @throws LocalizedException
     */
    public function throwException($message = null)
    {
        throw new LocalizedException($message instanceof Phrase ? $message : __($message));
    }
}
