<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_RestrictCustomersActivity
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\RestrictCustomersActivity\Model\Restriction;

interface RestrictionInterface
{

    /**
     * Check if restriction is valid in allow mode
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid($value);
}
