
 <div style="text-shadow: 0px 0px 5px rgba(0, 0, 0, .35);text-align: center; color: white; margin-top: 30px;margin-bottom: 50px;"><h1>Civics Practice</h1></div>
<div class="card" style="max-width:500px; margin-left:auto; margin-right:auto;">
  <?= $this->Form->create() ?>
      <fieldset>
       <h1>Welcome</h1>
          <?= $this->Form->input('username', ['label' => false, 'placeholder' => 'Username', 'class' => 'form-control']) ?>
          <?= $this->Form->input('password', ['label' => false, 'placeholder' => 'Password', 'class' => 'form-control']) ?>
      </fieldset>
      <?= $this->Flash->render('bad_login') ?>
  <?= $this->Form->button(__(' Sign In <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>'),['class' => "btn btn-lg btn-block red-button"]); ?>
  <?= $this->Form->end() ?>
  <div style="padding:15px;"></div>
  <a style=" background-color: white; color: black; border: 2px solid black;" href="http://104.236.217.201/agileproject/users/add" class="btn btn-lg" role="button" style="padding:13px;border:solid;border-color:black;border-width:3px;border-radius:6px">New User</a>
   <div style="padding:15px;"></div>
</div>
