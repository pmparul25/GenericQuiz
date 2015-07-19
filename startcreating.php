<?php
<<<<<<< HEAD
include 'config.php';
session_start();
$_SESSION['qname']=$_POST['q_name'];
$qname=$_POST['q_name'];
$_SESSION['oname']=$_POST['o_name'];
$result=mysql_query("SELECT * from quizzes") or die("Count Error");
$count= mysql_num_rows($result);
$q_no=$count+1;

// sql to create table
// Creating table with quiz name which consists of questions answers image-url and options 
//Making directory for images in location /uploads/
mkdir("uploads/$qname");
$sql = mysql_query("CREATE TABLE $qname(
q_no INT(6) PRIMARY KEY AUTO_INCREMENT, 
=======
$qname=$_POST['q_name'];
$oname=$_POST['o_name'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GenericQuiz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE $qname (
q_no INT(6) PRIMARY KEY, 
>>>>>>> origin/master
question VARCHAR(250) NOT NULL,
option1 VARCHAR(50),
option2 VARCHAR(50),
option3 VARCHAR(50),
option4 VARCHAR(50),
<<<<<<< HEAD
answer VARCHAR(50) NOT NULL,
img_url VARCHAR(100),
organizer VARCHAR(50) NOT NULL
)") or die("Table Already Exists, Contact Database Admin");
=======
answer VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error creating table: " . $conn->error;
}
$conn->close();
>>>>>>> origin/master
?>
<!DOCTYPE html>
<html>
<!--image dimensions for card: 200px X 150px-->
<!--begin of head-->
<head lang="en">
    <meta charset="UTF-8">
    <meta name="author" content="Varun Bawa">
    <link href="css/materialize.min.css" rel="stylesheet">
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
	<link id="page_favicon" href="favicon.ico" rel="icon" type="image/x-icon">
<<<<<<< HEAD
    <title>Enter Quiz Questions</title>
=======
    <title>Create A Quiz</title>
>>>>>>> origin/master
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

<!-- Begin Body -->
<body>
<!--Begin header-->
    <nav>
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo">Create A Quiz</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
            <ul class="right hide-on-med-and-down">
<<<<<<< HEAD
                <li><a href="index.php">Home</a></li>
                <li><a href="register.html">Register</a></li>
				<li><a href="about.html">About</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="index.php">Home</a></li>
=======
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="#login" class="modal-trigger">Login</a></li>
                <li><a href="register.html">Register</a></li>
				<li><a href="authtocreate.php">Create A Quiz</a></li>
                <li><a href="about.html">About</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="login.html">Login</a></li>
>>>>>>> origin/master
                <li><a href="register.html">Register</a></li>
                <li><a href="about.html">About</a></li>
            </ul>
        </div>
    </nav>
    <!--end Header-->
<br><br>
	<form class="col s12" method="POST" action="pushentry.php">
	<div class="row">
        <div class="input-field col s2">
<<<<<<< HEAD
          <input disabled id="disabled" type="text" class="validate">
          <label><?php echo $_SESSION['qname'];?></label>
        </div>
      </div>
    <div class="row">
=======
          <input disabled id="disabled" type="text" class="validate" name="qname">
          <label><?php echo $qname;?></label>
        </div>
      </div>
    <div class="row">
        <div class="input-field col s1">
          <input id="q_no" type="text" class="validate" name="q_no">
          <label for="q_no">Q No</label>
		</div>
>>>>>>> origin/master
	    <div class="input-field col s6">
          <input id="question" type="text" class="validate" name="question">
          <label for="question">Question</label>
        </div>
	</div>
	<div class="row">
<<<<<<< HEAD
	    <div class="input-field col s6">
          <p>
      <input type="checkbox" id="chk1" name="image" value="image"/>
      <label for="chk1">Image</label>
	  &nbsp&nbsp&nbsp
      <input type="checkbox" id="chk2" name="mcq" value="mcq"/>
      <label for="chk2">MCQ</label>
    </p>
        </div>	
	</div>
	<span class="image-txt hide">	
	Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
	</span>
	<span class="mcq-txt hide">
	<div class="row">
=======
>>>>>>> origin/master
        <div class="input-field col s3">
          <input id="option1" type="text" class="validate" name="option1">
          <label for="optionq">Option1</label>
        </div>
        <div class="input-field col s3">
          <input id="option2" type="text" class="validate" name="option2">
          <label for="option">Option2</label>
        </div>
	</div>
	<div class="row">
        <div class="input-field col s3">
          <input id="option3" type="text" class="validate" name="option3">
          <label for="option3">Option3</label>
        </div>
        <div class="input-field col s3">
          <input id="option4" type="text" class="validate" name="option4">
          <label for="option4">Option4</label>
        </div>
	</div>
<<<<<<< HEAD
	</span>
=======
>>>>>>> origin/master
	<div class="row">
        <div class="input-field col s4">
          <input id="answer" type="text" class="validate" name="answer">
          <label for="answer">Correct Answer</label>
        </div>
		</div>
	<div class="row">
	<button class="btn waves-effect waves-light" type="submit" name="action">Submit
    <i class="mdi-content-send right"></i>
	</button>
    </form>
  </div>
<!--Begin Footer-->
<footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">UPES-CSI Student Chapter</h5>
<<<<<<< HEAD
					<p class="grey-text text-lighten-4">Address:<br> UPES-CSI Student Chapter<br> IT-Tower , CIT <br>University of Petroleum and Energy Studies <br>Energy Acres , P.O. Bidholi via Prem nagar , <br>Dehradun(248007) , Uttarakhand , India </p>
                </div>
                <div class="col l4 s12" style="overflow: hidden;">
                    <h5 class="white-text">Connect with us</h5>
                        <ul>
                            <li><a href="https://twitter.com/upescsi" class="twitter-follow-button" data-show-count="true" data-size="large">Follow @upescsi</a></li>
                            <li class="hide-on-small-only"><div class="fb-like" data-href="https://facebook.com/upescsi" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div></li>
                            <li class="hide-on-large-only"><div class="fb-like" data-href="https://facebook.com/upescsi" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div></li>
                        </ul>
=======
                    <p class="grey-text text-lighten-4">Hello world the content goes in here in rows and columns</p>
                </div>
                <div class="col l4 s12" style="overflow: hidden;">
                    <h5 class="white-text">Connect with us</h5>

                    <a href="https://twitter.com/upescsi" class="twitter-follow-button" data-show-count="true" data-size="large">Follow @upescsi</a>


>>>>>>> origin/master
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
<<<<<<< HEAD

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
$(':checkbox[name=mcq]').on('change', function() {
    if( $(':checkbox[value=mcq]').is(':checked') ) {
        $('span.mcq-txt').removeClass( 'hide' );
    } else {
        $('span.mcq-txt').addClass( 'hide' );
    }
});
$(':checkbox[name=image]').on('change', function() {
    if( $(':checkbox[value=image]').is(':checked') ) {
        $('span.image-txt').removeClass( 'hide' );
    } else {
        $('span.image-txt').addClass( 'hide' );
    }
});
</script>
=======
</body>
<!--Begin of Script Section-->
>>>>>>> origin/master
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