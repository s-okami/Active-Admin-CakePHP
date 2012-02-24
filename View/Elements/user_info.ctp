<?php if($this->Session->read('Auth.User')): ?>
<div id="utility_nav">
        Welcome, <strong><?php echo ucfirst($this->Session->read('Auth.User.username')); ?></strong><br />
        Last Login: <?php echo date('n/d/y', strtotime($this->Session->read('Auth.User.last_login'))); ?>&nbsp;&nbsp;&nbsp;|
        <?php if($this->Session->read('Auth.User')){ echo $this->Html->link(__('Logout', true), array('plugin'=>'', 'controller' => 'users', 'action' => 'logout'), array('escape'=>false));} ?>
</div>
<?php endif; ?>
