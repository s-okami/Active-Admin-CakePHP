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
    public $components = array(
        'ActiveAdmin.Filter',
        'Session',
    );

    public $helpers = array('Form', 'Html', 'Session', 'Js' => array('Jquery'), 'Text', 'Time');

    //DONE: add support for additional filters with customizable type (via custom model variable)
    //DONE: add support for admins comments
    //TODO: maybe?, add ability to download data that is displayed (like current RoR ActiveAdmin),
    //TODO: maybe? add support for batch actions like like (current current RoR ActiveAdmin)

    public function beforeFilter()
    {
        parent::beforeFilter();

        //User internal auth if Authake is NOT loaded
        $ext_auth_loaded = CakePlugin::loaded('Authake');
        //if an external auth system is NOT being used then load in the Auth component
        //with the default options so that internal ActiveAdmin auth can be used instead
        if (!isset($ext_auth_loaded) || $ext_auth_loaded == false) {
            $this->Auth = $this->Components->load('Auth', array(
                'loginRedirect' => array('controller' => '', 'action' => 'index'),
                'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
            ));
        }

        /*
         * Set the layout template to the ActiveAdmin which gives us our dashboard and
         * overrides baked template style
         * 管理画面用のスタイルを当てます
        */
        $this->layout = "ActiveAdmin.admin";
    }
}

