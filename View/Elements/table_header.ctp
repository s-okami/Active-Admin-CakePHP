<thead>           
  <tr>
    <?php foreach($keys as $ktitle=>$key):?>
      <?php
      $class = "sortable";
      if(isset($this->params['named']['sort']) and $this->params['named']['sort'] == $key) {
        if($this->Paginator->sortDir() == 'asc') {
          $class= "sortable sorted-asc";
        } else {
          $class = "sortable sorted-desc";
        }
      }
      ?>
      <?php $this->Paginator->options(array('url' => $this->passedArgs));?>
      <?php $thTitle = is_numeric($ktitle)? ucfirst($key) : $ktitle; ?>
    <th class="<?php echo $class ?>"><?php echo $this->Paginator->sort($key, $thTitle);?></th>
    <?php endforeach; ?>
    <th></th>
  </tr>
</thead>
