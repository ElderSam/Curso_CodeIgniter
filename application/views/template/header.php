<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<meta name="description" content="Miminium Admin Template v.1">
	<meta name="author" content="Isna Nur Azis">
	<meta name="keyword" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Miminium</title>
 
    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/asset/css/bootstrap.min.css">

      <!-- plugins -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/asset/css/plugins/font-awesome.min.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/asset/css/plugins/simple-line-icons.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/asset/css/plugins/animate.min.css"/>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/asset/css/plugins/fullcalendar.min.css"/>
	<link href="<?php echo base_url(); ?>public/asset/css/style.css" rel="stylesheet">
	<!-- end: Css -->

	<link rel="shortcut icon" href="<?php echo base_url(); ?>public/asset/img/logomi.png">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- para chamar Estilos (CSS) exclusivos de uma determinada View -->
    <?php if(isset($styles)){
      foreach($styles as $style_name){
        $href = base_url() . "public/asset/css/" . $style_name; ?>
        <link href="<?=$href?>" rel="stylesheet">
      <?php }
    } ?>

  </head>

 <body id="mimin" class="dashboard">
      <!-- start: Header -->
        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
              <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
              </div>
                <a href="<?php echo base_url(); ?>public/index.html" class="navbar-brand"> 
                 <b>MIMIN</b>
                </a>

              <ul class="nav navbar-nav search-nav">
                <li>
                   <div class="search">
                    <span class="fa fa-search icon-search" style="font-size:23px;"></span>
                    <div class="form-group form-animate-text">
                      <input type="text" class="form-text" required>
                      <span class="bar"></span>
                      <label class="label-search">Type anywhere to <b>Search</b> </label>
                    </div>
                  </div>
                </li>
              </ul>

              <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span>Akihiko Avaron</span></li>
                  <li class="dropdown avatar-dropdown">
                   <img src="<?php echo base_url(); ?>public/asset/img/avatar.jpg" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                   <ul class="dropdown-menu user-dropdown">
                     <li><a href="<?php echo base_url(); ?>#"><span class="fa fa-user"></span> My Profile</a></li>
                     <li><a href="<?php echo base_url(); ?>#"><span class="fa fa-calendar"></span> My Calendar</a></li>
                     <li role="separator" class="divider"></li>
                     <li class="more">
                      <ul>
                        <li><a href=""><span class="fa fa-cogs"></span></a></li>
                        <li><a href=""><span class="fa fa-lock"></span></a></li>
                        <li><a href=""><span class="fa fa-power-off "></span></a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li ><a href="<?php echo base_url(); ?>#" class="opener-right-menu"><span class="fa fa-coffee"></span></a></li>
              </ul>
            </div>
          </div>
        </nav>
      <!-- end: Header -->
      

      <div class="container-fluid mimin-wrapper">
  
  <!-- start:Left Menu -->
    <div id="left-menu">
      <div class="sub-left-menu scroll">
        <ul class="nav nav-list">
            <li><div class="left-bg"></div></li>
            <li class="time">
              <h1 class="animated fadeInLeft">21:00</h1>
              <p class="animated fadeInRight">Sat,October 1st 2029</p>
            </li>
            <li class=" ripple">
              <a class="tree-toggle nav-header"><span class="fa-home fa"></span> TESTE 
                <span class="fa-angle-right fa right-arrow text-right"></span>
              </a>
              <ul class="nav nav-list tree">
                  <li><a href="<?php echo base_url(); ?>restrict">Restrict</a></li>
                  <li><a href="<?php echo base_url(); ?>login">Login</a></li>
              </ul>
            </li>
            <li class=" ripple">
              <a class="tree-toggle nav-header"><span class="fa-home fa"></span> Home 
                <span class="fa-angle-right fa right-arrow text-right"></span>
              </a>
              <ul class="nav nav-list tree">
                  <li><a href="<?php echo base_url(); ?>public/dashboard-v1.html">Dashboard v.1</a></li>
                  <li><a href="<?php echo base_url(); ?>public/dashboard-v2.html">Dashboard v.2</a></li>
              </ul>
            </li>
            <li class="ripple">
              <a class="tree-toggle nav-header">
                <span class="fa-diamond fa"></span> Layout
                <span class="fa-angle-right fa right-arrow text-right"></span>
              </a>
              <ul class="nav nav-list tree">
                <li><a href="<?php echo base_url(); ?>public/topnav.html">Top Navigation</a></li>
                <li><a href="<?php echo base_url(); ?>public/boxed.html">Boxed</a></li>
              </ul>
            </li>
            <li class="ripple">
              <a class="tree-toggle nav-header">
                <span class="fa-area-chart fa"></span> Charts
                <span class="fa-angle-right fa right-arrow text-right"></span>
              </a>
              <ul class="nav nav-list tree">
                <li><a href="<?php echo base_url(); ?>public/chartjs.html">ChartJs</a></li>
                <li><a href="<?php echo base_url(); ?>public/morris.html">Morris</a></li>
                <li><a href="<?php echo base_url(); ?>public/flot.html">Flot</a></li>
                <li><a href="<?php echo base_url(); ?>public/sparkline.html">SparkLine</a></li>
              </ul>
            </li>
            <li class="ripple"><a class="tree-toggle nav-header">
            <span class="fa fa-pencil-square"></span> Ui Elements  <span class="fa-angle-right fa right-arrow text-right"></span> </a>
              <ul class="nav nav-list tree">
                <li><a href="<?php echo base_url(); ?>public/color.html">Color</a></li>
                <li><a href="<?php echo base_url(); ?>public/weather.html">Weather</a></li>
                <li><a href="<?php echo base_url(); ?>public/typography.html">Typography</a></li>
                <li><a href="<?php echo base_url(); ?>public/icons.html">Icons</a></li>
                <li><a href="<?php echo base_url(); ?>public/buttons.html">Buttons</a></li>
                <li><a href="<?php echo base_url(); ?>public/media.html">Media</a></li>
                <li><a href="<?php echo base_url(); ?>public/panels.html">Panels & Tabs</a></li>
                <li><a href="<?php echo base_url(); ?>public/notifications.html">Notifications & Tooltip</a></li>
                <li><a href="<?php echo base_url(); ?>public/badges.html">Badges & Label</a></li>
                <li><a href="<?php echo base_url(); ?>public/progress.html">Progress</a></li>
                <li><a href="<?php echo base_url(); ?>public/sliders.html">Sliders</a></li>
                <li><a href="<?php echo base_url(); ?>public/timeline.html">Timeline</a></li>
                <li><a href="<?php echo base_url(); ?>public/modal.html">Modals</a></li>
              </ul>
            </li>
            <li class="ripple"><a class="tree-toggle nav-header"><span class="fa fa-check-square-o"></span> Forms  <span class="fa-angle-right fa right-arrow text-right"></span> </a>
              <ul class="nav nav-list tree">
                <li><a href="<?php echo base_url(); ?>public/formelement.html">Form Element</a></li>
                <li><a href="<?php echo base_url(); ?>#">Wizard</a></li>
                <li><a href="<?php echo base_url(); ?>#">File Upload</a></li>
                <li><a href="<?php echo base_url(); ?>#">Text Editor</a></li>
              </ul>
            </li>
            <li class="ripple"><a class="tree-toggle nav-header"><span class="fa fa-table"></span> Tables  <span class="fa-angle-right fa right-arrow text-right"></span> </a>
              <ul class="nav nav-list tree">
                <li><a href="<?php echo base_url(); ?>public/datatables.html">Data Tables</a></li>
                <li><a href="<?php echo base_url(); ?>public/handsontable.html">handsontable</a></li>
                <li><a href="<?php echo base_url(); ?>public/tablestatic.html">Static</a></li>
              </ul>
            </li>
            <li class="ripple"><a href="<?php echo base_url(); ?>public/calendar.html"><span class="fa fa-calendar-o"></span>Calendar</a></li>
            <li class="ripple"><a class="tree-toggle nav-header"><span class="fa fa-envelope-o"></span> Mail <span class="fa-angle-right fa right-arrow text-right"></span> </a>
              <ul class="nav nav-list tree">
                <li><a href="<?php echo base_url(); ?>public/mail-box.html">Inbox</a></li>
                <li><a href="<?php echo base_url(); ?>public/compose-mail.html">Compose Mail</a></li>
                <li><a href="<?php echo base_url(); ?>public/view-mail.html">View Mail</a></li>
              </ul>
            </li>
            <li class="ripple"><a class="tree-toggle nav-header"><span class="fa fa-file-code-o"></span> Pages  <span class="fa-angle-right fa right-arrow text-right"></span> </a>
              <ul class="nav nav-list tree">
                <li><a href="<?php echo base_url(); ?>public/forgotpass.html">Forgot Password</a></li>
                <li><a href="<?php echo base_url(); ?>public/login.html">SignIn</a></li>
                <li><a href="<?php echo base_url(); ?>public/reg.html">SignUp</a></li>
                <li><a href="<?php echo base_url(); ?>public/article-v1.html">Article v1</a></li>
                <li><a href="<?php echo base_url(); ?>public/search-v1.html">Search Result v1</a></li>
                <li><a href="<?php echo base_url(); ?>public/productgrid.html">Product Grid</a></li>
                <li><a href="<?php echo base_url(); ?>public/profile-v1.html">Profile v1</a></li>
                <li><a href="<?php echo base_url(); ?>public/invoice-v1.html">Invoice v1</a></li>
              </ul>
            </li>
            <li class="ripple"><a class="tree-toggle nav-header"><span class="fa "></span> MultiLevel  <span class="fa-angle-right fa right-arrow text-right"></span> </a>
              <ul class="nav nav-list tree">
                <li><a href="<?php echo base_url(); ?>public/view-mail.html">Level 1</a></li>
                <li><a href="<?php echo base_url(); ?>public/view-mail.html">Level 1</a></li>
                <li class="ripple">
                  <a class="sub-tree-toggle nav-header">
                    <span class="fa fa-envelope-o"></span> Level 1
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                  </a>
                  <ul class="nav nav-list sub-tree">
                    <li><a href="<?php echo base_url(); ?>public/mail-box.html">Level 2</a></li>
                    <li><a href="<?php echo base_url(); ?>public/compose-mail.html">Level 2</a></li>
                    <li><a href="<?php echo base_url(); ?>public/view-mail.html">Level 2</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="<?php echo base_url(); ?>public/credits.html">Credits</a></li>
          </ul>
        </div>
    </div>
  <!-- end: Left Menu -->