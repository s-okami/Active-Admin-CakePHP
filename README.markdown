# Active Admin for CakePHP 2.1 -- 2.0 compliance may need some tweaks 

Based on Active Admin for RoR (http://activeadmin.info/). This plugin for CakePHP gives you the same administration interface for the PHP framework. It also uses Nik Chankov's Filter component (http://nik.chankov.net).
This install assumes that you've setup your prefix to be admin using the following routing prefix:

    Configure::write('Routing.prefixes', array('admin'));

## Install

1 - Clone the project as "ActiveAdmin" into your apps plugins-folder (app/Plugin/)

2 - Enable the plugin in your app/Config/bootstrap.php file
    
    CakePlugin::load(array('ActiveAdmin' => array('routes' => true)));

3 - Open (or create) your app/Controller/AppController.php file and add the following:

    /**
     * Before Filter method
     *
     * @return void
     */
    function beforeFilter() {
        if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
            $this->layout = 'ActiveAdmin.admin';
            // Auth is used here and checked for a valid user
            if ($user = $this->Auth->user()){
                if(!$this->isAuthorized($user)){
                    $this->redirect($this->Auth->logout());
                }
            }
        }else{
            $this->Auth->allow('*');
        }
    }

### Prepare your app's controllers

4 - The Filter component is needed for filtering of records - This can be added on a per controller basis
or simply added to the app/Controller/AppController.php file for all controllers to use

    var $components = array('ActiveAdmin.Filter');

5 - For the admin_index function:

    function admin_index() {
        $this->paginate['Post']['order'] = array('Post.date' => 'desc');
        $this->Post->recursive = 0;
        // Add this 
        $filter = $this->Filter->process($this);
        $this->set('posts', $this->paginate(null, $filter));
    }

6 - And update your View/(Controller)/admin_index.ctp views, using a table-header element that enable table-sorting:

    <table cellpadding="0" cellspacing="0">
    <?php echo $this->element('table_header', array('keys'=>array('id', 'title', 'label' => 'slug','created', 'modified')), array('plugin'=>'ActiveAdmin')); ?>
      <?php
      $i = 0;
      foreach ($posts as $post):
        $class = null;
        if ($i++ % 2 == 0) {
          $class = ' class="even"';
        }
      ?>
      <tr<?php echo $class;?>>
        <td><?php echo $post['Post']['id']; ?>&nbsp;</td>
        <td><?php echo $post['Post']['title']; ?>&nbsp;</td>
        <td><?php echo $post['Post']['slug']; ?>&nbsp;</td>
        <td><?php echo $post['Post']['created']; ?>&nbsp;</td>
        <td><?php echo $post['Post']['modified']; ?>&nbsp;</td>
        <td class="actions">
          <?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?>
          <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
          <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?>
        </td>
      </tr>
    <?php endforeach; ?>
    </table>

7 - Create the table for ActiveAdmin using the schema shell:
    
    ./Console/cake schema create --plugin ActiveAdmin --name dashboard

8 - Adding Admin Menu controller items can be done via the provided console shell (eg. adding Posts or the Categories from Blog plugin)
    
    ./Console/cake ActiveAdmin.resource Posts
    ./Console/cake ActiveAdmin.resource Blog.Categories

If you're experiencing some issues with the filter, make sure that the display field is set in your model:
    
    var $displayField = "title";
    
The above would set the filter search on the title field of the model.
