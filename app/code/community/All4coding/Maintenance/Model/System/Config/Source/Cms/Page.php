<?php
/**
 * Maintenance Config Source Page
 *
 * @category   All4coding
 * @package    All4coding_Maintenance
 * @author     All For Coding <info@all4coding.com>
 */
class All4coding_Maintenance_Model_System_Config_Source_Cms_Page
{
    protected $_options;
    
    /**
     * Retrieve CMS page id options array
     *
     * @return array
     */
    public function toOptionArray($withEmpty = true)
    {
        if (!$this->_options) {
            $this->_options = Mage::getResourceModel('cms/page_collection')
                ->load()->toOptionIdArray();
            array_unshift($this->_options, array('value' => '', 'label' => Mage::helper('all4coding_maintenance')->__('System Maintenance Page')));
        }
        return $this->_options;
    }
}