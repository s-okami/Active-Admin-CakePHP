<?php

/**
 * Api Controller
 *
 * @property Api $Apis
 */

App::import('Lib', 'ActiveAdmin.ClearCache');

class ApisController extends ActiveAdminAppController {

  function admin_clear_cache() {
      $args = func_get_args();
        // Load clear cache lib
        $ClearCache = new ClearCache();
        // Clear both file and engine
        $ClearCache->run();
        $this->redirect(array('plugin' => $args[0], 'controller' => $args[1], 'action' => 'index'));
  }
  
}
