<?php
/**
 * Maintenance Index controller
 *
 * @category   All4coding
 * @package    All4coding_Maintenance
 * @author     All For Coding <info@all4coding.com>
 */
class All4coding_Maintenance_IndexController extends Mage_Core_Controller_Front_Action 
{
    /**
     * Discount Products index action
     */
    public function indexAction() {
        $response = $this->getResponse();
    	$response->setHeader('HTTP/1.1','503 Service Unavailable');
        $response->setHeader('Status','503 Service Unavailable');
        // $response->setHeader('Retry-After','5000');
        
        $pageId = Mage::getStoreConfig(All4coding_Maintenance_Helper_Data::XML_PATH_MAINTENANCE_PAGE);
        if (!$pageId || !Mage::helper('cms/page')->renderPage($this, $pageId)) {
        	$block = $this->getLayout()->createBlock('all4coding_maintenance/page');
        	$response->appendBody($block->toHtml());
        }
    }
}