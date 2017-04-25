<?php $this->assign('title', 'Group'); ?>
<?= $this->Html->css('sb-admin.css'); ?>


<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Group Analytics</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                  <div class="col-lg-4">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Today's Average</h3>
                          </div>
                          <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                          <th><?= $daytot ?> Games</th>
                                          <?php $rounded = number_format((float)$dayavg, 2, '.', ''); ?>
                                          <th><?= $rounded ?> points</th>
                                        </tr>
                                    </thead>
                                  </table>
                                </div>
                          </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Individual Scores</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php foreach($usravg as $usr): ?>
                                            <?php $fullname = $usr['first'] ." ". $usr ['last']; ?>
                                            <tr>
                                                <td><?= $this->Html->link(__($fullname), ['action' => 'individualScores', $usr['id']]) ?></td>
                                                <?php $roundedUsr = number_format((float)$usr['average'], 2, '.', ''); ?>
                                                <td><?= $roundedUsr ?> points</td>
                                            </tr>
                                          <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                      <div class="panel panel-default">
                          <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Custom Graph</h3>
                          </div>
                          <div class="panel-body">
                              <form class="form" action="advancedGraphs" method="post">
                                <div class="form-group row">
                                  <?php $this->Form->create() ?>
                                  <label for="" class="col-2 col-form-label">Start Date</label>
                                  <div class="col-10">
                                    <input class="form-control" type="date" value="" hint="date" name="start">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="" class="col-2 col-form-label">End Date</label>
                                  <div class="col-10">
                                    <input class="form-control" type="date" value="" hint="date" name="end">
                                  </div>
                                </div>
                                <div class="submit"><input class="btn btn-primary" value="Click me" type="submit"></div>
                              </form>
                          </div>
                      </div>
                  </div>
                    <div class="col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Group Scores - Daily</h3>
                            </div>
                            <div class="panel-body">
                              <script src="https://code.highcharts.com/highcharts.js"></script>
                              <script src="https://code.highcharts.com/modules/exporting.js"></script>

                              <div id="week" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                              <div id="month" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
        <script type="text/javascript">
          Highcharts.chart('week', {
            chart: {
              type: 'line'
            },
            title: {
              text: 'This Week'
            },
            xAxis: {
              categories: <?php echo json_encode($week); ?>
            },
            yAxis: {
              title: {
                text: 'Points Correct'
              }
            },
            plotOptions: {
              line: {
                dataLabels: {
                  enabled: false
                },
                enableMouseTracking: true
              }
            },
            series: [{
              name: 'Top Quartile',
              data: <?php echo json_encode($weekTopQuart); ?>
            },
            {
              name: 'Middle Quartile',
              data: <?php echo json_encode($weekMidQuart); ?>
            },
            {
              name: 'Bottom Quartile',
              data: <?php echo json_encode($weekLowQuart); ?>
            }]
          });
          Highcharts.chart('month', {
            chart: {
              type: 'line'
            },
            title: {
              text: 'This Month'
            },
            xAxis: {
              categories: <?php echo json_encode($month); ?>
            },
            yAxis: {
              title: {
                text: 'Points Correct'
              }
            },
            plotOptions: {
              line: {
                dataLabels: {
                  enabled: false
                },
                enableMouseTracking: true
              }
            },
            series: [{
              name: 'Top Quartile',
              data: <?php echo json_encode($monthTopQuart); ?>
            },
            {
              name: 'Middle Quartile',
              data: <?php echo json_encode($monthMidQuart); ?>
            },
            {
              name: 'Bottom Quartile',
              data: <?php echo json_encode($monthLowQuart); ?>
            }]
          });
        </script>
