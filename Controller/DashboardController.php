<?php
/**
 * Dashboard Controller
 *
 * @property Dashboard $Dashboard
 */
class DashboardController extends ActiveAdminAppController {

    public $name = 'Dashboard';
    public $helpers = array('Html', 'Form');

    //TODO: Dashboard settings page (ability to add/remove controller links

    public function admin_index() {
        
    }
    
    public function admin_menu(){      
        if (!empty($this->request->params['requested'])) {    
            // Code added to get the menu items and filter info from dashboard
            $adminMenu = $this->Dashboard->find('all',array('condition'=>array('Dashboard.name' => 'nav_menu')));
            foreach ($adminMenu as $idx => $menuItem){
                $adminMenu[$idx]['Dashboard']['url'] = array_combine(
                    array('plugin', 'controller'),
                    array_pad(explode('.', Inflector::underscore($menuItem['Dashboard']['value'])), -2, '')
                );
                if(empty($adminMenu[$idx]['Dashboard']['display_title'])){
                    $adminMenu[$idx]['Dashboard']['display_title'] = trim(Inflector::humanize(implode(' ', $adminMenu[$idx]['Dashboard']['url'])));
                }
            }
            return $adminMenu;
        } else{
            throw new NotFoundException('Menu cannot be requested by page');
        }
    }

}
