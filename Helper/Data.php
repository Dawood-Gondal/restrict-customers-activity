<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_RestrictCustomersActivity
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\RestrictCustomersActivity\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Data
 */
class Data extends AbstractHelper
{
    const RESTRICT_BY_EMAIL = 'byEmail';
    const RESTRICTION_EMAIL_ERROR_MSG = 'customerRestriction/byEmail/error_message';
    const RESTRICT_BY_PHONE = 'byPhone';
    const RESTRICTION_PHONE_ERROR_MSG = 'customerRestriction/byPhone/error_message';

    /**
     * @var ProductMetadataInterface
     */
    protected $productMetadata;

    /**
     * @param Context $context
     * @param ProductMetadataInterface $productMetadata
     */
    public function __construct(
        Context                  $context,
        ProductMetadataInterface $productMetadata
    ) {
        $this->productMetadata = $productMetadata;
        parent::__construct($context);
    }

    /**
     * @param $restriction
     * @return bool
     */
    public function isRestrictionEnabled($restriction)
    {
        return (bool)$this->scopeConfig->getValue(
            'customerRestriction/' . $restriction . '/enabled',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @param $restriction
     * @param $path
     * @return array
     */
    public function getRestrictionPatterns($restriction, $path)
    {
        $arr = [];
        if ($patterns = $this->getRestrictionData($restriction, $path)) {
            if (version_compare($this->productMetadata->getVersion(), '2.2.0', '>=')) {
                $patterns = json_decode($patterns, true);
            } else {
                $patterns = unserialize($patterns);
            }

            if (is_array($patterns)) {
                foreach ($patterns as $item) {
                    if (!empty($item['pattern'])) {
                        $arr[] = $item['pattern'];
                    }
                }
            }
        }

        return $arr;
    }

    /**
     * @param $restriction
     * @param $path
     * @return mixed
     */
    public function getRestrictionData($restriction, $path)
    {
        return $this->scopeConfig->getValue(
            'customerRestriction/' . $restriction . '/' . $path,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function getEmailRestrictionMessage()
    {
        return (string) $this->scopeConfig->getValue(
            self::RESTRICTION_EMAIL_ERROR_MSG,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function getPhoneRestrictionMessage()
    {
        return (string) $this->scopeConfig->getValue(
            self::RESTRICTION_PHONE_ERROR_MSG,
            ScopeInterface::SCOPE_STORE
        );
    }
}
