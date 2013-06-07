<!DOCTYPE html>
<head>
    <title>Home Page</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!--    <link href="<?php echo URL::base(true) ?>css/common.css" type="text/css" rel="Stylesheet">
    <link href="<?php echo URL::base(true) ?>css/reset.css" type="text/css" rel="Stylesheet">
    <link href="<?php echo URL::base(true) ?>css/styles.css" type="text/css" rel="Stylesheet">

    <script src="<?php echo URL::base(true) ?>js/jquery-1.8.2.min.js"></script>-->
</head>
    <body>
        <?php if (Auth::instance()->logged_in('admin')) { ?>
        <a href="<?php echo URL::base() . Route::get('admin')->uri(array('controller' => 'login', 'action' => 'logout')) ?>"><?php echo __('Logout'); ?></a>
        <?php } ?>
        
        <br/><br/><br/>

        <?php echo $content ?>

        
    </body>
</html>