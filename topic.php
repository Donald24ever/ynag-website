<?php 
include_once('includes/login_check.php');
if(isset($_GET['id'])) {
			 $threadID = $_GET['id'];
$sql = "SELECT id,title,category_id,content,date,member_id,lyke,dislyke FROM thread WHERE id='$threadID' LIMIT 1";
$query = mysqli_query($con, $sql) or die(mysqli_error($con));
while ($row=mysqli_fetch_array($query)){
	    $threadID = $row[0];
		$threadTitle = $row[1];
		$threadCategory = $row[2];
		$threadContent = $row[3];
		$threadDate = $row[4];
		$member_id = $row[5];
		$threadLike = $row[6];
		$threadDisLike = $row[7];
}

$similarList='';
 $sql = "SELECT id,title FROM thread WHERE category_id='$threadCategory' LIMIT 5";
$query = mysqli_query($con, $sql) or die(mysqli_error($con));
while ($row=mysqli_fetch_array($query)){
	    $threadID = $row[0];
		$threadTitle = $row[1];	
		$similarList .='<div class="sidebarblock">
                                <h3>Similar Threads</h3>
                                <div class="divline"></div>
                                <div class="blocktxt">
                                    <a href="#">'.$threadTitle.'</a>
                                </div>
								</div>';
		
}

if(isset($_POST['reply'])) {
$reply = $_POST['reply'];
$sql = "INSERT INTO comment(thread_id,reply,member_id,date) VALUES ('$threadID','$reply','$user_id',now())";
$query = mysqli_query($con, $sql) or die(mysqli_error($con));
}

if(isset($_POST['lyke'])) {
	$threadLike = $threadLike+1;
$sql = "UPDATE thread SET lyke='$threadLike' WHERE id='$threadID'";
$query = mysqli_query($con, $sql) or die(mysqli_error($con));
}

if(isset($_POST['dislyke'])) {
	$threadDisLike = $threadDisLike+1;
$sql = "UPDATE thread SET dislyke='$threadDisLike' WHERE id='$threadID'";
$query = mysqli_query($con, $sql) or die(mysqli_error($con));
}

$replyList ='';
$sql = "SELECT id,thread_id,reply,date,member_id FROM comment WHERE thread_id='$threadID'";
$query = mysqli_query($con, $sql) or die(mysqli_error($con));
while ($row=mysqli_fetch_array($query)){
	    $reply_ID = $row[0];
		$reply_threadID = $row[1];
		$reply_reply= $row[2];
		$reply_date = $row[3];
		$reply_member_id = $row[4];
		$replyList .='<div class="post">
                                <div class="topwrap">
                                    <div class="userinfo pull-left">
                                        <div class="avatar">
                                            <img src="images/if_user_216498.png" alt="">
                                            <div class="status red">&nbsp;</div>
                                        </div>

                                    </div>
                                    <div class="posttext pull-left">
                                        <p> '.$reply_reply.'</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>                              
                                <div class="postinfobot">

                                    <div class="posted pull-left"><i class="fa fa-clock-o"></i> Posted on : '.$reply_date.'</div>

                                    <div class="clearfix"></div>
                                </div>
                            </div>';
}
}
else {header('location: index.php');exit();}
?>


<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Young nigerians agaisnt greed</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom -->
        <link href="css/custom.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
          <![endif]-->

        <!-- fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="font-awesome-4.0.3/css/font-awesome.min.css">

        <!-- CSS STYLE-->
        <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />

        <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
        <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />

    </head>
    <body class="topic">

        <div class="container-fluid">

            <!-- Slider -->
            <div class="tp-banner-container">
                <div class="tp-banner" >
                    <ul>	
                        <!-- SLIDE  -->
                        <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
                            <!-- MAIN IMAGE -->
                            <img src="images/<?php echo rand(1,2)?>.jpg"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                            <!-- LAYERS -->
                        </li>
                    </ul>
                </div>
            </div>
            <!-- //Slider -->


            <div class="headernav">
                <?php include('header.php'); ?>
            </div>



            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 breadcrumbf">
                            <a href="#">Young Nigerians</a> <span class="diviver">&gt;</span> <a href="#">General Discussion</a> <span class="diviver">&gt;</span> <a href="#">Topic Details</a>
                        </div>
                    </div>
                </div>


                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">

                            <!-- POST -->
                            <div class="post beforepagination">
                                <div class="topwrap">
                                    <div class="userinfo pull-left">
                                        <div class="avatar">
                                            <img src="images/if_user_216498.png" alt="" />
                                            <div class="status green">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="posttext pull-left">
                                        <h2><?php echo $threadTitle?></h2>
                                        <p><?php echo $threadContent?></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>                              
                                <div class="postinfobot">

                                     <form method="post"><button name="lyke" class="up likeblock pull-left" style="margin:3px"><i class="fa fa-thumbs-o-up"></i><?php echo $threadLike ?></button></form>
                                        <form method="post"><button name="dislyke" class="down likeblock pull-left" style="margin:3px"><i class="fa fa-thumbs-o-down"></i><?php echo $threadDisLike ?></button></form>
                                    

                                    <div class="posted pull-left"><i class="fa fa-clock-o"></i><?php echo $threadDate?></div>

                                    

                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- POST -->
                            
                              <?php echo $replyList ?>
                            
                           <div class="post">
                                <form action="#" class="form" method="post">
                                    <div class="topwrap">
                                        <div class="userinfo pull-left">
                                            <div class="avatar">
                                                <img src="images/if_user_216498.png" alt="" />
                                                <div class="status red">&nbsp;</div>
                                            </div>
                                        </div>
                                        <div class="posttext pull-left">
                                            <div class="textwraper">
                                                <div class="postreply">Post a Reply</div>
                                                <textarea name="reply" id="reply" placeholder="Type your message here"></textarea>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>                              
                                    <div class="postinfobot">

                                        <div class="notechbox pull-left">
                                            <input type="checkbox" name="note" id="note" class="form-control" />
                                        </div>

                                        <div class="pull-left">
                                            <label for="note"> Email me when some one post a reply</label>
                                        </div>

                                        <div class="pull-right postreply">
                                            <div class="pull-left smile"><a href="#"><i class="fa fa-smile-o"></i></a></div>
                                            <div class="pull-left"><button type="submit" class="btn btn-primary">Post Reply</button></div>
                                            <div class="clearfix"></div>
                                        </div>


                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>


                            <!-- POST -->
                          
                            <!-- POST -->



                            <!-- POST -->
                            
                            <!-- POST -->



                            <!-- POST -->
                            
                            <!-- POST -->


                        </div>
                        <div class="col-lg-4 col-md-4">

                            <!-- -->
                            <div class="sidebarblock">
                                <h3>Categories</h3>
                                <div class="divline"></div>
                                <div class="blocktxt">
                                    <ul class="cats">
                                        <li><a href="#">Government & Politics <span class="badge pull-right">20</span></a></li>
                                        <li><a href="#">Sports<span class="badge pull-right">10</span></a></li>
                                        <li><a href="#">Employment<span class="badge pull-right">50</span></a></li>
                                        <li><a href="#">Health <span class="badge pull-right">36</span></a></li>
                                        <li><a href="#">Youth Development <span class="badge pull-right">41</span></a></li>
                                        <li><a href="#">Religion<span class="badge pull-right">11</span></a></li>
                                        <li><a href="#">Entertainment<span class="badge pull-right">5</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            

                            <!-- -->
                             <?php echo $similarList?>


                        </div>
                    </div>
                </div>



                

            </section>

            <footer>
                <?php include('footer.php'); ?>
            </footer>
        </div>

        <!-- get jQuery from the google apis -->
        <script type="text/javascript" src="../ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.js"></script>

        <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
        <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
        <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>


        <!-- LOOK THE DOCUMENTATION FOR MORE INFORMATIONS -->
        <script type="text/javascript">

            var revapi;

            jQuery(document).ready(function() {
                "use strict";
                revapi = jQuery('.tp-banner').revolution(
                        {
                            delay: 15000,
                            startwidth: 1200,
                            startheight: 278,
                            hideThumbs: 10,
                            fullWidth: "on"
                        });

            });	//ready

        </script>

        <!-- END REVOLUTION SLIDER -->
    </body>


</html>