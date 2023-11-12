<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_RestrictCustomersActivity
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\RestrictCustomersActivity\Model\Restriction;

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
    public function isAnyPatternValid($value, array $patterns)
    {
        foreach ($patterns as $pattern) {
            if ($this->isPatternValid($value, $pattern)) {
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
    public function isPatternValid($value, $pattern)
    {
        try {
            return preg_match('#' . $pattern . '#si', $value);
        } catch (\Exception $e) {
            return false;
        }
    }
}
