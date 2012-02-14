<?php 
/* generated on: 2012-02-14 14:53:48 : 1329249228 */
class DashboardSchema extends CakeSchema {

  public $file = 'Dashboard';

  public function before($event = array()) {
    return true;
  }

  public function after($event = array()) {
  }

  
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

