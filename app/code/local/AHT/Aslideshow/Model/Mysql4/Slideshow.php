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
 
class AHT_Aslideshow_Model_Mysql4_Slideshow extends Mage_Core_Model_Mysql4_Abstract {
    /**
     * Initialize resource model
     */
    protected function _construct() {
        $this->_init('aslideshow/slideshow', 'slideshow_id');
    }

    /**
     * Load images
     */
    public function loadImage(Mage_Core_Model_Abstract $object) {
        return $this->__loadImage($object);
    }
    /**
     *
     * @param Mage_Core_Model_Abstract $object
     */
    protected function _afterLoad(Mage_Core_Model_Abstract $object) {
        if (!$object->getIsMassDelete()) {
            $object = $this->__loadStore($object);
            $object = $this->__loadImage($object);
        }

        return parent::_afterLoad($object);
    }

    /**
     * Retrieve select object for load object data
     *
     * @param string $field
     * @param mixed $value
     * @return Zend_Db_Select
     */
    protected function _getLoadSelect($field, $value, $object) {
        $select = parent::_getLoadSelect($field, $value, $object);

        if ($data = $object->getStoreId()) {
            $select->join(
                    array('store' => $this->getTable('aslideshow/slideshow_store')), $this->getMainTable().'.slideshow_id = `store`.slideshow_id')
                    ->where('`store`.store_id in (0, ?) ', $data);
        }
        $select->order('name DESC')->limit(1);

        return $select;
    }

    /**
     * Call-back function
     */
    protected function _afterSave(Mage_Core_Model_Abstract $object) {
        if (!$object->getIsMassStatus()) {
            $this->__saveToStoreTable($object);
            $this->__saveToImageTable($object);
        }

        return parent::_afterSave($object);
    }

    /**
     * Call-back function
     */
    protected function _beforeDelete(Mage_Core_Model_Abstract $object) {
        // Cleanup stats on blog delete
        $adapter = $this->_getReadAdapter();
        // 1. Delete blog/store
        $adapter->delete($this->getTable('aslideshow/slideshow_store'), 'slideshow_id='.$object->getId());
        return parent::_beforeDelete($object);
    }

    /**
     * Load stores
     */
    private function __loadStore(Mage_Core_Model_Abstract $object) {
        $select = $this->_getReadAdapter()->select()
                ->from($this->getTable('aslideshow/slideshow_store'))
                ->where('slideshow_id = ?', $object->getId());

        if ($data = $this->_getReadAdapter()->fetchAll($select)) {
            $array = array();
            foreach ($data as $row) {
                $array[] = $row['store_id'];
            }
            $object->setData('store_id', $array);
        }
        return $object;
    }

    /**
     * Load images
     */
    private function __loadImage(Mage_Core_Model_Abstract $object) {
        $select = $this->_getReadAdapter()->select()
                ->from($this->getTable('aslideshow/slideshow_image'))
                ->where('slideshow_id = ?', $object->getId())
                ->order(array('position ASC', 'image_id'));

        $object->setData('image', $this->_getReadAdapter()->fetchAll($select));
        return $object;
    }

    /**
     * Save stores
     */
    private function __saveToStoreTable(Mage_Core_Model_Abstract $object) {
        if (!$object->getData('stores')) {
            $condition = $this->_getWriteAdapter()->quoteInto('slideshow_id = ?', $object->getId());
            $this->_getWriteAdapter()->delete($this->getTable('aslideshow/slideshow_store'), $condition);

            $storeArray = array(
                'slideshow_id' => $object->getId(),
                'store_id' => '0');
            $this->_getWriteAdapter()->insert(
                    $this->getTable('aslideshow/slideshow_store'), $storeArray);
            return true;
        }

        /*$object = $this->__loadStore($object);
        if ($storeList = $object->getStoreId()) {
            $first = implode('|',asort($storeList));
            $second = implode('|',asort($object->getData('stores')));
            if (strcmp($first,$second) == 0) {
                return true;
            }
        }*/

        $condition = $this->_getWriteAdapter()->quoteInto('slideshow_id = ?', $object->getId());
        $this->_getWriteAdapter()->delete($this->getTable('aslideshow/slideshow_store'), $condition);
        foreach ((array)$object->getData('stores') as $store) {
            $storeArray = array();
            $storeArray['slideshow_id'] = $object->getId();
            $storeArray['store_id'] = $store;
            $this->_getWriteAdapter()->insert(
                    $this->getTable('aslideshow/slideshow_store'), $storeArray);
        }
    }

    /**
     * Save stores
     */
    private function __saveToImageTable(Mage_Core_Model_Abstract $object) {
        if ($_imageList = $object->getData('images')) {
            $_imageList = Zend_Json::decode($_imageList);
            if (is_array($_imageList) and sizeof($_imageList) > 0) {
                $_imageTable = $this->getTable('aslideshow/slideshow_image');
                $_adapter = $this->_getWriteAdapter();
                $_adapter->beginTransaction();
                try {
                    $condition = $this->_getWriteAdapter()->quoteInto('slideshow_id = ?', $object->getId());
                    $this->_getWriteAdapter()->delete($this->getTable('aslideshow/slideshow_image'), $condition);

                    foreach ($_imageList as &$_item) {
                        if (isset($_item['removed']) and $_item['removed'] == '1') {
                            $_adapter->delete($_imageTable, $_adapter->quoteInto('image_id = ?', $_item['value_id'], 'INTEGER'));
                        } else {
                            $_data = array(
                                'label'     => $_item['label'],
                                'caption'     => $_item['caption'],
                                'file'      => $_item['file'],
                                'position'  => $_item['position'],
                                'disabled'  => $_item['disabled'],
                                'slideshow_id' => $object->getId());
                            $_adapter->insert($_imageTable, $_data);
                        }
                    }
                    $_adapter->commit();
                } catch (Exception $e) {
                    $_adapter->rollBack();
                    echo $e->getMessage();
                }
            }
        }
    }

    public function updateIsActive($status, $slideshowId) {
        $write = $this->_getWriteAdapter();
        $dataTable        = $this->getTable('aslideshow/slideshow');
        try {
            $condition = array();
		    $condition[] = $write->quoteInto('slideshow_id=?', $slideshowId);
		    $data = array(
			    'is_active'     => $status,
		    );
		    $write->update($dataTable, $data, $condition);
        } catch (Exception $e) {
            echo $e->getMessage();
        }    
    }
}
