<!DOCTYPE html>
<html lang="en" data-ng-app="WebEvolution">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title>AMS</title>

  <!-- Favicons-->
  <link rel="icon" href="public/assets/images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="public/assets/images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  <link href="public/assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="public/assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="public/assets/css/custom/custom.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="public/assets/js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="public/assets/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="public/assets/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?php echo e(asset('assets/js/plugins/sweetalert/dist/sweetalert.css')); ?>" type="text/css" rel="stylesheet" media="screen,projection">
</head>

<body ng-controller="AppController">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
    <?php echo $__env->make('tpl/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
      <?php echo $__env->make('sidebar/main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <?php echo $__env->make('tpl/breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!--breadcrumbs end-->
        

        <!--start container-->
        <div class="container">
          <div class="section" style="min-height: 600px">
            <div ui-view></div>
          </div>
        </div>
        <!--end container-->
      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->
      <!-- START RIGHT SIDEBAR NAV-->
        <?php echo $__env->make('sidebar/right', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <!-- LEFT RIGHT SIDEBAR NAV-->

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START FOOTER -->
  <?php echo $__env->make('tpl/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- END FOOTER -->

    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="<?php echo e(asset('assets/js/plugins/jquery-1.11.2.min.js')); ?>"></script>    
    <!--materialize js-->
    <script type="text/javascript" src="<?php echo e(asset('assets/js/Materialize.js')); ?>"></script>
    
    <script type="text/javascript" src="<?php echo e(asset('assets/js/plugins/prism/prism.js')); ?>"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="<?php echo e(asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
    <!-- chartist -->
    <script type="text/javascript" src="<?php echo e(asset('assets/js/plugins/chartist-js/chartist.min.js')); ?>"></script>   
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="<?php echo e(asset('assets/js/plugins.js')); ?>"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="<?php echo e(asset('assets/js/custom-script.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('assets/js/angular/angular.min.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('assets/js/angular/angular-materialize.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('assets/js/angular/angular-ui-router.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('assets/js/angular/ocLazyLoad.min.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('app/app.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('app/general.js')); ?>"></script>

    <!-- module -->
    <script type="text/javascript" src="bower_components/angular-animate/angular-animate.min.js"></script>
    <script type="text/javascript" src="bower_components/angular-aria/angular-aria.min.js"></script>
    <script type="text/javascript" src="bower_components/angular-material/angular-material.min.js"></script>

    <!-- Plugins -->
    <script type="text/javascript" src="<?php echo e(asset('assets/js/plugins/sweetalert/dist/sweetalert.min.js')); ?>"></script>
    
</body>

</html>