<?php
include_once('includes/login_check.php');

$status='';
 if(isset($_POST['insert_post'])){
  
        //getting the text data from the fields.
		$title = preg_replace('#[^0-9a-zA-Z,.)( -]#','',$_POST['title']);
		$category = preg_replace('#[^0-9a-zA-Z,.)( -]#','',$_POST['category_id']);
		$content = mysqli_real_escape_string($con,$_POST['content']);
	$query = "INSERT INTO thread(title,category_id,content,member_id,date)VALUES ('$title','$category','$content','$user_id',now())";
	 
	 $insert_room = mysqli_query($con, $query) or die(mysqli_error($con));
  
  }

//GETTING CATEGORY LIST
$catList ='';
$sql = "SELECT id,title from category";
$query = mysqli_query($con, $sql);
while ($row=mysqli_fetch_array($query)){
	    $catID = $row[0];
		$catTitle = $row[1];
		$catList .='<option value="'.$catID.'">'.$catTitle.'</option>';
    }	
					
					
?>
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Forum :: New topic</title>

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
    <body>

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

            <?php include('header.php'); ?>



            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 breadcrumbf">
                            <a href="#">Y-Nag</a> <span class="diviver">&gt;</span> <a href="#">General Discussion</a> <span class="diviver">&gt;</span> <a href="#">New Topic</a>
                        </div>
                    </div>
                </div>


                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">



                            <!-- POST -->
                            <div class="post">
                            <?php echo $status ?>
                                <form action="newtopic.php" class="form newtopic" method="post">
                                    <div class="topwrap">
                                        <div class="userinfo pull-left">
                                            <div class="avatar">
                                                <img src="images/if_user_216498.png" alt="" />
                                                <div class="status red">&nbsp;</div>
                                            </div>

                                            <div class="icons">
                                                <img src="images/icon3.jpg" alt="" /><img src="images/icon4.jpg" alt="" /><img src="images/icon5.jpg" alt="" /><img src="images/icon6.jpg" alt="" />
                                            </div>
                                        </div>
                                        <div class="posttext pull-left">

                                            <div>
                                                <input type="text" placeholder="Enter Topic Title" name="title" class="form-control" />
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <select name="category_id" id="category"  class="form-control" >
                                                        <option value="" disabled selected>Select Category</option>
                                                       <?php echo $catList ?>
                                                    </select>
                                                </div>
                                               
                                            </div>

                                            <div>
                                                <textarea name="content" id="desc" placeholder="Description" class="form-control" ></textarea>
                                            </div>
                                            <div class="row newtopcheckbox">
                                                <div class="col-lg-6 col-md-6">
                                                    <div><p>Who can see this?</p></div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="everyone" /> Everyone
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="friends"  /> Only Friends
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div>
                                                        <p>Share on Social Networks</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-4">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="fb"/> <i class="fa fa-facebook-square"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-4">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="tw" /> <i class="fa fa-twitter"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-4">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="gp"  /> <i class="fa fa-google-plus-square"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                            <div class="pull-left"><input type="submit" name="insert_post" value="Insert Now" class="btn btn-primary">Post</input></div>
                                            <div class="clearfix"></div>
                                        </div>


                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div><!-- POST -->

                            <div class="row similarposts">
                                <div class="col-lg-10"><i class="fa fa-info-circle"></i> <p>Similar Posts according to your <a href="#">Topic Title</a>.</p></div>
                                <div class="col-lg-2 loading"><i class="fa fa-spinner"></i></div>

                            </div>

                            <!-- POST -->
                            <div class="post">
                                <div class="wrap-ut pull-left">
                                    <div class="userinfo pull-left">
                                        <div class="avatar">
                                            <img src="images/if_user_216498.png" alt="" />
                                            <div class="status green">&nbsp;</div>
                                        </div>

                                        <div class="icons">
                                            <img src="images/icon1.jpg" alt="" /><img src="images/icon4.jpg" alt="" />
                                        </div>
                                    </div>
                                    <div class="posttext pull-left">
                                        <h2>10 Kids Unaware of Their Halloween Costume</h2>
                                        <p>It's one thing to subject yourself to a Halloween costume mishap because, hey, that's your prerogative.</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="postinfo pull-left">
                                    <div class="comments">
                                        <div class="commentbg">
                                            560
                                            <div class="mark"></div>
                                        </div>

                                    </div>
                                    <div class="views"><i class="fa fa-eye"></i> 1,568</div>
                                    <div class="time"><i class="fa fa-clock-o"></i> 24 min</div>                                    
                                </div>
                                <div class="clearfix"></div>
                            </div><!-- POST -->


                            <!-- POST -->
                            <div class="post">
                                <div class="wrap-ut pull-left">
                                    <div class="userinfo pull-left">
                                        <div class="avatar">
                                            <img src="images/if_user_216498.png" alt="" />
                                            <div class="status red">&nbsp;</div>
                                        </div>

                                        <div class="icons">
                                            <img src="images/icon3.jpg" alt="" /><img src="images/icon4.jpg" alt="" /><img src="images/icon5.jpg" alt="" /><img src="images/icon6.jpg" alt="" />
                                        </div>
                                    </div>
                                    <div class="posttext pull-left">
                                        <h2>What Instagram Ads Will Look Like</h2>
                                        <p>Instagram offered a first glimpse at what its ads will look like in a blog post Thursday. The sample ad, which you can see below.</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="postinfo pull-left">
                                    <div class="comments">
                                        <div class="commentbg">
                                            89
                                            <div class="mark"></div>
                                        </div>

                                    </div>
                                    <div class="views"><i class="fa fa-eye"></i> 1,568</div>
                                    <div class="time"><i class="fa fa-clock-o"></i> 15 min</div>                                    
                                </div>
                                <div class="clearfix"></div>
                            </div><!-- POST -->


                            <!-- POST -->
                            <div class="post">
                                <div class="wrap-ut pull-left">
                                    <div class="userinfo pull-left">
                                        <div class="avatar">
                                            <img src="images/if_user_216498.png" alt="" />
                                            <div class="status red">&nbsp;</div>
                                        </div>

                                        <div class="icons">
                                            <img src="images/icon2.jpg" alt="" /><img src="images/icon4.jpg" alt="" />
                                        </div>
                                    </div>
                                    <div class="posttext pull-left">
                                        <h2>The Future of Magazines Is on Tablets</h2>
                                        <p>Eric Schmidt has seen the future of magazines, and it's on the tablet. At a Magazine Publishers Association.</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="postinfo pull-left">
                                    <div class="comments">
                                        <div class="commentbg">
                                            456
                                            <div class="mark"></div>
                                        </div>

                                    </div>
                                    <div class="views"><i class="fa fa-eye"></i> 1,568</div>
                                    <div class="time"><i class="fa fa-clock-o"></i> 2 days</div>                                    
                                </div>
                                <div class="clearfix"></div>
                            </div><!-- POST -->






                        </div>
                        <?php include('sideblock.php'); ?>
                    </div>
                </div>



                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-xs-12">
                            <div class="pull-left"><a href="#" class="prevnext"><i class="fa fa-angle-left"></i></a></div>
                            <div class="pull-left">
                                <ul class="paginationforum">
                                    <li class="hidden-xs"><a href="#">1</a></li>
                                    <li class="hidden-xs"><a href="#">2</a></li>
                                    <li class="hidden-xs"><a href="#">3</a></li>
                                    <li class="hidden-xs"><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">6</a></li>
                                    <li><a href="#" class="active">7</a></li>
                                    <li><a href="#">8</a></li>
                                    <li class="hidden-xs"><a href="#">9</a></li>
                                    <li class="hidden-xs"><a href="#">10</a></li>
                                    <li class="hidden-xs hidden-md"><a href="#">11</a></li>
                                    <li class="hidden-xs hidden-md"><a href="#">12</a></li>
                                    <li class="hidden-xs hidden-sm hidden-md"><a href="#">13</a></li>
                                    <li><a href="#">1586</a></li>
                                </ul>
                            </div>
                            <div class="pull-left"><a href="#" class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>


            </section>

            <footer>
                <?php include('footer.php'); ?>
            </footer>
        </div>

        <!-- get jQuery from the google apis -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.js"></script>

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