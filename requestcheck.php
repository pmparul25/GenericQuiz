<?php
//This Php Code Uploads the quiz and Insert values to 'quizzes' table from where Quiz Card is Displayed
//Fetches Info from form at request.php
//Entry on request.php are made by Event head only!
include 'config.php';
session_start();
//db update variables
$qn=$_POST['quiz_name'];
$on=$_POST['o_name'];
if($_POST['group1']=='1')
{
	$sd=$_POST['start_date'];
	$st=$_POST['start_time'];
	$ed=$_POST['end_date'];
	$et=$_POST['end_time'];
	$ent = mysql_query("INSERT into quizzes (quiz_name,o_name,start_date,start_time,end_date,end_time) values ('$qn','$on','$sd','$st','$ed','$et')") or die("Sorry, Technical Failure");
	$entry = mysql_query("CREATE TABLE ".$qn."_score (email varchar(40) Primary Key,name varchar(20), score varchar(5),time varchar(30))") or die("Could not create table");
	if($ent && $entry)
	{	
		echo "<script>alert('Quiz Uploaded.');</script>";
		header('Location: index.php');
	}
	else
	{
		echo "<script>alert('Quiz NOT Uploaded. Try Again');</script>";
		header('Location: request.php');
	}
}
else
if($_POST['group1']=='0')
{
	$rm=mysql_query("DELETE from quizzes WHERE quiz_name='$qn' AND o_name='$on'") or die("query error");
	if($rm)
	{	
		echo "<script>alert('Quiz Removed.');</script>";
		header('Location: index.php');
	}
	else
	{
		echo "<script>alert('Quiz NOT Removed. Quiz Name or Organizer Name is Incorrect Not Correct');</script>";
		header('Location: request.php');
	}
}	
?>
