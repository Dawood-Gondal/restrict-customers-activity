<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_RestrictCustomersActivity
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\RestrictCustomersActivity\Model\Restriction;

use M2Commerce\RestrictCustomersActivity\Helper\Data as RestrictionHelper;

/**
 * Class Filter
 */
class Filter
{
    /**
     * Check if any pattern valid
     *
     * @param string $value
     * @param array $patterns
     * @return bool
     */
    public function isAnyPatternValid($value, array $patterns, $type)
    {
        foreach ($patterns as $pattern) {
            if ($this->isPatternValid($value, $pattern, $type)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if pattern valid
     *
     * @param string $value
     * @param string $pattern
     * @return bool
     */
    public function isPatternValid($value, $pattern, $type)
    {
        try {
            if ($type == RestrictionHelper::RESTRICT_BY_EMAIL) {
                return preg_match('#' . $pattern . '#si', $value);
            } else {
                return $pattern == $value;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
