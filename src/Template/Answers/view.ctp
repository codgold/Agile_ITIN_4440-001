<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="answers view large-9 medium-8 columns content" style="background:white;padding:30px;border-radius:4px">
    <h3>Question Dashboard</h3>
    <table class="table">
      <th scope="col">Question Id</th>
      <th scope="col">Text</th>
      <th scope="col">Action</th>
      <tr>
        <td><?= $this->Html->link($answer[0]['question_id'], ['controller' => 'Questions', 'action' => 'view', $answer[0]['question_id']])?></td>
        <td><?= $answer[0]['answer_text']?></td>
        <td><?= $this->Html->link(__('Edit'), ['controller' => 'Answers', 'action' => 'edit', $answer[0]['id']]) ?></td>
      </tr>
    </table>
</div>
