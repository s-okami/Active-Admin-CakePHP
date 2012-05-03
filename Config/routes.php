<?php
/**
 * Plugin Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * 
 */

Router::connect('/admin', array('plugin' => 'active_admin', 'controller' => 'dashboard', 'action' => 'index', 'admin' => true));
Router::connect('/admin/apis/:action/*', array('plugin' => 'active_admin', 'controller' => 'apis', 'admin' => true));
