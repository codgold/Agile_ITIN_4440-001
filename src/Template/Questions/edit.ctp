<?php
/**
  * @var \App\View\AppView $this
  */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $question->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Answers'), ['controller' => 'Answers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Completed Questions'), ['controller' => 'CompletedQuestions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Completed Question'), ['controller' => 'CompletedQuestions', 'action' => 'add']) ?></li>
    </ul>
</nav> -->
<!-- <div class="questions form large-9 medium-8 columns content">
    <?= $this->Form->create($question) ?>
    <fieldset>
        <legend><?= __('Edit Question') ?></legend>
        <?php
            echo $this->Form->control('question_text');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div> -->

<div class="row" id="basic-form" style="background:white; border-radius:4px">
  <div class="col-sm-12">
    <?= $this->Form->create($question) ?>
  </div>
  <div class="col-sm-12 col-md-6 col-md-offset-3" style="">
    <?= $this->Form->input('question_text', ['class' => 'form-control', 'label' => 'Question Text']) ?>
  </div>
</div>
<div class="row" style="padding:20px">
  <center>
    <!-- <button type="cancel" class="cancel btn btn-primary"><?= $this->Html->link('Cancel', array('controller' => 'questions', 'action' => 'index')) ?></button> -->
    <a href="http://104.236.217.201/agileproject/questions" class="btn btn-info" role="button" style="padding:14px 50px">Cancel</a>
    <label> </label>
    <button type="submit" class="btn btn-primary">Submit</button>
  </center>
</div>
