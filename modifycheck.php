<?php
//modify.php form redirects here
//If quiz organizer makes some mistake while entering question so he/she can change it later at this page i.e. modify.php
include 'config.php';
session_start();
if($_POST['quiz_name'])
{
$qname=$_POST['quiz_name'];
$qno_old=$_POST['qno_old'];
$qno_new=$_POST['qno_new'];
$modify=mysql_query("UPDATE quizzes SET quiz_no='$qno_new' WHERE quiz_no='$qno_old' AND quiz_name='$qname'") or die ("Update query Error,Check Values Again");
if($modify)
	header('Location: modify.php');
}
else
	header('Location: index.php');
?>