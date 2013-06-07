<?php
//If the controller name is set and we're not on the dashboard controller and not on the index or add action
if (isset($controller_name) && isset($resource_id)) {
    $modelName = Inflector::camelize(Inflector::singularize($controller_name));
    $model = ClassRegistry::init($modelName);
    $model_no_comment = $model->aaNoComment;
    ?>
    <div class="comments">
        <?php if (Configure::read('ActiveAdmin.allow_comments') == true && $model_no_comment == false) { ?>
            <!--Generate form for adding comment-->
            <?php echo $this->Form->create('ActiveAdmin.AdminComment',
                array(
                    //   'url' => array('active_admin/admin_comments/add','admin'=>true)
                    'url' => array('controller' => 'admin_comments', 'action' => 'add', 'admin' => true, 'plugin' => 'active_admin'),
                    'class' => 'active_admin_comment',
                )
            ); ?>
            <fieldset class="inputs">
                <?php
                echo $this->Form->input('class', array('type' => 'hidden', 'value' => $controller_name));
                echo $this->Form->input('foreign_id', array('type' => 'hidden', 'value' => $resource_id));
                echo $this->Form->input('author', array('type' => 'hidden', 'value' => "Admin"));
                echo $this->Form->input('body', array('label' => false));
                ?>
            </fieldset>
            <?php echo $this->Form->end(__('Add Comment')); ?>

        <?php } else { ?>
            <h1 class="commenting_disabled">Commenting disabled.</h1>
        <?php } ?>

    </div>
<?php } //end if ?>