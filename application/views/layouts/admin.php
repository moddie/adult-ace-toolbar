<!DOCTYPE html>
<head>
    <title>Home Page</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!--    <link href="<?php echo URL::base(true) ?>css/common.css" type="text/css" rel="Stylesheet">
    <link href="<?php echo URL::base(true) ?>css/reset.css" type="text/css" rel="Stylesheet">
    <link href="<?php echo URL::base(true) ?>css/styles.css" type="text/css" rel="Stylesheet">
-->

    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-lightness/jquery-ui.min.css" rel="stylesheet" media="screen">
    <!-- Bootstrap -->
    <link href="<?php echo URL::base(true) ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo URL::base(true) ?>bootstrap/css/bootstrap-select.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo URL::base(true) ?>bootstrap/css/style.css" rel="stylesheet" media="screen">
    <script src="<?php echo URL::base(true) ?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo URL::base(true) ?>bootstrap/js/bootstrap-select.min.js"></script>
</head>
    <body>

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="#"><?php echo Kohana::$config->load('general')->get('site_name') ?></a>
                    <?php if (Auth::instance()->logged_in('admin')) { ?>
                    <ul class="nav">
                        <li <?php if (Request::$current->controller() == 'Campaigns') echo 'class="active"' ?>>
                            <a href="<?php echo URL::base() . Route::get('admin')->uri(array('controller' => 'Campaigns', 'action' => 'index')) ?>"><?php echo __('Campaigns') ?></a>
                        </li>
                        <li <?php if (Request::$current->controller() == 'Stats') echo 'class="active"' ?>>
                            <a href="<?php echo URL::base() . Route::get('admin')->uri(array('controller' => 'Stats', 'action' => 'index')) ?>"><?php echo __('Stats') ?></a>
                        </li>
                    </ul>
                    <form class="navbar-form pull-right">
                        <ul class="nav">
                        <li><a href="<?php echo URL::base() . Route::get('admin')->uri(array('controller' => 'login', 'action' => 'logout')) ?>"><?php echo __('Logout'); ?></a></li>
                        </ul>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="container" style='margin-top: 40px'>

            <?php echo $content ?>

        </div>
    </body>
</html>