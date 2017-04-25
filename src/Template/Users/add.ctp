<?php
/**
  * @var \App\View\AppView $this
  */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('password');
            echo $this->Form->control('role');
            echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div> -->

<div class="row" id="basic-form" style="background:white; border-radius:4px">
  <div class="col-sm-12">
    <?= $this->Form->create() ?>
  </div>
  <div class="col-sm-12 col-md-6 col-md-offset-3" style="">
    <?= $this->Form->input('username', ['class' => 'form-control']) ?>
  </div>
  <div class="col-sm-12 col-md-6 col-md-offset-3" style="">
    <?= $this->Form->input('first_name', ['class' => 'form-control', 'label' => 'First Name']) ?>
  </div>
  <div class="col-sm-12 col-md-6 col-md-offset-3" style="">
    <?= $this->Form->input('last_name', ['class' => 'form-control', 'label' => 'Last Name']) ?>
  </div>
  <div class="col-sm-12 col-md-6 col-md-offset-3" style="">
    <?= $this->Form->input('password', ['class' => 'form-control', 'Password']) ?>
  </div>
  <!-- <div class="col-sm-12 col-md-6 col-md-offset-3" style="">
    <?= $this->Form->input('role', ['class' => 'form-control', 'label' => 'Role', 'options' => ['Admin','Student','Teacher']]) ?>
  </div>
  <div class="col-sm-12 col-md-6 col-md-offset-3" style="">
    <?= $this->Form->input('active', ['class' => 'form-control', 'label' => 'Active', 'type' => 'checkbox']) ?>
  </div> -->
</div>
<div class="row" style="padding:20px">
  <center>
    <a href="http://104.236.217.201/agileproject/answers" class="btn btn-info" role="button" style="padding:14px 50px">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
  </center>
</div>
