<?php
/**
 * AHT_Aslideshow Extension
 *
 * @category    Local
 * @package     AHT_Aslideshow
 * @author      dungnv (dungnv@arrowhitech.com)
 * @copyright   Copyright(c) 2011 Arrowhitech Inc. (http://www.arrowhitech.com)
 *
 */

/**
 *
 * @category   Local
 * @package    AHT_Aslideshow
 * @author     dungnv <dungnv@arrowhitech.com>
 */
class AHT_Aslideshow_Block_Slideshow extends Mage_Catalog_Block_Product_Abstract {//Mage_Core_Block_Template {
    protected $_isActive = 1;
    protected $_collection;
    protected $_collectionwidget;
    protected $_aslideshowId = null;

    protected function _getCollection($position = null) {
        if ($this->_collection) {
            return $this->_collection;
        }

        $storeId = Mage::app()->getStore()->getId();
        $this->_collection = Mage::getModel('aslideshow/slideshow')->getCollection()
                ->addEnableFilter($this->_isActive);
        if (!Mage::app()->isSingleStoreMode()) {
            $this->_collection->addStoreFilter($storeId);
        }
        return $this->_collection;
    }
    
    protected function _getCollectionWidget($aslideshowId = null) {
        if ($this->_collectionwidget) {
            return $this->_collectionwidget;
        }
        if($aslideshowId != null) {
            $storeId = Mage::app()->getStore()->getId();
            $this->_collectionwidget = Mage::getModel('aslideshow/slideshow')->load($aslideshowId);
            return $this->_collectionwidget;
        }
        else {
            return false;
        }
    }

    public function setAslideshowId($aslideshowId)
    {
        $this->_aslideshowId = $aslideshowId;
        return $this;
    }
}
