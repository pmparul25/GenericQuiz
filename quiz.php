<?php
include 'config.php';
session_start();
//Getting Quiz Name
$qname = $_GET['Name'];
$score = $qname.'_score';
$_SESSION['qname']=$qname;

//Getting Current Question No.
$j=$_SESSION['q_no'];
$email = $_SESSION['email'];

//To get number of questions
$result = mysql_query("SELECT * FROM $qname");
$num_rows = mysql_num_rows($result);
			
//Check if Question No. is Valid or Not
if($_SESSION['q_no']>$num_rows)
	echo "<script>alert('Quiz Attempted Successfully!');window.location= 'index.php';</script>";

//To check if quiz is already attempted
$resultchk = mysql_query("SELECT * FROM $score WHERE email='$email'");
$rchk = mysql_fetch_array($resultchk);
//When User Submits the quiz his/her status gets updated to 'Completed'
if($rchk['status'] == 'completed')
	echo "<script>alert('Quiz Already Attempted');window.location= 'index.php';</script>";

//To Validate that user is attempting the quiz within Time Defined
$timechk=mysql_query("SELECT * from quizzes WHERE quiz_name='$qname'");
$res=mysql_fetch_array($timechk);

//Comparing Date and Time
date_default_timezone_set('asia/calcutta');
$date1=explode('-', $res['start_date']);		//Start Date
$date2=explode('-', date('Y-m-d'));				//Current Date
$date3=explode('-', $res['end_date']);			//End Date
$time1=explode(':', $res['start_time']);		//Start Time
$time2=explode(':', date('G:i:s'));				//Current Time
$time3=explode(':', $res['end_time']);			//End Time

//Getting the Time Difference of Start and End Time of Particular User in Seconds to be displayed as counter.
//Quiz Countdown is displayed via Diff in Current Time and End Time Of User
$curr_time = $date2[0].":".$date2[1].":".$date2[2]." ".$time2[0].":".$time2[1].":".$time2[2];
$to_time = strtotime($curr_time);
$from_time = strtotime($_SESSION['quiz_end_time']);
//Getting Time Difference
$countdown = round(abs($to_time - $from_time) / 1,2);

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
            <a href="#" class="brand-logo"><?php echo $qname;?></a>
		<ul class="right hide-on-med-and-down">
                <li><a href="index.php">Home</a></li>
				<li><a href="logout.php">Logout</a></li>
                <li><a href="about.html">About</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="index.php">Home</a></li>
				<li><a href="logout.php">Logout</a></li>
                <li><a href="register.html">Register</a></li>
                <li><a href="about.html">About</a></li>
            </ul>
		</div>
    </nav>
    <!--end Header-->
    <!--Main Content-->
    <main>
	
        <!--Make the timer-->
        <?php
		if($res['quiz_time']!='')
		{
		?>
        <div class="timer_location">
            <span><a class="btn-floating btn-large waves-effect waves-light red">00:00</a></span>
        </div>
		<?php
		{
		?>
		<!--End of timer-->
		
<!--Display Starts-->
		
<?php
for($i=$j;$i<=$j;$i++)
	{
		$display = mysql_query("Select * from $qname WHERE q_no='".$i."'");
		$row = mysql_fetch_array($display);
		$row['q_no']=$i;
		if(isset($row['img_url']))
		$src=$row['img_url'];
?>		
	<div class="row register_form">
            <div class="col m3 s2 card-panel"></div>
            <form class="col m6 s8 card-panel teal" action="check_answer.php" method="POST">
                <div class="row">
                    <div class="col m10 s10 black-text"><h5>Ques.<?php echo $row['q_no'];?></h5></div>
                </div>
				<?php
				if(isset($src))
				{
				?>
				<img src="<?php echo $src;?>" style="height: 400px; width: 650px;"/>
                <?php
				}
				?>
				<div class="row white-text">
                        <p><?php echo $row['question'];?></p>
                </div>
				<?php
				if($row['option1']!='' && $row['option2']!='')
				{
				?>
                    <div class="col s1 m1"></div>
				<div class="row">
						<input type="checkbox" id="test1"  name="check_list[0]" value="<?php echo $row['option1'];?>"/>
						<label for="test1" class="white-text"><?php echo $row['option1'];?></label>
				</div>
				<div class="row">
						<input type="checkbox" id="test2"  name="check_list[1]" value="<?php echo $row['option2'];?>"/>
						<label for="test2" class="white-text"><?php echo $row['option2'];?></label>
  				</div>
				<div class="row">
						<input type="checkbox" id="test3"  name="check_list[2]" value="<?php echo $row['option3'];?>"/>
						<label for="test3" class="white-text"><?php echo $row['option3'];?></label>
				</div>
				<div class="row">
						<input type="checkbox" id="test4"  name="check_list[3]" value="<?php echo $row['option4'];?>"/>
						<label for="test4" class="white-text"><?php echo $row['option4'];?></label>
				</div>
				<?php
				}
				else
				{
				?>
				<div class="row">
						<input type="text" class="validate" name="answer"/>
						<label for="answer">Answer</label>
				</div>
				<?php
				}
				?>
                <div class="row">
                    <div class="col s12 m12"></div>
                </div>
                <div class="row">
                    <div class="col m12 s12 center-align">
					<button class="btn waves-effect waves-light pink" type="submit" name="action">Submit
						<i class="mdi-content-send right"></i>
					</button>
                    </div>
				</div>
			</form>
	</div>			
				<div class="row">	
					<div class="col m12 s12 left-align"><a href="<?php echo "result.php?Name=".$qname;?>">
					<button class="btn waves-effect waves-light blue-grey">Finish
						<i class="mdi-content-send right"></i>
					</button></a>
                    </div>
				</div>
<!--Display Ends-->
<?php
	}
?>
    </main>
    <!--End Main Content-->

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
</body>
<!--end of Body-->
<!--Begin of Script Section-->
	<script>
	//This Script Section Displays The Counter
		var count = <?php echo $countdown;?>;
		var qname = '<?php echo $qname?>';
		var counter = setInterval(timer, 1000); //1000 will  run it every 1 second

		function timer() 
		{
			count = count - 1;
			if (count == -1) 
			{
				clearInterval(counter);
				return;
			}

			var seconds = count % 60;
			var minutes = Math.floor(count / 60);
			var hours = Math.floor(minutes / 60);
			minutes %= 60;
			hours %= 60;
			if (hours == 0)
				document.getElementById("timer").innerHTML = minutes + ":" + seconds;
			else
				if(hours == 0 && minutes == 0)
					document.getElementById("timer").innerHTML = seconds;
			else
				document.getElementById("timer").innerHTML = hours + ":" + minutes + ":" + seconds;
			if(count == 0)
					window.location = "result.php?Name=" + qname;
		}
	</script>
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