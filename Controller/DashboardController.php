<?php
App::uses('AppController', 'Controller');
/**
 * Dashboard Controller
 *
 * @property Dashboard $Dashboard
 */
class DashboardController extends ActiveAdminAppController {

    var $name = 'Dashboard';

    function admin_index() {
        $this->redirect('dashboard');
    }

    function admin_dashboard() {

    }
}
