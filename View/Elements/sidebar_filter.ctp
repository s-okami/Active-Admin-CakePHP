<?php
  $params_passed_clean = $this->passedArgs;
  unset($params_passed_clean['page']);
  $modelName = Inflector::camelize(Inflector::singularize($this->request->params['controller']));
  $model =& ClassRegistry::init($modelName);
  $displayField = $model->displayField;
  if ($displayField){
?>
<div class="panel sidebar_section" id="filters_sidebar_section">
  <h3>Filters</h3>
  <div class="panel_contents">
    <?php echo $this->Form->create($modelName, array('url'=>array_merge($params_passed_clean, array('action'=>'index')),'class'=>'filter_form'));?>
      <div class="filter_form_field filter_string">
        <label> <?php echo __('Search %s', Inflector::humanize($displayField))?></label>
        <?php echo $this->Form->input($modelName.'.'.$displayField, array('label'=>false, 'div'=>false)); ?>
      </div>
      <div class="filter_form_field filter_date_range">
        <label><?php echo __('Created Between');?></label>
        <?php echo $this->Form->text($modelName.'.created.BETWEEN.0', array('class'=>'datepicker')); ?>
        <span class="seperator">-</span>
        <?php echo $this->Form->text($modelName.'.created.BETWEEN.1', array('class'=>'datepicker')); ?>
      </div>
      <div class="buttons">
        <?php echo $this->Form->submit(__('Filter'), array('div'=>false, 'id'=>'SubmitBtn')) ?>
        <?php echo $this->Html->link(__('Delete Filters'), array('action'=>'index'), array('class'=>'clear_filters_btn clear_action')) ?>
      </div>
    </form>
  </div>
</div>
<?php } ?>

