<?php

App::uses('File', 'Utility');
App::uses('Folder', 'Utility');
App::uses('AppController', 'Controller');

class ActiveAdminAppController extends AppController {
    var $helpers = array('Form','Html','Session','Js'=> array('Jquery'), 'Text', 'Time');
    
    function beforeFilter(){
        parent::beforeFilter();
        $this->loadModel('ActiveAdmin.Dashboard');
        $adminMenu = $this->Dashboard->find('all',array('condition'=>array('Dashboard.name' => 'nav_menu')));
        $modelName = Inflector::camelize(Inflector::singularize($this->request->params['controller']));
        $pluginName = Inflector::camelize(Inflector::singularize($this->request->params['plugin']));
        if(!empty($pluginName)){
            $this->loadModel($pluginName.".".$modelName);
        }else{
            $this->loadModel($modelName);
        }
        $displayField = $this->{$modelName}->displayField; 
        $this->set(compact('adminMenu','displayField','modelName'));
    }
}

