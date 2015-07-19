<?php
//Displays result of Corresponding Quiz
//Quiz name is stored in variable $qname.
include 'config.php';
session_start();
if(isset($_GET['Name']))
{
$qname = $_GET['Name'];
$_SESSION['qname']=$qname;
$score = $qname."_score";
$display = mysql_query("Select * from ".$qname."_score ORDER BY score DESC") or $score='index';
//If No Entry is there in result of that quiz
//Redirecting to index.php
if($score == 'index')
	echo "<script>alert('No Results Right Now!'); window.location = 'index.php';</script>";
else
{
$rows = mysql_num_rows($display);
$result = mysql_query("SELECT * FROM $qname");
$num_rows = mysql_num_rows($result);
}
	if(isset($_SESSION['email']) && $score!=0)
	{
		$email = $_SESSION['email'];
		$_SESSION['q_no']=$num_rows+1;
		$quizcomplete = mysql_query("UPDATE $score SET status = 'completed' WHERE email = '$email'");
	}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="author" content="Varun Bawa">
    <link href="css/materialize.min.css" rel="stylesheet">
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <link id="page_favicon" href="favicon.ico" rel="icon" type="image/x-icon">
    <title>Quiz Display</title>
    <style>
        .register_form{
            margin:41px 0px 22px 0px;
        }
        .timer_location{
            bottom: 45px; right: 24px;
            position: fixed;
        }
        .pagination_position{

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
<body>
    <!--Begin header-->
    <nav>
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
            <a href="#" class="brand-logo"><?php echo $qname;?> Leaderboard</a>
	        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="index.php">Home</a></li>
    			<li><a href="logout.php">Logout</a></li>
	            <li><a href="about.html">About</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="index.php">Home</a></li>
            	<li><a href="logout.php">Logout</a></li>
	            <li><a href="about.html">About</a></li>
            </ul>
        </div>
    </nav>
	<!--end Header-->


    <!--Main Content-->
    <main>
		<!--Result Database Display Block Start-->
<?php
?>
<table>
        <thead>
          <tr>
              <th>Name</th>
              <th>Score</th>
          </tr>
        </thead>
<?php 
	 while($row = mysql_fetch_array($display)) 
	 {
?>
         <tbody>
			<tr <?php if($row['name']==$_SESSION['name']) echo "bgcolor='#5CE6E6'";?>>
				<th><?php echo $row['name']?></th>
				<th><?php echo $row['score']?></th>
			</tr>
		</tbody>
<?php
     }
?>
</table>
<!--Result Database Display Block End-->

    </main>
    <!--End Main Content-->

    <!--Begin Footer-->
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
</body>
<!--end of Body-->

<!--Begin of Script Section-->
	<script>
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
<?php
}
else
	echo "<script>alert('link not correct!'); window.location = 'index.php';</script>";
?>