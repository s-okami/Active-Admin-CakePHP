<?php
$params_passed_clean = $this->passedArgs;
unset($params_passed_clean['page']);
$controller_name = $this->request->params['controller'];
$clean_controller_name = Inflector::camelize(Inflector::singularize($controller_name));

if ($controller_name != "download" && $controller_name != "dashboard") {
    $modelName = $clean_controller_name;

//$model = ClassRegistry::init($modelName);
    $request_post = $params_passed_clean;
    if (!empty($this->request->data)) {
        $request_post = $this->request->data[$modelName];
    }
//
//$mod_data = $model->find('all',$request_post);
//debug($mod_data);

//debug($this->request->query);
//debug($request_post);
//debug($controller_name);

    if (isset($request_post)) {
        ?>

        <?php echo $this->Html->link('CSV',
            array_merge(array('controller' => 'download', 'plugin' => 'active_admin', 'action' => 'export', 'model' => $controller_name, 'type' => 'csv'), array('?' => $request_post))
        );

        ?> &nbsp; <?php

        echo $this->Html->link('XML',
            array_merge(array('controller' => $controller_name), array('?' => $request_post))
        );

        ?> &nbsp; <?php

        echo $this->Html->link('JSON',
            array_merge(array('controller' => $controller_name), array('?' => $request_post))
        );
        ?>

    <?php
    }
}?>

