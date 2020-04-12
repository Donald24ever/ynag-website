<?php
include("includes/db.php");
$status='';
 if(isset($_POST['user_name'])){
        //getting the text data from the fields.
		$username = preg_replace('#[^0-9a-zA-Z]#','',$_POST['user_name']);
		$password = mysqli_real_escape_string($con,$_POST['password']);
		
		if($username==''||$password==''){
			$status='<div style="padding:7px;">please fill both username and password</div>';
			}
		else{
		$pw = md5($password);
	$sql = "SELECT first_name,last_name,user_name,password,id FROM users WHERE user_name='$username' AND password='$pw' LIMIT 1";	
	 $query = mysqli_query($con, $sql) or die(mysqli_error($con));
	 $existencecount = mysqli_num_rows($query);
	 if($existencecount<1){$status='<div style="padding:7px;">Invalid login details</div>';}
	 else{
	 while ($row=mysqli_fetch_array($query)){
	    $user_firstname = $row[0];
		$user_lastname = $row[1];
		$user_username = $row[2];
		$user_password = $row[3];
		$user_id = $row[4];

		// Open and set session
		session_start();
		$_SESSION['user_username'] = $user_username;
		$_SESSION['user_password'] = $pw;
		$_SESSION['user_id'] = $user_id;
		
	//	echo $_SESSION['user_username'].'.....'.$_SESSION['password'].'.....'.$_SESSION['user_id']; exit();
		
		header('location: home.php'); exit();
		}
		}
		}
	 
 }
	
  ?>

<!doctype html>
<html class="no-js" lang="en">
  

<head>
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Awesome Themez">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<!-- Page Title -->
	<title>Y-NAG</title>
    <!-- Favicon Icon -->
  	<link rel="icon" href="img/favicon.png">
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="css/custom1.css">
	<!-- Modernizr -->
	<script src="js/vendor/modernizr-2.8.3.min.js"></script>
  </head>

  <body>
    <!-- Start Preloader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

	<!-- Start Site Header -->
    <header class="site-header">
      <div class="container header-wrap">
          <div class="site-branding">
            <!-- For Image Logo -->
            <!-- <a href="index.html" class="custom-logo-link">
              <img src="img/logo.png" alt="" class="custom-logo">
            </a> -->
            <!-- For Site Title -->
            <span class="site-title">
              <a href="index.php">Y-NAG</a>
            </span>
          </div>
          <nav class="primary-nav">
            <ul class="primary-nav-list nav">
              <li class="menu-item menu-item-has-children current-menu-ancestor current-menu-parent active"><a href="index.php">HOME</a>

              </li>
            </ul>
          </nav>
      </div><!-- .header-wrap -->
    </header>

    <!-- Start login Section -->
    <section class="contact section" id="contact">
        <div class="container">
            <div class="section-header">
                <h2>LOGIN</h2>
                <p>&nbsp;</p>
            </div><!-- .section-header -->
            <?php echo $status?>
            <form method="post">
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" placeholder="Enter username" name="user_name" required/>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" placeholder="Enter password" name="password" required/>
                    
                    <div class="col-sm-12 text-center">
                        <button type="submit" name="submit" value="login" class="t-btn submit-btn">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- End Contact Section -->

    <!-- Start Footer -->
    <footer class="site-footer section black-bg text-center">
        <div class="container">
            <p class="copy-right">Copyright 2017.www.y.nag.com</p>
            <div class="social-btn">
                <a href="https://www.facebook.com/YNaginn/?ref=bookmarks"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/Y_Nagin"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-behance"></i></a>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

	<!-- Scripts -->
	<script src="js/vendor/jquery-3.2.0.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/main.js"></script>
  </body>


</html>