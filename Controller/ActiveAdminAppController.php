<?php
/**
 * Copyright 2009-2010, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2009-2010, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * ActiveAdmin Plugin AppController
 *
 * @package active_admin
 */
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');

class ActiveAdminAppController extends AppController {
    var $helpers = array('Form','Html','Session','Js'=> array('Jquery'), 'Text', 'Time');
    
    function beforeFilter(){
        parent::beforeFilter();
        if(gettype($this->Dashboard) == NULL){
          $this->loadModel('ActiveAdmin.Dashboard');
          $adminMenu = $this->Dashboard->find('all',array('condition'=>array('Dashboard.name' => 'nav_menu')));
          $modelName = Inflector::camelize(Inflector::singularize($this->request->params['controller']));
          $pluginName = Inflector::camelize($this->request->params['plugin']);
          if(!empty($pluginName)){
              $this->loadModel($pluginName.".".$modelName);
          }else{
              $this->loadModel($modelName);
          }
          $displayField = $this->{$modelName}->displayField; 
          $this->set(compact('adminMenu','displayField','modelName'));
        }
    }
}

