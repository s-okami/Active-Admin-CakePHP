<?php
  $params_passed_clean = $this->passedArgs;
  unset($params_passed_clean['page']);
  $modelName = Inflector::camelize(Inflector::singularize($this->request->params['controller']));
  $model = ClassRegistry::init($modelName);
  $displayField = $model->displayField;
  $aaFilter = $model->aaFilter ? $model->aaFilter : array();
  if ($displayField){
?>
<div class="panel sidebar_section" id="filters_sidebar_section">
  <h3>Filters</h3>

  <div class="panel_contents">
    <?php echo $this->Form->create($modelName, array('url'=>array_merge($params_passed_clean, array('action'=>'index')),'class'=>'filter_form'));?>

      <!--default filter for model display field-->
      <div class="filter_form_field <?php echo "filter_".$model->getColumnType($displayField); ?>">
        <label> <?php echo __('Search %s', Inflector::humanize($displayField))?></label>
        <?php echo $this->Form->input($modelName.'.'.$displayField, array('label'=>false, 'required'=>false, 'div'=>false)); ?>
      </div>

        <!--Loop over any defined extra filter fields-->
          <?php if(!empty($aaFilter)): foreach($aaFilter as $filter_field): ?>
            <?php $filter_field_type = "filter_".$model->getColumnType($filter_field);?>

              <div class="filter_form_field <?php echo $filter_field_type; ?>">
                  <label> <?php echo __('Search %s', Inflector::humanize($filter_field))?></label>
                  <?php echo $this->Form->input($modelName.'.'.$filter_field, array('label'=>false, 'required'=> false, 'div'=>false)); ?>
              </div>

          <?php endforeach; endif ?>

      <!--default filter for creation date-->
      <div class="filter_form_field filter_date_range">
        <label><?php echo __('Created Between');?></label>
        <?php echo $this->Form->text($modelName.'.created.BETWEEN.0', array('class'=>'datepicker')); ?>
        <span class="seperator">-</span>
        <?php echo $this->Form->text($modelName.'.created.BETWEEN.1', array('class'=>'datepicker')); ?>
      </div>

     <!--filter form buttons-->
      <div class="buttons">
        <?php echo $this->Form->submit(__('Filter'), array('div'=>false, 'id'=>'SubmitBtn')) ?>
        <?php echo $this->Html->link(__('Clear Filters'), "#", array('class'=>'clear_filters_btn clear_action')) ?>
      </div>

      <!--close form->
    </form>
  </div>
<?php } ?>

