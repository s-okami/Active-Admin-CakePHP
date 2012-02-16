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
        $adminPrefixes = Configure::read('Routing.prefixes');
        $this->set(compact('adminMenu','adminPrefixes'));
    }
}

