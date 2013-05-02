<?php if($this->Session->read('Auth.User')): ?>
<p id="utility_nav">
    <span>Welcome,&nbsp;<strong><?php echo ucfirst($this->Session->read('Auth.User.username')); ?></strong></span>
    <?php echo $this->Html->link(__('Logout', true), array('plugin'=>'', 'controller' => 'users', 'action' => 'logout'), array('escape'=>false)); ?>
</p>
<?php endif; ?>
