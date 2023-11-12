<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_RestrictCustomersActivity
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\RestrictCustomersActivity\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

/**
 * Class PatternMap
 */
class PatternMap extends AbstractFieldArray
{
    /**
     * Internal constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->addColumn('pattern', ['label' => __('Pattern'), 'class' => 'required-entry']);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
        parent::_construct();
    }
}
