<?php
/**
 * Dashboard Controller
 *
 * @property Dashboard $Dashboard
 */
class DashboardController extends ActiveAdminAppController {

    var $name = 'Dashboard';
    var $helpers = array('Html', 'Form');

    function admin_index() {
    }
    
    function admin_menu(){      
        // Code added to get the menu items and filter info from dashboard
        $adminMenu = $this->Dashboard->find('all',array('condition'=>array('Dashboard.name' => 'nav_menu')));
        foreach ($adminMenu as $idx => $menuItem){
            $adminMenu[$idx]['Dashboard']['url'] = array_combine(
                array('plugin', 'controller'),
                array_pad(explode('.', Inflector::underscore($menuItem['Dashboard']['value'])), -2, '')
            );
        }
        return $adminMenu;
    }

}
