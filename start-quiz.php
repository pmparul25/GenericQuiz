<?php
include 'config.php';
session_start();
if(empty($_SESSION['name']))
	echo "<script>alert('Please Login To Participate.');window.location.href='index.php';</script>"; //Login to Participate
$qname = $_GET['Name'];
$quizname=$qname.'_score';
$_SESSION['qname']=$qname;
$_SESSION['q_no']=1;
$j=$_SESSION['q_no'];
$name=$_SESSION['name'];
$email = $_SESSION['email'];

//To Validate that user is attempting the quiz within Time Defined
$timechk=mysql_query("SELECT * from quizzes WHERE quiz_name='$qname'");
$res=mysql_fetch_array($timechk);

//Comparing Date and Time
date_default_timezone_set('asia/calcutta');

$date1=explode('-', $res['start_date']);
$date2=explode('-', date('Y-m-d'));
$date3=explode('-', $res['end_date']);
$time1=explode(':', $res['start_time']);
$time2=explode(':', date('G:i:s'));
$time3=explode(':', $res['end_time']);

$a = 0; //To Check if all Start and End date parameters Match
$b = 0; //To Check if all Start and End date parameters Match

//----------------------------------Quiz Start and End time Session Variable of Particular user!------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------------------------//
$_SESSION['quiz_start_time']= $date2[0].":".$date2[1].":".$date2[2]." ".$time2[0].":".$time2[1].":".$time2[2];
if(isset($res['quiz_time']))
{	
	$quiztime = explode(':',$res['quiz_time']);
	for($m=0;$m<=2;$m++)
	{
		$endtime[$m] = $time2[$m] + $quiztime[$m];
		$enddate[$m] = $date2[$m];
	}
//Time Duration Added
//----------------------------------------------------------------------------------------------------------------------------------------------------//
//Formatting End Date and Time for Day change or meridian change in End Date and Time
if($endtime[2]>=60)
{
	$endtime[1]+=1;//Increasing Minutes
	$endtime[2]-=60;
}
if($endtime[1]>=60)
{
	$endtime[0]+=1;//Increasing Hours
	$endtime[1]-=60;
}
if($endtime[0]>=24)
{
	$enddate[2]+=1;//Increasing Day
	$endtime[0]-=24;
}
if($enddate[2]>=29)
{
	if($enddate[1]==2 && $enddate[0]%4!=0)
	{
	$enddate[1]+=1;//Increasing Month for February
	$enddate[2]-=28;
	}
	else
		if($enddate[1]==2 && $enddate[0]%4==0 && $enddate[2]==30)
	{
	$enddate[1]+=1;//Increasing Month for February in Leap Year
	$enddate[2]-=29;
	}
	else
		if($enddate[1]==4 || $enddate[1]==6 || $enddate[1]==9 || $enddate[1]==11)
	{
		if($enddate[2]==31)
		{
			$enddate[1]+=1;//Increasing Month having 30 days
			$enddate[2]-=30;
		}
	}
	else
		if($enddate[1]==1 || $enddate[1]==3 || $enddate[1]==5 || $enddate[1]==7 || $enddate[1]==8 || $enddate[1]==10 || $enddate[1]==12)
	{
		if($enddate[2]==32)
		{
			$enddate[1]+=1;//Increasing Month having 31 days
			$enddate[2]-=31;
		}
	}
}
if($enddate[1]>=12)
{
	$enddate[0]+=1;//Increasing Year
	$enddate[1]-=12;
}
	$_SESSION['quiz_end_time']= $enddate[0].":".$enddate[1].":".$enddate[2]." ".$endtime[0].":".$endtime[1].":".$endtime[2];
	//Getting the Time Difference of Start and End Time of Particular User in Seconds to be displayed as counter.
	//Quiz Countdown is displayed via Diff in Current Time and End Time Of User
	$curr_time = $date2[0].":".$date2[1].":".$date2[2]." ".$time2[0].":".$time2[1].":".$time2[2];
	$to_time = strtotime($curr_time);
	$from_time = strtotime($_SESSION['quiz_end_time']);
	//Getting Time Difference
	$countdown = round(abs($to_time - $from_time) / 1,2);
}

//----------------------------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------------------------//

//----------------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------Comparing Current date and Start date------------------------------------------------------------------//

if($date1[0]<$date2[0])
{
	$b+=1;
	$a+=1;
}
else
	if($date1[0]>$date2[0])
		$a+=0;
else	
	if($date1[0]=$date2[0])
	{
		if($date1[1]<$date2[1])
			{
				$b+=1;
				$a+=1;
			}
		else
			if($date1[1]=$date2[1])
			{
				if($date1[2]<$date2[2])
					{
						$b+=1;
						$a+=1;
					}
				else
					if($date1[2]===$date2[2])
						$a+=1;
			}
	}
//---------------------------------------------Comparing Current date and End date--------------------------------------------------------------------//
if($date2[0]<$date3[0])
{
	$b+=1;
	$a+=1;
}
else
 	if($date2[0]>$date3[0])
		$a+=0;
else
	if($date2[0]=$date3[0])
	{
		if($date2[1]<$date3[1])
			{
				$b+=1;
				$a+=1;
			}
		else
			if($date2[1]=$date3[1])
			{
				if($date2[2]<$date3[2])
				{
					$b+=1;
					$a+=1;
				}
				else
					if($date2[2]==$date3[2])
						$a+=1;
			}
	}

//---------------------------------------------Comparing Current time and Start time------------------------------------------------------------------//
if($b==0)
{
if($time1[0]<$time2[0])
	$a+=1;
else 
	if($time1[0]>$time2[0])
		$a+=0;
else
	if($time1[0]=$time2[0])
	{
		if($time1[1]<$time2[1])
			$a+=1;
		else
			if($time1[1]=$time2[1])
			{
				if($time1[2]<=$time2[2])
					$a+=1;
			}
	}

//---------------------------------------------Comparing Current time and End time--------------------------------------------------------------------//
if($time2[0]<$time3[0])
	$a+=1;
else 
	if($time2[0]>$time3[0])
		$a+=0;
else
	if($time2[0]=$time3[0])
	{
		if($time2[1]<$time3[1])
			$a+=1;
		else
			if($time2[1]=$time3[1])
			{
				if($time2[2]<=$time3[2])
					$a+=1;
			}
	}
//----------------------------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------------------------//
}
if($a>=4 || $b==2)
{
	$result = mysql_query("SELECT * FROM $quizname WHERE email='$email'"); //check if corresponding user had already attempted the quiz
$num_rows = mysql_num_rows($result);
if($num_rows==0)
{
if(isset($_SESSION['name']))
	$entry=mysql_query("INSERT INTO $quizname values('$email','$name',0,'running')") or die(mysql_error());
}
else
{
	$_SESSION['q_no']=$num_rows+1;
	echo "<script>alert('Quiz Already Attempted.');window.location.href='index.php';</script>";
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
            <a href="#" class="brand-logo"><?php echo $qname;?></a>
		</div>
    </nav>
	<marquee>Do not REFRESH on this page.Quiz will be submitted automatically if you do so!</marquee>
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
?>		
<div class="row register_form">
            <div class="col m4 s2 card-panel"></div>
            <form class="col m4 s8 card-panel teal" action="check_answer.php" method="POST">
                <div class="row">
                    <div class="col m10 s10 white-text"><h4><?php echo $row['q_no'];?></h4></div>
                    <div class="col m1 s1"></div>
                    <div class="col m1 s1"></div>
                </div>
                <div class="row white-text">
                    <div class="input-field col m1 s1"></div>
                    <div class="input-field col m10 s10 white-text">
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
                </div>
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
            <div class="col m4 s2 card-panel"></div>
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
	//This Script Section Displays The Countdown Timer
		var count = '<?php echo $countdown;?>';
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
<?php
}
else
	echo "<script>alert('Quiz Not Active Now!');window.location='index.php';</script>";
?>