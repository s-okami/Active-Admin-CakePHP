<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-type"/>
    <title><?php echo $title_for_layout; ?></title>
    <?php
      echo $this->Html->css('/active_admin/css/admin');
      // Admin vendor includes Jquery 1.4.2 and other misc libraries
      echo $this->Html->script('/active_admin/js/admin_vendor');
      echo $this->Html->script('/active_admin/js/admin');
      echo $this->fetch('meta');
      echo $this->fetch('css');
      echo $this->fetch('script');
    ?>
  </head>
  <body class="">
    <div id="wrapper">
      <div id="header">
        <h1 id="site_title"><?php echo $this->Html->link('Site', "/"); ?></h1>
        <?php if($this->params['action'] !== 'admin_login' && $adminMenu = $this->requestAction(array('plugin' => 'active_admin', 'controller' => 'dashboard', 'action' => 'menu'))){ ?>
            <ul class="tabbed_navigation" id="tabs">
                <?php foreach($adminMenu as $menuItem):?>
                <li<?php if($this->params['controller'] == $menuItem['Dashboard']['url']['controller']) echo " class='current'"?>><?php echo $this->Html->link(Inflector::humanize(implode(' ', $menuItem['Dashboard']['url'])), array_merge($menuItem['Dashboard']['url'],array('action'=>'index'))); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php } ?>
        <?php echo $this->element('user_info', array(), array('plugin' => 'ActiveAdmin')); ?>
      </div>
      <div id="title_bar">
        <span class="breadcrumb">
          <?php echo $this->Html->link('Admin', array('plugin'=>'active_admin', 'controller'=>'dashboard', 'action'=>'index')); ?>
          <span class="breadcrumb_sep">/</span>
        </span>
        <h1 id="page_title"><?php echo $this->Html->link($this->name, array('controller'=>$this->params['controller'], 'action'=>'index')); ?></h1>
        <div class="action_items">
          <?php if(($this->params['action'] == 'admin_index' || $this->params['action'] == 'admin_view') && $this->params['controller'] != 'dashboard'): ?>
          <span class="action_item"><?php echo $this->Html->link('New '. Inflector::singularize($this->name), array('controller'=>$this->params['controller'], 'action'=>'admin_add'))?></span>
          <?php endif; ?>
          <span class="action_item"><?php echo $this->Html->link('Clear cache', array('plugin'=>'active_admin', 'controller'=>'apis', 'action'=>'clear_cache',$this->params['plugin'],$this->params['controller']))?></span>
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
          echo $this->fetch('content');
          
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

