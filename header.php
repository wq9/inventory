<?php session_start(); ?>
<?php ob_start(); ?>
<?php
include_once('configuration.php');
include_once('include/connect.php');
include_once('include/global.php');
include_once('include/user.php');
include_once('include/meta.php');
include_once('include/language.php');
include_once('include/product.php');
include_once('include/log.php');
?>
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />

        <!-- Set the viewport width to device width for mobile -->
        <meta name="viewport" content="width=device-width" />

        <title><?php config('name'); ?></title>

        <!-- Included CSS Files -->
        <link rel="stylesheet" href="<?php url('theme'); ?>/stylesheets/foundation.css">
        <link rel="stylesheet" href="<?php url('theme'); ?>/stylesheets/app.css">

        <!-- Included JS Files (Compressed) -->
        <script src="<?php url('theme'); ?>/javascripts/modernizr.foundation.js"></script>
        <script src="<?php url('theme'); ?>/javascripts/jquery.js"></script>
        <script src="<?php url('theme'); ?>/javascripts/foundation.js"></script>
        <script src="<?php url('theme'); ?>/javascripts/jquery.foundation.navigation.js"></script>
        <script src="<?php url('theme'); ?>/javascripts/jquery.foundation.orbit.js"></script>
        <script src="<?php url('theme'); ?>/javascripts/jquery.foundation.buttons.js"></script>
        <script src="<?php url('theme'); ?>/javascripts/jquery.foundation.tabs.js"></script>
        <script src="<?php url('theme'); ?>/javascripts/jquery.foundation.forms.js"></script>
        <script src="<?php url('theme'); ?>/javascripts/jquery.foundation.tooltips.js"></script>
        <script src="<?php url('theme'); ?>/javascripts/jquery.foundation.accordion.js"></script>
        <script src="<?php url('theme'); ?>/javascripts/jquery.placeholder.js"></script>
        <script src="<?php url('theme'); ?>/javascripts/jquery.foundation.alerts.js"></script>
        <script src="<?php url('theme'); ?>/javascripts/jquery.validate.js"></script>
        <script src="<?php url('theme'); ?>/javascripts/jquery.dataTables.js"></script>
        <!-- Initialize JS Plugins -->
        <script src="<?php url('theme'); ?>/javascripts/app.js"></script>

        <!-- IE Fix for HTML5 Tags -->
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>
    <body>

        <div class="row">

            <div class="row">
                <div class="twelve columns">
                    <ul class="nav-bar">
                        <li><a href="<?php url(''); ?>/index.php"><?php lang('Dashboard'); ?></a></li>
                        <li class="has-flyout">
                            <a href="#"><?php lang('Input-Output'); ?></a>
                            <a href="#" class="flyout-toggle"><span> </span></a>
                            <ul class="flyout">
                                <li><a href="<?php url('page'); ?>/input-output/input.php?input"><?php lang('Product Input'); ?></a></li>
                                <li><a href="<?php url('page'); ?>/input-output/output.php?output"><?php lang('Product Output'); ?></a></li>
                            </ul>
                        </li>
                        <li class="has-flyout">
                            <a href="#"><?php lang('Product'); ?></a>
                            <a href="#" class="flyout-toggle"><span> </span></a>
                            <ul class="flyout">
                                <li><a href="<?php url('page'); ?>/product/add.php"><?php lang('Add Product'); ?></a></li>
                                <li><a href="<?php url('page'); ?>/product/product_list.php"><?php lang('Product List'); ?></a></li>
                                <li><a href="<?php url('page'); ?>/product/product_item_list.php"><?php lang('Product Item List'); ?></a></li>
                                <li><a href="<?php url('page'); ?>/product/warehouse.php"><?php lang('Warehouse'); ?></a></li>
                                <li><a href="<?php url('page'); ?>/product/product_report.php"><?php lang('Report'); ?></a></li>
                            </ul>
                        </li>
                        <li class="has-flyout">
                            <a href="#"><?php lang('Management'); ?></a>
                            <a href="#" class="flyout-toggle"><span> </span></a>
                            <ul class="flyout">
                                <li><a href="<?php url('page'); ?>/settings/settings.php"><?php lang('Settings'); ?></a></li>
                                <li><a href="<?php url('page'); ?>/user/user_management.php"><?php lang('User Management'); ?></a></li>
                                <li><a href="<?php url('page'); ?>/user/profile.php"><?php lang('Profile'); ?></a></li>
                                <li><a href="<?php url('page'); ?>/help/index.php"><?php lang('Documentation'); ?></a></li>
                                <li><a href="<?php url(''); ?>/exit.php"><?php lang('Exit'); ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="twelve columns">
                    <?php
                    $page_access = true;
                    $page_name = str_replace(get_url(''), '', 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
                    if (strpos($page_name, '?')) {
                        $page_name = explode('?', $page_name);
                        $page_name = $page_name[0];
                    }
                    $page_access_level = get_meta('', '', 'page_access', $page_name);
                    if (get_the_current_user('level') > $page_access_level and $page_access_level > 0) {
                        alert_box('alert', get_lang('Do not have permission to access this page'));
                        exit;
                    }
                    ?>
                </div>
            </div>
