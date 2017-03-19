<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Completed Question'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Answers'), ['controller' => 'Answers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Answer'), ['controller' => 'Answers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="completedQuestions index large-9 medium-8 columns content">
    <h3><?= __('Completed Questions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('answer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_answered') ?></th>
                <th scope="col"><?= $this->Paginator->sort('correct') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($completedQuestions as $completedQuestion): ?>
            <tr>
                <td><?= $this->Number->format($completedQuestion->id) ?></td>
                <td><?= $completedQuestion->has('answer') ? $this->Html->link($completedQuestion->answer->id, ['controller' => 'Answers', 'action' => 'view', $completedQuestion->answer->id]) : '' ?></td>
                <td><?= $completedQuestion->has('user') ? $this->Html->link($completedQuestion->user->id, ['controller' => 'Users', 'action' => 'view', $completedQuestion->user->id]) : '' ?></td>
                <td><?= $completedQuestion->has('question') ? $this->Html->link($completedQuestion->question->id, ['controller' => 'Questions', 'action' => 'view', $completedQuestion->question->id]) : '' ?></td>
                <td><?= h($completedQuestion->date_answered) ?></td>
                <td><?= h($completedQuestion->correct) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $completedQuestion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $completedQuestion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $completedQuestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $completedQuestion->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
