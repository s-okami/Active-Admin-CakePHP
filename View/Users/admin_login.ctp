<style type="text/css">
/*
    custom css
*/
form input[type=text], form input[type=password] {
    width: 100%;
    box-sizing:border-box;
}


#active_admin_content #main_content_wrapper #main_content {
    width: 100%;
    max-width: 400px;
    margin-right: auto;
    margin-left: auto;
    box-sizing:border-box;
}

#active_admin_content #main_content_wrapper #main_content .submit {
    padding-left: 10px;
    margin-top: 6px;
    margin-bottom: 10px;
}
</style>
<div class="users form">
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Please enter your username and password'); ?></legend>
        <?php echo $this->Form->input('username'); ?>
        <?php echo $this->Form->input('password'); ?>
        <?php echo $this->Form->end(__('Login')); ?>
    </fieldset>
</div>