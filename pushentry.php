<?php
include 'config.php';
session_start();
$qname=$_SESSION['qname'];
$organizer=$_SESSION['oname'];
$question=$_POST['question'];
$answer=$_POST['answer'];
?>
<?php
//This Php Section is used to UPLOAD image for quiz
//It creates a dir named as 'quiz name' and enters source url to url section and uploads the image
if(isset($_FILES["fileToUpload"]["name"]) && $_FILES["fileToUpload"]["name"]!='')
{	
	$target_dir = "uploads/$qname/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
if(isset($target_file))
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (isset($target_file) && file_exists($target_file)) {
        echo "<script>alert('File Name Already exits. Suggestion:Change filename'); </script>";
    $uploadOk = 0;
}
// Check file size
if (isset($target_file) && $_FILES["fileToUpload"]["size"] > 2048000) {
        echo "<script>alert('File Size too large.Make it less then 2MB'); </script>";
    $uploadOk = 0;
}
// Allow certain file formats
if(isset($target_file) && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
&& $imageFileType != "GIF") {
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded. Suggestion: Change File Name'); </script>";
// if everything is ok, try to upload file
} else {
    if (isset($target_file) && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<script>alert('The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.');</script>";
    } else if (isset($target_file)){
        echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
    }
}
}
?>
<?php
//This Section of Php code is used to insert values to quiz table accordingly
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//If Question Contains Options Only
if(isset($_POST['option1']) && isset($_POST['option2']) && empty($_FILES["fileToUpload"]["name"]))
{
$option1=$_POST['option1'];
$option2=$_POST['option2'];
$option3=$_POST['option3'];
$option4=$_POST['option4'];
$push = mysql_query("Insert into $qname (question,option1,option2,option3,option4,answer,organizer) values ('$question','$option1','$option2','$option3','$option4','$answer','$organizer')");
}
//If Question contains Image and Options Both
else
	if(isset($_POST['option1'])&&isset($_POST['option2']) && isset($_FILES["fileToUpload"]["name"]))
	{
		$option1=$_POST['option1'];
		$option2=$_POST['option2'];
		$option3=$_POST['option3'];
		$option4=$_POST['option4'];
		$push = mysql_query("Insert into $qname (question,option1,option2,option3,option4,img_url,answer,organizer) values ('$question','$option1','$option2','$option3','$option4','$target_file','$answer','$organizer')");
	}
//If Question Contains Image Only
else
	if(empty($_POST['option2']) && isset($_FILES["fileToUpload"]["name"]))
	{
		$push = mysql_query("Insert into $qname (question,img_url,answer,organizer) values ('$question','$target_file','$answer','$organizer')");
	}
//If Question Contains Answer Only No Option No Image
else	
{
$push = mysql_query("Insert into $qname (question,answer,organizer) values ('$question','$answer','$organizer')");
}

if (mysql_errno() == 1062) 
	{	
		echo "<script>alert('Duplicate Entry for Question Number. Contact Admin');</script>";
		echo "<script>window.location = 'pushentey.php';</script>";
	}
else
if($push)
	{
		echo "<script>alert('Entry Accepted');</script>";
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link id="page_favicon" href="favicon.ico" rel="icon" type="image/x-icon">
    <title>Enter Quiz Questions</title>
    <style>
		.hide {
  display: none;
}
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
                <li><a href="index.php">Home</a></li>
                <li><a href="register.html">Register</a></li>
				<li><a href="about.html">About</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="index.php">Home</a></li>
                <li><a href="register.html">Register</a></li>
                <li><a href="about.html">About</a></li>
            </ul>
        </div>
    </nav>
    <!--end Header-->
<form class="col s12" method="POST" action="pushentry.php" enctype="multipart/form-data">
	<div class="row">
        <div class="input-field col s2">
          <input disabled id="disabled" type="text" class="validate">
          <label><?php echo $qname;?></label>
        </div>
      </div>
    <div class="row">
	    <div class="input-field col s6">
          <input id="question" type="text" class="validate" name="question">
          <label for="question">Question</label>
        </div>
	<div class="row">
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
	</span>
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
	</div>
</form>
    <a href="done.php" class="btn waves-effect waves-light" id="finished">Finished
    <i class="mdi-content-send right"></i></a>
<!--Begin Footer-->
<footer class="page-footer">
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
	echo 'Entry Invalid';
?>