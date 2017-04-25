<?php $this->assign('title', $name); ?>
<?= $this->Html->css('sb-admin.css'); ?>


<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Individual Analytics - <?= $name ?></small>
                        </h1>
                    </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Today's Average</h3>
                          </div>
                          <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                          <th><?= $di_tot ?> Games</th>
                                          <?php $di_round = number_format((float)$di_mean, 2, '.', ''); ?>
                                          <th><?= $di_round ?>%</th>
                                        </tr>
                                    </thead>
                                  </table>
                                </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> All-time Average</h3>
                            </div>
                            <div class="panel-body">
                              <div class="table-responsive">
                                  <table class="table table-bordered table-hover table-striped">
                                      <thead>
                                          <tr>
                                            <th><?= $total ?> Games</th>
                                            <?php $round = number_format((float)$mean, 2, '.', ''); ?>
                                            <th><?= $round ?>%</th>
                                          </tr>
                                      </thead>
                                    </table>
                                  </div>
                            </div>
                          </div>
                      </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Detailed Breakdown</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th><a>Question</a></th>
                                                <th><a>Category</a></th>
                                                <th><a>Average</a></th>
                                                <th><a>Total</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php foreach($questlist as $question): ?>
                                            <tr>
                                                <td><?= $question['text'] ?></td>
                                                <td><?= $question['category'] ?></td>
                                                <td><?= $question['average'] ?>%</td>
                                                <td><?= $question['total'] ?></td>
                                            </tr>
                                          <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <script type="text/javascript">
        function sortTable(table, col, reverse) {
            var tb = table.tBodies[0], // use `<tbody>` to ignore `<thead>` and `<tfoot>` rows
                tr = Array.prototype.slice.call(tb.rows, 0), // put rows into array
                i;
            reverse = -((+reverse) || -1);
            tr = tr.sort(function (a, b) { // sort rows
                return reverse // `-1 *` if want opposite order
                    * (a.cells[col].textContent.trim() // using `.textContent.trim()` for test
                        .localeCompare(b.cells[col].textContent.trim())
                       );
            });
            for(i = 0; i < tr.length; ++i) tb.appendChild(tr[i]); // append each row in order
        }

        function makeSortable(table) {
            var th = table.tHead, i;
            th && (th = th.rows[0]) && (th = th.cells);
            if (th) i = th.length;
            else return; // if no `<thead>` then do nothing
            while (--i >= 0) (function (i) {
                var dir = 1;
                th[i].addEventListener('click', function () {sortTable(table, i, (dir = 1 - dir))});
            }(i));
        }

        function makeAllSortable(parent) {
            parent = parent || document.body;
            var t = parent.getElementsByTagName('table'), i = t.length;
            while (--i >= 0) makeSortable(t[i]);
        }

        window.onload = function () {makeAllSortable();};

        </script>
