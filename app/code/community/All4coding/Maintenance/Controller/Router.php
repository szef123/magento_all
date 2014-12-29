<?php
/**
 * Maintenance Controller Router
 *
 * @category   All4coding
 * @package    All4coding_Maintenance
 * @author     All For Coding <info@all4coding.com>
 */
class All4coding_Maintenance_Controller_Router extends Mage_Core_Controller_Varien_Router_Abstract
{
    /**
     * Initialize Controller Router
     *
     * @param Varien_Event_Observer $observer
     */
    public function initControllerRouters($observer)
    {
        /* @var $front Mage_Core_Controller_Varien_Front */
        $front = $observer->getEvent()->getFront();

        $front->addRouter('all4coding_maintenance', $this);
    }
    
    /**
     * Validate and Match Cms Page and modify request
     *
     * @param Zend_Controller_Request_Http $request
     * @return bool
     */
    public function match(Zend_Controller_Request_Http $request)
    {
        $path = trim($request->getPathInfo(), '/');
        $path = explode('/', $path);
        $adminFrontName = (string)Mage::getConfig()->getNode('admin/routers/adminhtml/args/frontName');
        
        if ($path[0] != $adminFrontName && Mage::getStoreConfig('a4c_maintenance/general/enabled')) {
            $request->setModuleName('all4coding-maintenance')
                ->setControllerName('index')
                ->setActionName('index');
            ;
        }
    	
    	return false;
    }
}