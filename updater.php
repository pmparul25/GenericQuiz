<?php
include 'config.php';
session_start();
$u_q_no=$_SESSION['u_q_no'];
$qname=$_SESSION['qname'];
$organizer=$_SESSION['oname'];
$question=$_POST['question'];
$option1=$_POST['option1'];
$option2=$_POST['option2'];
$option3=$_POST['option3'];
$option4=$_POST['option4'];
$answer=$_POST['answer'];
?>
<?php
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
//Background Code to Update Questions

//Question Consisting Options Only
if(isset($_POST['option1']) && isset($_POST['option2']) && empty($_FILES["fileToUpload"]["name"]))
{
$option1=$_POST['option1'];
$option2=$_POST['option2'];
$option3=$_POST['option3'];
$option4=$_POST['option4'];
$push = mysql_query("UPDATE $qname SET question='$question',option1='$option1',option2='$option2',option3='$option3',option4='$option4',answer='$answer' WHERE q_no='$u_q_no'");
}
//Questions Containing Image and Options Both
else
	if(isset($_POST['option1'])&&isset($_POST['option2']) && isset($_FILES["fileToUpload"]["name"]))
	{
		$option1=$_POST['option1'];
		$option2=$_POST['option2'];
		$option3=$_POST['option3'];
		$option4=$_POST['option4'];
		$push = mysql_query("UPDATE $qname SET question='$question',option1='$option1',option2='$option2',option3='$option3',option4='$option4',img_url='$target_file',answer='$answer' WHERE q_no='$u_q_no'");
	}
//Questions Containing Image Only
else
	if(empty($_POST['option2']) && isset($_FILES["fileToUpload"]["name"]))
	{
		$push = mysql_query("Insert into $qname (question,img_url,answer,organizer) values ('$question','$target_file','$answer','$organizer')");
	}
//Questions Containing Image for Update
else	
{
$push = mysql_query("UPDATE $qname SET question='$question',img_url='$target_file',answer='$answer' WHERE q_no='$u_q_no'");
}
if($push)
	header('Location: done.php');
else
	echo "<script>alert('Unable to UPDATE!');window.location = 'update.php';</script>";
?>