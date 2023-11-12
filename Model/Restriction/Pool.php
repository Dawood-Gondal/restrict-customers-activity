<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_RestrictCustomersActivity
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\RestrictCustomersActivity\Model\Restriction;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\ObjectManagerInterface;

/**
 * Class Pool
 */
class Pool
{
    /**
     * @var ObjectManagerInterface
     */
    protected $observerFactory;

    /**
     * @var array
     */
    protected $restrictions;

    /**
     * @param ObjectManagerInterface $observerFactory
     * @param array $restrictions
     */
    public function __construct(
        ObjectManagerInterface $observerFactory,
        array                  $restrictions
    ) {
        $this->observerFactory = $observerFactory;
        $this->restrictions = $restrictions;
    }

    /**
     * @param $restriction
     * @return array
     * @throws LocalizedException
     */
    public function get($restriction)
    {
        $observers = [];
        if (!empty($this->restrictions[$restriction])) {
            foreach ($this->restrictions[$restriction] as $observerClass) {
                $observers[] = $this->createObserver($observerClass);
            }
        }
        return $observers;
    }

    /**
     * @param $observerClass
     * @return RestrictionInterface
     * @throws LocalizedException
     */
    protected function createObserver($observerClass)
    {
        $observer = $this->observerFactory->create($observerClass);
        if (!$observer instanceof RestrictionInterface) {
            throw new LocalizedException(
                __('Restriction observer "%1" should instanceof %2', $observerClass, RestrictionInterface::class)
            );
        }
        return $observer;
    }
}
