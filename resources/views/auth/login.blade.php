<!DOCTYPE html>
<html lang="en" data-ng-app="WebEvolution">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title>Login Page | Administrative System</title>

    <!-- Favicons-->
    <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
    <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
    <link href="{{ asset('assets/css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('assets/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="{{ asset('assets/css/custom/custom.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('assets/css/layouts/page-center.css') }}" type="text/css" rel="stylesheet" media="screen,projection">

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="{{ asset('assets/js/plugins/prism/prism.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>

<body class="cyan" ng-app="AuthModule" data-ng-controller="AuthController">
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->

    <div id="login-page" class="row">
        <div class="col s12 z-depth-4 card-panel">
            <form class="login-form" action="{{ url('login') }}">
                <div class="row">
                    <div class="input-field col s12 center">
                        <img src="{{ asset('assets/images/login-logo.png') }}" alt="" class="circle responsive-img valign profile-image-login">
                        <p class="center login-form-text">Administrative System</p>
                    </div>
                </div>
                <div class="row margin" data-ng-if="show">
                   <div id="card-alert" class="card {% error ? 'red' : 'green' %} lighten-5">
                        <div class="card-content {% error ? 'red' : 'green' %}-text">
                            <p>{% message %}</p>
                        </div>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-social-person-outline prefix"></i>
                        <input id="user_id" name="user_id" type="text">
                        <label for="username" class="center-align">Username</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-action-lock-outline prefix"></i>
                        <input id="password" name="password" type="password">
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="row">          
                    <div class="input-field col s12 m12 l12  login-text">
                        <input type="checkbox" id="remember-me" />
                        <label for="remember-me">Remember me</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <a href="javascript:;" ng-click="login()" class="btn waves-effect waves-light col s12">Login</a>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 m6 l6">
                        <p class="margin right-align medium-small"><a href="javascript:;">Forgot password ?</a></p>
                    </div>          
                </div>

            </form>
        </div>
    </div>

  <!-- ================================================
    Scripts
    ================================================ -->

    <!-- jQuery Library -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-1.11.2.min.js') }}"></script>    
    <!--materialize js-->
    <script type="text/javascript" src="{{ asset('assets/js/Materialize.js') }}"></script>
    
    <script type="text/javascript" src="{{ asset('assets/js/plugins/prism/prism.js') }}"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="{{ asset('assets/js/plugins.js') }}"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="{{ asset('assets/js/custom-script.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/angular/angular.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/angular/angular-materialize.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/angular/angular-ui-router.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/angular/ocLazyLoad.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('app/app.js') }}"></script>

    <script type="text/javascript" src="{{ asset('app/general.js') }}"></script>

    <script type="text/javascript" src="{{ asset('app/form_validator.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <!-- module -->

    <!--custom-script.js') }} - Add your own theme custom JS-->

    <script type="text/javascript" src="{{ asset('app/controllers/security/auth.js') }}"></script>

    <script type="text/javascript" src="{{ asset('app/services/user/services.js') }}"></script>

    <script>
      var base_url;
      $(document).ready(function() {
        base_url = "<?php echo url('/');?>/";
      });
    </script> 

</body>
</html>