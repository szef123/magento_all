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
 

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS `{$this->getTable('aslideshow/slideshow')}`;
CREATE TABLE `{$this->getTable('aslideshow/slideshow')}` (
    `slideshow_id` smallint(6) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) DEFAULT '',
    `transition` varchar(6) DEFAULT NULL,
    `auto_rotation` tinyint(1) DEFAULT NULL,
    `auto_rotation_speed` varchar(3) DEFAULT NULL,
    `slide_controlls` varchar(6) DEFAULT NULL,
    `animation_speed` int(6) DEFAULT NULL,
    `between_block_delay` varchar(6) DEFAULT NULL,
    `blocksize_width` varchar(4) NOT NULL DEFAULT '80',
    `blocksize_height` varchar(4) NOT NULL DEFAULT '80',
    `image_width` int(5) NOT NULL,
    `image_height` varchar(5) NOT NULL,
    `show_text` tinyint(1) NOT NULL DEFAULT '1',
    `background_opacity` varchar(3) DEFAULT '1',
    `sort_order` smallint(5) DEFAULT '0',
    `is_active` tinyint(1) DEFAULT '1',
    PRIMARY KEY (`slideshow_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='My Aslideshow' ;

-- DROP TABLE IF EXISTS `{$this->getTable('aslideshow/slideshow_image')}`;
CREATE TABLE `{$this->getTable('aslideshow/slideshow_image')}` (
    `image_id` smallint(6) NOT NULL AUTO_INCREMENT,
    `label` varchar(255) DEFAULT NULL,
    `caption` varchar(255) DEFAULT NULL,
    `file` varchar(255) DEFAULT NULL,
    `position` smallint(5) DEFAULT '0',
    `disabled` tinyint(1) DEFAULT '1',
    `slideshow_id` smallint(6) DEFAULT '0',
    PRIMARY KEY (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='My Aslideshow Image' ;

-- DROP TABLE IF EXISTS `{$this->getTable('aslideshow/slideshow_store')}`;
CREATE TABLE `{$this->getTable('aslideshow/slideshow_store')}` (
    `slideshow_id` smallint(6) NOT NULL,
    `store_id` smallint(6) NOT NULL,
    PRIMARY KEY (`slideshow_id`,`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='My Aslideshow Store' ;

    ");

$installer->endSetup();
