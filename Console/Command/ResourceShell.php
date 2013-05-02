<?php
class ResourceShell extends AppShell {
    public $uses = array('ActiveAdmin.Dashboard');
    
    public function main() {
        if (empty($this->args)){
            $this->out('Usage: ActiveAdmin.resource [MyControllerName] or [Plugin.MyControllerName]');
            $this->out('eg. ./Console/cake ActiveAdmin.resource Posts');
        } else {
            foreach($this->args as $myController){
                $myDash = $this->Dashboard->findByValue($myController);
                if(!empty($myDash)){
                    $this->out("$myController is already part of the dashboard menu");
                }else{
                    
                    $myDash = $this->Dashboard->find('first',array('order'=>'Dashboard.display_order DESC'));
                    $this->Dashboard->create(array('Dashboard'=>array(
                                                    "name" => "nav_menu",
                                                    "value" => $myController,
                                                    "description" => "$myController controller menu",
                                                    "type" => "controller",
                                                    "display_order" => $myDash['Dashboard']['display_order']+1
                                       )));
                    if($this->Dashboard->save()){
                        $this->out("Added $myController to the dashboard");
                    }
                }
            }
        }
        $this->out('Currently installed Dashboard links:');
        $menu = $this->Dashboard->find('all',array('condition'=>array('Dashboard.name' => 'nav_menu')));
        foreach($menu as $item){
            $this->out($item['Dashboard']['value']);
        }
    }
}
