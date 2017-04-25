<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Completed Question'), ['action' => 'edit', $completedQuestion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Completed Question'), ['action' => 'delete', $completedQuestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $completedQuestion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Completed Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Completed Question'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Answers'), ['controller' => 'Answers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Games'), ['controller' => 'Games', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Game'), ['controller' => 'Games', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="completedQuestions view large-9 medium-8 columns content">
    <h3><?= h($completedQuestion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Answer') ?></th>
            <td><?= $completedQuestion->has('answer') ? $this->Html->link($completedQuestion->answer->id, ['controller' => 'Answers', 'action' => 'view', $completedQuestion->answer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $completedQuestion->has('user') ? $this->Html->link($completedQuestion->user->id, ['controller' => 'Users', 'action' => 'view', $completedQuestion->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= $completedQuestion->has('question') ? $this->Html->link($completedQuestion->question->id, ['controller' => 'Questions', 'action' => 'view', $completedQuestion->question->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Game') ?></th>
            <td><?= $completedQuestion->has('game') ? $this->Html->link($completedQuestion->game->id, ['controller' => 'Games', 'action' => 'view', $completedQuestion->game->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($completedQuestion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Answered') ?></th>
            <td><?= h($completedQuestion->date_answered) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Correct') ?></th>
            <td><?= $completedQuestion->correct ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
