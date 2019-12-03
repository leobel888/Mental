<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Triangle</title>

	 <!-- CSS -->
    <!--<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />-->
	<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/test.css" />
	<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/animate.min.css" />
	<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/lightbox.css" />
	<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/main.css" />
	<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/responsive.css" />

 <!--[if lt IE 9]>
	    <script src="<?php echo Config::get('URL'); ?>js/html5shiv.js"></script>
	    <script src="<?php echo Config::get('URL'); ?>js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="<?php echo Config::get('URL'); ?>images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Config::get('URL'); ?>images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Config::get('URL'); ?>images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Config::get('URL'); ?>images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo Config::get('URL'); ?>images/ico/apple-touch-icon-57-precomposed.png">
		
</head><!--/head-->	
<body>
	<header id="header">      
        <div class="container">
            <div class="row">
                <div class="col-sm-12 overflow">
                   <div class="social-icons pull-right">
                        <ul class="nav nav-pills">
                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                            <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                            <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div> 
                </div>
             </div>
        </div>
        <div class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="index.html">
                    	<h1><img src="<?php echo Config::get('URL'); ?>images/logo.png" alt="logo"></h1>
                    </a>
                    
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li <?php if (View::checkForActiveController($filename, "index")) { echo ' class="active" '; } ?> >
							<a href="<?php echo Config::get('URL'); ?>index/index">Home</a>
						</li>
                        <li <?php if (View::checkForActiveController($filename, "profile")) { echo ' class="active" '; } ?> >
							<a href="<?php echo Config::get('URL'); ?>profile/index">Profiles</a>
						</li>
						
						<?php if (Session::userIsLoggedIn()) { ?>
							
							<li <?php if (View::checkForActiveController($filename, "dashboard")) { echo ' class="active" '; } ?> >
								<a href="<?php echo Config::get('URL'); ?>dashboard/index">Dashboard</a>
							</li>
							<li <?php if (View::checkForActiveController($filename, "note")) { echo ' class="active" '; } ?> >
								<a href="<?php echo Config::get('URL'); ?>note/index">My Notes</a>
							</li>
							<li <?php if (View::checkForActiveController($filename, "trainer")) { echo ' class="active" '; } ?> >
								<a href="<?php echo Config::get('URL'); ?>trainer/index">Trainers</a>
							</li>
							
						<?php } else { ?>
							<!-- for not logged in users -->
							<li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
								<a href="<?php echo Config::get('URL'); ?>login/index">Login</a>
							</li>
							<li <?php if (View::checkForActiveControllerAndAction($filename, "register/index")) { echo ' class="active" '; } ?> >
								<a href="<?php echo Config::get('URL'); ?>register/index">Register</a>
							</li>
							
						<?php } ?>
	
						<?php if (Session::userIsLoggedIn()) : ?>
							<li class="dropdown"><a href="#">Pages <i class="fa fa-angle-down"></i></a>
							
								<ul role="menu" class="sub-menu">											
								
									<li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
										<a href="<?php echo Config::get('URL'); ?>user/index">My Account</a>
									</li>
									
									<li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
										<a href="<?php echo Config::get('URL'); ?>user/changeUserRole">Change account type</a>
									</li>
									
									<li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
										<a href="<?php echo Config::get('URL'); ?>user/editAvatar">Edit your avatar</a>
									</li>
									
									<li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
										<a href="<?php echo Config::get('URL'); ?>user/editusername">Edit my username</a>
									</li>
									<li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
										<a href="<?php echo Config::get('URL'); ?>user/edituseremail">Edit my email</a>
									</li>
									<li <?php if (View::checkForActiveController($filename, "user")) { echo ' class="active" '; } ?> >
										<a href="<?php echo Config::get('URL'); ?>user/changePassword">Change Password</a>
									</li>
									<li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
										<a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a>
									</li>
								</ul>
							</li>
						
						<?php if (Session::get("user_account_type") == 7) : ?>
							<li <?php if (View::checkForActiveController($filename, "admin")) {
									echo ' class="active" ';
									} ?> >
									<a href="<?php echo Config::get('URL'); ?>admin/">Admin</a>
							</li>
						<?php endif; ?>
					<?php endif; ?>
					
	               </ul>
                </div>
                <div class="search">
                    <form role="form">
                        <i class="fa fa-search"></i>
                        <div class="field-toggle">
                            <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <!--/#header--> 
  