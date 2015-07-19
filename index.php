<?php
include 'config.php';
session_start();
$result = mysql_query("Select COUNT(*) from quizzes");
$count = mysql_result($result, 0);
// $_SESSION['email'] contains email
// $_SESSION['name'] contains name
?>
<!DOCTYPE html>
<html>
<!--image dimensions for card: 200px X 150px-->
<!--begin of head-->
<head lang="en">
    <meta charset="UTF-8">
    <meta name="author" content="Deepankar Agrawal & Varun Bawa">
    <link href="css/materialize.min.css" rel="stylesheet">
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <link id="page_favicon" href="favicon.ico" rel="icon" type="image/x-icon">
    <title>Online Quiz Manager</title>
    <style>
        .quiz_margin{
            margin: 35px 41px 7px 0px;
        }
        .content_margin{
            margin: 0px 0px 0px 11px;
        }
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }
    </style>
</head>
<!--end of Head-->

<!--begin of Body-->

<body>

<!--Color for day 'blue darken-1'-->
<!--Color for night 'indigo darken-2'-->
    <!--Begin header-->
    <nav>
<!--Php Code below sets the theme color according to time of day-->
<?php
date_default_timezone_set('asia/calcutta');
$hr=date('h'); //To get hours
$ap=date('A'); //To get AM or PM
if($ap=='PM')
	$hr=$hr+12;
if($hr>=19 || $hr<=5)
{
?>
	<div class="nav-wrapper indigo">
<?php
}
else
{
?>
	<div class="nav-wrapper blue darken-1">
<?
}
?>
            <a href="#!" class="brand-logo">Online Quiz <?php if(isset($_SESSION['name'])){ $abc=$_SESSION['name']; echo "<font size='3pt'> for $abc";}?></a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
            <ul class="right hide-on-med-and-down">
                <li class="active"><a href="index.php">Home</a></li>
			<!--If User is Logged in Display Logout Option Else Login Option-->
                <?php
			if(empty($_SESSION['name']))
			{
			?>
		    	<li><a href="#login" class="modal-trigger">Login</a></li>
			<?php
			}
			else
			{
			?>
				<li><a href="logout.php">Logout</a></li>
			<?php
			}
			?>
				<li><a href="authtocreate.php">Create Quiz</a></li>
                <li><a href="register.html">Register</a></li>
                <li><a href="about.html">About</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="#login">Login</a></li>
                <li><a href="register.html">Register</a></li>
                <li><a href="about.html">About</a></li>
            </ul>
        </div>
    </nav>
    <!--end Header-->

    <!--Begin Content-->
    <main>
	
		<div class="content_margin">
<!--Displays the card according to no of active quizzes-->
<?php
$abc=0;
for($i=1;$i<=$count;$i++)
	{
		$query=mysql_query("Select * from quizzes WHERE quiz_no='$i'");
		$table=mysql_fetch_array($query);
		$name= $table['quiz_name'];
		$start_date= $table['start_date'];
		$start_time= $table['start_time'];
		$end_date= $table['end_date'];
		$end_time= $table['end_time'];

?>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
<?php
if($abc==0)
{	
	echo '<div class="row">';
}
$abc++;
?>
           
				<!--Begin Column-->
                        <div class="quiz_margin col s5 m2" id="section">
                            <!--Begin Card-->
                                <div class="card">
                                    <div class="card-image waves-effect waves-block waves-light">
                                        <img class="activator" src="images/image.jpg">
                                    </div>
							    <div class="card-content">
                                        <span class="card-title activator grey-text text-darken-4"><?php echo $table['quiz_name'];?><i class="mdi-navigation-more-vert right"></i></span>
                                    </div>
                                    <div class="card-reveal">
                                        <span class="card-title grey-text text-darken-4"><?php echo $table['quiz_name'];?><i class="mdi-navigation-close right"></i></span>
                                        <div class="row">
                                            <div class="col s6 m6">
                                                <div><a href="start-quiz.php?Name=<?php echo $table['quiz_name']?>"><i class="small mdi-av-play-arrow tooltipped" data-position="top" data-delay="50" data-tooltip="Participate"></i></a></div>
                                            </div>
                                            <div class="col s6 m6">
                                                <div><a href="result.php?Name=<?php echo $table['quiz_name']?>"><i class="small mdi-av-equalizer tooltipped" data-position="top" data-delay="50" data-tooltip="Ranking"></i></a></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s6 m6">
												<span class="card-title grey-text text-darken-4"></span>
											</div>
											<div class="col s6 m6">
                                                <div><a href="getmaxcolor.php?Name=<?php echo $table['quiz_name'];?>"><i class="small mdi-action-info-outline tooltipped" data-position="top" data-delay="50" data-tooltip="Information"></i></a></div>
                                            </div>
										</div>

                                    </div>
                                </div>
                            <!--End card-->
                        </div>
                    <!--End Column-->
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<?php
	if($abc==5)
	{
		echo '</div>';
		$abc=0;
	}
?>
<?php

	}

?>
</div>
	</main>
    <!--end Content-->

    <!--Begin Footer-->
<!--Php Code below sets the theme color for footer according to time of day-->
<?php
date_default_timezone_set('asia/calcutta');
$hr=date('h'); //To get hours
$ap=date('A'); //To get AM or PM
if($ap=='PM')
	$hr=$hr+12;
if($hr>=19 || $hr<=5)
{
?>
	<footer class="page-footer indigo darken-2">
<?php
}
else
{
?>
	<footer class="page-footer blue darken-1">
<?
}
?>
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">UPES-CSI Student Chapter</h5>
					<p class="grey-text text-lighten-4">Address:<br> UPES-CSI Student Chapter<br> IT-Tower , CIT <br>University of Petroleum and Energy Studies <br>Energy Acres , P.O. Bidholi via Prem nagar , <br>Dehradun(248007) , Uttarakhand , India </p>
                </div>
                <div class="col l4 s12" style="overflow: hidden;">
                    <h5 class="white-text">Connect with us</h5>
                        <ul>
                            <li><a href="https://twitter.com/upescsi" class="twitter-follow-button" data-show-count="true" data-size="large">Follow @upescsi</a></li>
                            <li class="hide-on-small-only"><div class="fb-like" data-href="https://facebook.com/upescsi" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div></li>
                            <li class="hide-on-large-only"><div class="fb-like" data-href="https://facebook.com/upescsi" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div></li>
                        </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                Developed and Maintained by UPES-CSI Student Chapter  &copy; 2015-2016
                <a class="grey-text text-lighten-4 right" href="http://materializecss.com/" target="_blank">Developed using materializecss</a>
            </div>
        </div>
    </footer>
    <!--end Footer-->

    <!-- Login Modal Structure -->
    <div id="login" class="modal">
        <div class="modal-content">
            <h4>Login</h4>
            <div class="row">
                <form class="col s12" method="POST" action="logincheck.php">
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="mdi-action-account-circle prefix"></i>
                            <input id="icon_prefix" type="text" class="validate" name="email">
                            <label for="icon_prefix">Email ID</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="mdi-action-lock prefix"></i>
                            <input id="icon_telephone" type="password" class="validate" name="password">
                            <label for="icon_telephone">Password</label>
                        </div>
                    </div>
					<div class="modal-footer">
						<button class="modal-action modal-close waves-effect waves-green btn-flat" type="submit">Login
							<i class="mdi-content-send right"></i>
						</button>
					</div>
                </form>
            </div>
        </div>
    </div>
    <!--end of modal-->
</body>
<!--end of Body-->

<!--Begin of Script Section-->
	<script>
	//Script to connect to FB
		$( document ).ready(function(){
			$(".button-collapse").sideNav();
		});
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
    <script>

        //responsive initialization
        $(".button-collapse").sideNav();

        //Tooltip initialization
        $(document).ready(function(){
            $('.tooltipped').tooltip({delay: 50});
        });

        //Modal Initialization
        $(document).ready(function(){
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('.modal-trigger').leanModal();
        });
    </script>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<!--End of Script Section-->
</html>