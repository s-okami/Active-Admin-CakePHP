<?php if ($this->Session->read('Auth.User')): ?>
    <p id="utility_nav">
        <span>Welcome,&nbsp;<strong><?php echo ucfirst($this->Session->read('Auth.User.username')); ?></strong></span>
        <?php echo $this->Html->link(__('Logout', true), array('plugin' => '', 'controller' => 'users', 'action' => 'logout'), array('escape' => false)); ?>
    </p>
<?php elseif ($this->Session->read('Authake.login')): ?>
<!--    <p id="utility_nav">-->
<!--        <span> Welcome, <strong>--><?php //echo ucfirst($this->Helpers->Authake->getLogin()); ?><!--</strong></span>-->
<!--        <!--        Last Login: -->--><?php ////echo ($this->Session->read('Authake.timestamp') == null) ? date('n/d/y') : date('n/d/y', $this->Session->read('Authake.timestamp')); ?>
<!--        <!--        &nbsp;&nbsp;&nbsp;|-->-->
<!--        --><?php //if ($this->Session->read('Authake.login')) {
//            echo $this->Html->link(__('Logout', true), array('plugin' => 'authake', 'controller' => 'user', 'action' => 'logout', 'admin' => false));
//        } ?>
<!--    </p>-->
<?php endif; ?>