<?php
/**
  * @var \App\View\AppView $this
  */
?>


<div class="row" id="basic-form" style="background:white; border-radius:4px">
  <div class="col-sm-12">
    <?= $this->Form->create($answer[0]) ?>
  </div>
  <div class="col-sm-12 col-md-6 col-md-offset-3" style="">
    <?= $this->Form->input('answer_text', ['class' => 'form-control', 'label' => 'Answer Text']) ?>
  </div>
</div>
<div class="row" style="padding:20px">
  <center>
    <!-- <button type="cancel" class="btn btn-info"><?= $this->Html->link('Cancel', array('controller' => 'answers', 'action' => 'index')) ?></button> -->
    <a href="http://104.236.217.201/agileproject/answers" class="btn btn-info" role="button" style="padding:14px 50px">Cancel</a>
    <label> </label>
    <button type="submit" class="btn btn-primary">Submit</button>
  </center>
</div>
