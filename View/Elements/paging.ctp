<div id="index_footer">
<?php if(isset($this->Paginator)): ?>
<nav class="pagination">
  <?php if($this->Paginator->hasPrev()):?>
  <span class="first">
    <?php echo $this->Paginator->first('&laquo;'.__('First', true), array('escape' => false), null, array('class'=>'disabled', 'escape' => false));?>
  </span>
  <span class="prev">
    <?php echo $this->Paginator->prev('&lt;'.__('Prev', true), array('escape' => false), null, array('class'=>'disabled', 'escape' => false));?>
  </span>
  <?php endif; ?>
  <?php echo $this->Paginator->numbers(array('separator' => '&nbsp;'));?>
  <?php if($this->Paginator->hasNext()):?>
    <span class="next">
      <?php echo $this->Paginator->next(__('Next', true).' &gt;', array('escape' => false), null, array('class'=>'disabled', 'escape' => false));?>
  </span>
  <span class="last">
    <?php echo $this->Paginator->last(__('Last', true).' &raquo;', array('escape' => false), null, array('class'=>'disabled', 'escape' => false));?>
  </span>
  <?php endif; ?>
</nav>
<?php endif; ?>
</div>
