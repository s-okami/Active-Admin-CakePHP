<?php 
/**
* CakePHP ActiveAdmin Plugin
*
*
* Licensed under The MIT License
* Redistributions of files must retain the above copyright notice.
*
* @copyright Gerhard Sletten / TeckniX / Active Admin for RoR (http://activeadmin.info/)
* @link http://github.com/gerhardsletten/Active-Admin-CakePHP/
* @package plugins.ActiveAdmin
* @license MIT License (http://www.opensource.org/licenses/mit-license.php)
*/

/**
* Short description for class.
*
* @package plugins.ActiveAdmin
* @subpackage plugins.ActiveAdmin.config
*/
class DashboardSchema extends CakeSchema {
    
    /**
    * Name
    *
    * @var string
    * @access public
    */
    public $name = 'Dashboard';
    
    /**
    * Before callback
    *
    * @param string Event
    * @return boolean
    * @access public
    */
    public function before($event = array()) {
        return true;
    }
    
    /**
    * After callback
    *
    * @param string Event
    * @return boolean
    * @access public
    */
    public function after($event = array()) {
        return true;
    }
    
    /**
    * Schema for dashboard table
    *
    * @var array
    * @access public
    */
  
  public $dashboard = array(
    'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
    'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'comment' => 'Name of the variable', 'charset' => 'utf8'),
    'value' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'comment' => 'Value of the variable', 'charset' => 'utf8'),
    'description' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'comment' => 'Description of the variable', 'charset' => 'utf8'),
    'type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'comment' => 'Type of the variable', 'charset' => 'utf8'),
    'display_order' => array('type' => 'integer', 'null' => false, 'default' => '0', 'collate' => NULL, 'comment' => 'Variable order placement'),
    'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
  );
}

