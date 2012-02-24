<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-type"/>
    <title><?php echo $title_for_layout; ?></title>
    <?php
      echo $this->Html->css('/active_admin/css/admin');
      echo $this->Html->script('/active_admin/js/admin_vendor');
      echo $this->Html->script('/active_admin/js/admin');
      echo $scripts_for_layout;
    ?>
  </head>
  <body class="">
    <div id="wrapper">
      <div id="header">
        <h1 id="site_title"><?php echo $this->Html->link('Site', "/"); ?></h1>
        <?php if(isset($adminMenu) && !empty($adminMenu)): ?>
        <ul class="tabbed_navigation" id="tabs">
            <?php foreach($adminMenu as $menuItem):
                $menuTitleArray = explode(".",$menuItem['Dashboard']['value']);
                if($menuTitleArray[0] == $menuTitleArray[1]){
                     $menuTitle = $menuTitleArray[0];
                }else {
                    $menuTitle = $menuTitleArray[0]." ".$menuTitleArray[1];
                }
              ?>
            <li<?php if($this->params['controller'] == $menuItem['Dashboard']['value']) echo " class='current'"?>><?php echo $this->Html->link($menuTitle, DS . 'admin' . DS . str_replace(".",DS,strtolower($menuItem['Dashboard']['value']))); ?></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <?php echo $this->element('user_info', array(), array('plugin' => 'ActiveAdmin')); ?>
      </div>
      <div id="title_bar">
        <span class="breadcrumb">
          <?php echo $this->Html->link('Admin', array('controller'=>'apis', 'action'=>'index')); ?>
          <span class="breadcrumb_sep">/</span>
        </span>
        <h1 id="page_title"><?php echo $this->Html->link($this->name, array('controller'=>$this->params['controller'], 'action'=>'index')); ?></h1>
        <div class="action_items">
          <?php if($this->params['action'] == 'admin_index' || $this->params['action'] == 'admin_view'): ?>
          <span class="action_item"><?php echo $this->Html->link('New '. Inflector::singularize($this->name), array('controller'=>$this->params['controller'], 'action'=>'admin_add'))?></span>
          <?php endif; ?>
          <span class="action_item"><?php echo $this->Html->link('Clear cache', array('controller'=>'apis', 'action'=>'admin_clear_cache'))?></span>
        </div>
      </div>
      <div class="with_sidebar" id="active_admin_content">
        <div id="main_content_wrapper">
          <div id="main_content">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->Session->flash('auth'); ?>
          <?php 
          if($this->params['action'] == 'admin_index' && $this->params['controller'] != 'dashboard') {
            echo $this->element('paging_info', array(), array('plugin'=>'ActiveAdmin'));
          }
          echo $content_for_layout;
          
          if($this->params['action'] == 'admin_index' && $this->params['controller'] != 'dashboard') {
            echo $this->element('paging', array(), array('plugin'=>'ActiveAdmin'));
          }
          
          ?>
          </div><!-- end main_content -->
        </div>
        <div id="sidebar">
          <?php 
          if($this->params['action'] == 'admin_index' && $this->params['controller'] != 'dashboard') {
            $file = new File(APP . 'View' . DS . 'Elements' . DS . strtolower($this->name) . '_filter.ctp');
            if ($file->exists()) { 
              echo $this->element(strtolower($this->name) . '_filter');
            } else {
              echo $this->element('sidebar_filter', array(), array('plugin'=>'ActiveAdmin'));
            }
          }
          if($this->params['action'] == 'admin_add' || $this->params['action'] == 'admin_edit') {
            
            $file = new File(APP . 'View' . DS . 'Elements' . DS . strtolower($this->name) . '_edit_info.ctp');
            if ($file->exists()) { 
              echo $this->element(strtolower($this->name) . '_edit_info');
            }
          }
          
          ?>
          
        </div>
      </div>
      <div id="footer">
        <p>Base on <a href="http://www.activeadmin.info">Active Admin</a> 0.3.0</p>
      </div>
    </div>
    <?php echo $this->element('sql_dump'); ?>
  </body>
</html>

