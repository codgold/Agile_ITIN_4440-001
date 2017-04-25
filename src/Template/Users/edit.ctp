<div class="row" id="basic-form" style="background:white; border-radius:4px">
  <div class="col-sm-12">
    <?= $this->Form->create($user) ?>
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
  <div class="col-sm-12 col-md-6 col-md-offset-3" style="">
    <?= $this->Form->input('role', ['class' => 'form-control', 'label' => 'Role', 'options' => ['Choose...','Admin','Student','Teacher']]) ?>
  </div>
  <div class="col-sm-12 col-md-6 col-md-offset-3" style="">
    <?= $this->Form->input('active', ['class' => 'form-control', 'label' => 'Active']) ?>
  </div>
</div>
<div class="row" style="padding:20px">
  <center>
    <a href="../" class="btn btn-info" role="button" style="padding:14px 50px">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
  </center>
</div>
