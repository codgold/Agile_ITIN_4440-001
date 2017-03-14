<div class="card" style="width:200px; margin-left:auto; margin-right:auto;">
  <?= $this->Form->create() ?>
      <fieldset>
          <legend><?= __('Please Sign In') ?></legend>
          <?= $this->Form->input('username', ['label' => false, 'placeholder' => 'Username', 'class' => 'form-control']) ?>
          <?= $this->Form->input('password', ['label' => false, 'placeholder' => 'Password', 'class' => 'form-control']) ?>
      </fieldset>
      <?= $this->Flash->render('bad_login') ?>
  <?= $this->Form->button(__('Sign In'),['class' => "btn btn-lg btn-block red-button"]); ?>
  <?= $this->Form->end() ?>
  <?= $this->Html->link('Add User',['class' => "btn btn-lg btn-block red-button", 'controller' => 'users', 'action' => 'add']); ?>
</div>
