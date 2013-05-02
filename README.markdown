# Active Admin for CakePHP 2.x -- 2.0/2.1 compliance may need some tweaks 

Based on Active Admin for RoR (http://activeadmin.info/). This plugin for CakePHP gives you the same administration interface for the PHP framework. It also uses Nik Chankov's Filter component (http://nik.chankov.net).
This install assumes that you've setup your prefix to be admin using the following routing prefix:

    Configure::write('Routing.prefixes', array('admin'));

Essentially this will create the backend at a url like: http://your-domain-here.com/admin

## Install

1 - Clone the project as "ActiveAdmin" into your apps plugins-folder (app/Plugin/)

2 - Enable the plugin in your app/Config/bootstrap.php file
    
    CakePlugin::load(array('ActiveAdmin' => array('routes' => true)));

### Prepare your app's controllers

3 - For the admin_index function:

    function admin_index() {
        $this->Post->recursive = 0;
        // Add this 
        $filter = $this->Filter->process($this);
        $this->set('posts', $this->paginate(null, $filter));
    }

4 - And update your View/(Controller)/admin_index.ctp views, using a table-header element that enable table-sorting:

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

5 - Create the table for ActiveAdmin using the schema shell:
    
    ./Console/cake schema create --plugin ActiveAdmin --name dashboard

6 - Adding Admin Menu controller items can be done via the provided console shell (eg. adding Posts or the Categories from Blog plugin)
    
    ./Console/cake ActiveAdmin.resource Posts
    ./Console/cake ActiveAdmin.resource Blog.Categories

If you're experiencing some issues with the filter, make sure that the display field is set in your model:
    
    var $displayField = "title";
    
The above would set the filter search on the title field of the model.
