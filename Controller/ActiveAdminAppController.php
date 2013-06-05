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
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');

/**
 * ActiveAdmin Plugin AppController
 *
 * @package active_admin
 */

class ActiveAdminAppController extends AppController
{

    //TODO: support for additional filters (via custom model variable)

    public $components = array(
        'ActiveAdmin.Filter',
        'Session',
    );

    public $helpers = array('Form', 'Html', 'Session', 'Js' => array('Jquery'), 'Text', 'Time');

    public function beforeFilter()
    {
        parent::beforeFilter();

        //User internal auth if Authake is not loaded
        $logged = CakePlugin::loaded('Authake');
        if (!isset($logged) && $logged) {
            //Add more components
            $this->components += array('Auth' => array(
                'loginRedirect' => array('controller' => '', 'action' => 'index'),
                'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
            ));
        }

        /*
            管理画面用のスタイルを当てます
        */
        $this->layout = "ActiveAdmin.admin";
    }
}

