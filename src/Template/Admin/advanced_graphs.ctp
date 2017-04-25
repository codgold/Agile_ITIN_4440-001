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
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Group Scores - Custom</h3>
                        </div>
                        <div class="panel-body">
                          <script src="https://code.highcharts.com/highcharts.js"></script>
                          <script src="https://code.highcharts.com/modules/exporting.js"></script>

                          <div id="month" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <script type="text/javascript">
          Highcharts.chart('month', {
            chart: {
              type: 'line'
            },
            title: {
              text: <?php echo json_encode($start); ?> + " through " + <?php echo json_encode($end); ?>
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
              name: '75%',
              data: <?php echo json_encode($monthTopQuart); ?>
            },
            {
              name: '50%',
              data: <?php echo json_encode($monthMidQuart); ?>
            },
            {
              name: '25%',
              data: <?php echo json_encode($monthLowQuart); ?>
            }]
          });
        </script>
