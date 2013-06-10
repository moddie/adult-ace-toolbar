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
    <!-- Bootstrap -->
    <link href="<?php echo URL::base(true) ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="<?php echo URL::base(true) ?>bootstrap/js/bootstrap.min.js"></script>
</head>
    <body>
        
        <div class="container">
            
            <div class="navbar">
                <div class="navbar-inner">
                    <a class="brand" href="#"><?php echo Kohana::$config->load('general')->get('site_name') ?></a>
                    <?php if (Auth::instance()->logged_in('admin')) { ?>
                    <ul class="nav">
                        <li <?php if (Request::$current->controller() == 'Ads') echo 'class="active"' ?> >
                            <a href="<?php echo URL::base() . Route::get('admin')->uri(array('controller' => 'ads', 'action' => 'index')) ?>"><?php echo __('Ads') ?></a>
                        </li>
                        <li <?php if (Request::$current->controller() == 'Stats') echo 'class="active"' ?>>
                            <a href="<?php echo URL::base() . Route::get('admin')->uri(array('controller' => 'stats', 'action' => 'logout')) ?>"><?php echo __('Stats') ?></a>
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
            
            <?php echo $content ?>

        </div>
    </body>
</html>