<?php
/**
  * @var \App\View\AppView $this
  */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Question'), ['action' => 'edit', $question->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Question'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Answers'), ['controller' => 'Answers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Completed Questions'), ['controller' => 'CompletedQuestions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Completed Question'), ['controller' => 'CompletedQuestions', 'action' => 'add']) ?> </li>
    </ul>
</nav> -->
<div class="questions view large-9 medium-8 columns content" style="background:white; padding:30px">
    <h3>Question Dashboard</h3>
    <div class="row" >
      <table class="table">
        <th scope="col"><?= __('Id') ?></th>
        <th scope="col"><?= __('Question Text') ?></th>
        <th scope="col"><?= __('Action') ?></th>
        <tr>
          <td><?= $question->id ?></td>
          <td><?= $question->question_text ?></td>
          <td><?= $this->Html->link(__('Edit'), ['controller' => 'Questions', 'action' => 'edit', $question->id]) ?></td>
        </tr>
      </table>
    </div>
    <div class="row" >
        <h4><?= __('Related Answers') ?></h4>
        <?php if (!empty($question->answers)): ?>
        <table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Question Id') ?></th>
                <th scope="col"><?= __('Answer Text') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($question->answers as $answers): ?>
            <tr>
                <td><?= h($answers->id) ?></td>
                <td><?= h($answers->question_id) ?></td>
                <td><?= h($answers->answer_text) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Answers', 'action' => 'view', $answers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Answers', 'action' => 'edit', $answers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Answers', 'action' => 'delete', $answers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $answers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="row" >
        <h4><?= __('Related Completed Questions') ?></h4>
        <?php if (!empty($question->completed_questions)): ?>
        <table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Answer Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Question Id') ?></th>
                <th scope="col"><?= __('Date Answered') ?></th>
                <th scope="col"><?= __('Correct') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($question->completed_questions as $completedQuestions): ?>
            <tr>
                <td><?= h($completedQuestions->id) ?></td>
                <td><?= h($completedQuestions->answer_id) ?></td>
                <td><?= h($completedQuestions->user_id) ?></td>
                <td><?= h($completedQuestions->question_id) ?></td>
                <td><?= h($completedQuestions->date_answered) ?></td>
                <td><?= h($completedQuestions->correct) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CompletedQuestions', 'action' => 'view', $completedQuestions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CompletedQuestions', 'action' => 'edit', $completedQuestions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CompletedQuestions', 'action' => 'delete', $completedQuestions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $completedQuestions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
