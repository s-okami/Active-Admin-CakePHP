<?php
/**
 * Dashboard Controller
 *
 * @property Dashboard $Dashboard
 */
class DashboardController extends ActiveAdminAppController {

    var $name = 'Dashboard';

    function admin_index() {
    }
    
    function admin_menu(){      
        // Code added to get the menu items and filter info from dashboard
        $adminMenu = $this->Dashboard->find('all',array('condition'=>array('Dashboard.name' => 'nav_menu')));
    }

}
