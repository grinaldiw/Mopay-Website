<!doctype html>
<!--[if IE 8]>         
<html class="ie8"> <![endif]-->
<!--[if IE 9]>         
<html class="ie9"> <![endif]-->
<!--[if gt IE 9]><!--> 
<html> 
<!--<![endif]-->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title> <?= $location; ?> - Moklet Payment </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="shortcut icon" href="demo/images/icon.png">
        <link rel="stylesheet" href="<?= base_url(); ?>dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>dist/css/veneto-admin.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>demo/css/demo.css">
        <link rel="stylesheet" href="<?= base_url(); ?>dist/assets/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="<?= base_url(); ?>dist/css/plugins/rickshaw.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>dist/css/plugins/morris.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>dist/css/plugins/jquery-select2.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>dist/css/plugins/jquery-dataTables.min.css">
        <!--[if lt IE 9]>
        <script src="dist/assets/libs/html5shiv/html5shiv.min.js"></script>
        <script src="dist/assets/libs/respond/respond.min.js"></script>
        <![endif]-->
        <style>
        #suggesstion-box {
            height: 100%;
            width: 100%;
            background-color: #f7f7f7;
        }
        #suggesstion-box > li {
            list-style: none;
            padding: 5px 5px 5px 5px;
            display: block;
            position: relative;
        }
        #suggesstion-box > li:hover {
            background-color: #e2e2e2;
        }
        </style>
    </head>
    <body class="">
        <header>
            <nav class="navbar navbar-default navbar-static-top no-margin" role="navigation">
                <div class="navbar-brand-group">
                    <a class="navbar-sidebar-toggle navbar-link" data-sidebar-toggle>
                        <i class="fa fa-lg fa-fw fa-bars"></i>
                    </a>
                    <a class="navbar-brand hidden-xxs">
                        <span class="sc-visible">
                            MP
                        </span>
                        <span class="sc-hidden">
                            <span class="bold">MO</span>PAY - Moklet Payment
                        </span>
                    </a>
                </div>
            </nav>
        </header>
        <div class="page-wrapper">
            <aside class="sidebar sidebar-default">
                <div class="sidebar-profile">
                    <img class="img-circle profile-image" src="<?= base_url(); ?>demo/images/profile.jpg">

                    <div class="profile-body">
                        <h4><?= $this->session->userdata('name'); ?></h4>

                        <div class="sidebar-user-links">
                            <a class="btn btn-link btn-xs" href="logout" data-placement="bottom" data-toggle="tooltip" data-original-title="Logout"><i class="fa fa-sign-out"></i></a>
                        </div>
                    </div>
                </div>
                <nav>
                    <h5 class="sidebar-header">Navigation</h5>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="transaction" title="Transaction"><i class="fa fa-lg fa-fw fa-exchange"></i> Transaction <label class="label label-success pull-right"><i class="fa fa-refresh"></i></label></a></li>
                        <li><a href="users" title="User List"><i class="fa fa-lg fa-fw fa-users"></i> User List <label class="label label-info pull-right"><i class="fa fa-list"></i></label></a></li>
                        <li><a href="deposit" title="Deposit"><i class="fa fa-lg fa-fw fa-plus-square"></i> Deposit <label class="label label-warning pull-right"><i class="fa fa-plus"></i></label></a></li>
                        <li><a href="withdraw" title="Withdraw"><i class="fa fa-lg fa-fw fa-upload"></i> Withdraw <label class="label label-danger pull-right"><i class="fa fa-minus"></i></label></a></li>
                        <li><a href="setting" title="Setting"><i class="fa fa-lg fa-fw fa-cogs"></i> Setting</a></li>
                        <li><a href="logout" title="Logout"><i class="fa fa-lg fa-fw fa-sign-out"></i> Logout</a></li>
                    </ul>
                    <h5 class="sidebar-header">Summary</h5>
                    <ul class="sidebar-summary">
                        <li>
                            <div class="mini-chart mini-chart-block">
                                <div class="chart-details">
                                    <div class="chart-name">Total Withdraw</div>
                                    <div class="chart-value">Rp <?= number_format($withdraw->total); ?></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="mini-chart mini-chart-block">
                                <div class="chart-details">
                                    <div class="chart-name">Total Deposit</div>
                                    <div class="chart-value">Rp <?= number_format($deposit->total); ?></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="mini-chart mini-chart-block">
                                <div class="chart-details">
                                    <div class="chart-name">Minus</div>
                                    <div class="chart-value">Rp <?= number_format($deposit->total - $withdraw->total); ?></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="mini-chart mini-chart-block">
                                <div class="chart-details">
                                    <div class="chart-name">User Active</div>
                                    <div class="chart-value"><?= $user; ?></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </aside>

            <div class="page-content">

                <div class="container-fluid-md">
                    <div class="alert alert-info">
                        <strong>Welcome, <?= $this->session->userdata('name'); ?>.</strong> Manage user & transaction available.
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-lg-4">
                            <div class="panel panel-metric panel-metric-sm">
                                <div class="panel-body panel-body-primary">
                                    <div class="metric-content metric-icon">
                                        <div class="value">
                                            <?= $user; ?> <i class="fa fa-check"></i>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <header>
                                            <h3 class="thin">Total Users</h3>
                                        </header>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="panel panel-metric panel-metric-sm">
                                <div class="panel-body panel-body-success">
                                    <div class="metric-content metric-icon">
                                        <div class="value">
                                            <?= $transaction; ?> <i class="fa fa-check"></i>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-exchange"></i>
                                        </div>
                                        <header>
                                            <h3 class="thin">Total Transaction</h3>
                                        </header>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="panel panel-metric panel-metric-sm">
                                <div class="panel-body panel-body-inverse">
                                    <div class="metric-content metric-icon">
                                        <div class="value">
                                            Rp <?= number_format($money->total); ?>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <header>
                                            <h3 class="thin">Total Money</h3>
                                        </header>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php $this->load->view($view); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="dist/assets/libs/jquery/jquery.min.js"></script>
        <script src="dist/assets/bs3/js/bootstrap.min.js"></script>
        <script src="dist/assets/plugins/jquery-navgoco/jquery.navgoco.js"></script>
        <script src="dist/js/main.js"></script>

        <!--[if lt IE 9]>
        <script src="dist/assets/plugins/flot/excanvas.min.js"></script>
        <![endif]-->
        <script src="dist/assets/plugins/jquery-sparkline/jquery.sparkline.js"></script>
        <script src="demo/js/demo.js"></script>

        <script src="dist/assets/plugins/jquery-datatables/js/jquery.dataTables.js"></script>
        <script src="dist/assets/plugins/jquery-datatables/js/dataTables.tableTools.js"></script>
        <script src="dist/assets/plugins/jquery-datatables/js/dataTables.bootstrap.js"></script>
        <script src="dist/assets/plugins/jquery-select2/select2.min.js"></script>
        <script src="demo/js/tables-data-tables.js"></script>

        <script src="dist/assets/plugins/flot/jquery.flot.js"></script>
        <script src="dist/assets/plugins/flot/jquery.flot.resize.js"></script>
        <script src="dist/assets/plugins/raphael/raphael-min.js"></script>
        <script src="dist/assets/plugins/morris/morris.min.js"></script>
        <script src="demo/js/dashboard.js"></script>



    </body>
</html>
