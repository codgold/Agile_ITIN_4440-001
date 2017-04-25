<?php $this->assign('title', 'Admin'); ?>
<?= $this->Html->css('sb-admin.css'); ?>


<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>ISC Dashboard</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-4">
                      <div>
                          <div class="panel panel-primary">
                              <div class="panel-heading">
                                  <div class="row">
                                      <div class="col-xs-3">
                                          <i class="fa fa-comments fa-5x"></i>
                                      </div>
                                      <div class="col-xs-9 text-right">
                                          <div class="huge">Users</div>
                                          <div>Manage Users</div>
                                      </div>
                                  </div>
                              </div>
                              <a href="http://104.236.217.201/agileproject/users">
                                  <div class="panel-footer">
                                      <span class="pull-left"><form action="http://104.236.217.201/agileproject/users">
      <input type="submit" value="Users" />
  </form></span>
                                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                      <div class="clearfix"></div>
                                  </div>
                              </a>
                          </div>
                      </div>
                      <div>
                          <div class="panel panel-green">
                              <div class="panel-heading">
                                  <div class="row">
                                      <div class="col-xs-3">
                                          <i class="fa fa-tasks fa-5x"></i>
                                      </div>
                                      <div class="col-xs-9 text-right">
                                          <div class="huge">Questions</div>
                                          <div>Edit Questions</div>
                                      </div>
                                  </div>
                              </div>
                              <!-- <a href="http://104.236.217.201/agileproject/answers"> -->
                              <a href="http://104.236.217.201/agileproject/questions">
                                  <div class="panel-footer">
                                      <!-- <span class="pull-left"><form action="http://104.236.217.201/agileproject/answers"> -->
                                      <span class="pull-left"><form action="http://104.236.217.201/agileproject/questions">
      <input type="submit" value="Questions" /></form></span>
                                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                      <div class="clearfix"></div>
                                  </div>
                              </a>
                          </div>
                      </div>
                      <div>
                          <div class="panel panel-red">
                              <div class="panel-heading">
                                  <div class="row">
                                      <div class="col-xs-3">
                                          <i class="fa fa-tasks fa-5x"></i>
                                      </div>
                                      <div class="col-xs-9 text-right">
                                          <div class="huge">Answers</div>
                                          <div>Edit Answers</div>
                                      </div>
                                  </div>
                              </div>
                              <!-- <a href="http://104.236.217.201/agileproject/answers"> -->
                              <a href="http://104.236.217.201/agileproject/answers">
                                  <div class="panel-footer">
                                      <!-- <span class="pull-left"><form action="http://104.236.217.201/agileproject/answers"> -->
                                      <span class="pull-left"><form action="http://104.236.217.201/agileproject/answers">
      <input type="submit" value="Answers" /></form></span>
                                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                      <div class="clearfix"></div>
                                  </div>
                              </a>
                          </div>
                      </div>
                      <div >
                          <div class="panel panel-yellow">
                              <div class="panel-heading">
                                  <div class="row">
                                      <div class="col-xs-3">
                                          <i class="fa fa-shopping-cart fa-5x"></i>
                                      </div>
                                      <div class="col-xs-9 text-right">
                                          <div class="huge">Statistics</div>
                                          <div>View Group Statistics</div>
                                      </div>
                                  </div>
                              </div>
                              <a href="http://104.236.217.201/agileproject/Admin/groupScores">
                                  <div class="panel-footer">
                                      <span class="pull-left"><form action="http://104.236.217.201/agileproject/Admin/groupScores">
      <input type="submit" value="Statistics" /></form></span>
                                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                      <div class="clearfix"></div>
                                  </div>
                              </a>
                          </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Recent Games</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group notranslate">
                                  <?php foreach($recentgames as $game): ?>
                                    <a href="#" class="list-group-item">
                                        <span class="badge"><?= $game->score ?></span>
                                        <i class="fa fa-fw fa-calendar"></i> <?= $game->first_name ?> <?= $game->last_name ?>
                                    </a>
                                  <?php endforeach; ?>
                                </div>
                                <!-- <div class="text-right">
                                    <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> High Scores</h3>
                          </div>
                          <div class="panel-body">
                              <div class="list-group notranslate">
                                <?php foreach($topgames as $tgame): ?>
                                  <a href="#" class="list-group-item">
                                      <span class="badge"><?= $tgame->score ?></span>
                                      <i class="fa fa-fw fa-calendar"></i> <?= $tgame->first_name ?> <?= $tgame->last_name ?>
                                  </a>
                                <?php endforeach; ?>
                              </div>
                              <!-- <div class="text-right">
                                  <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                              </div> -->
                          </div>
                      </div>
                    </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
