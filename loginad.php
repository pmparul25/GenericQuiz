<?php
<<<<<<< HEAD
//Check whether the user logging in has permission to create a quiz or not
//authtocreate.php form redirects here
//To give permission to a user DB Admin have to make entry for that user in table 'loginad' which contains Email Name Password and UID(Unique CSI ID)
=======
<<<<<<< HEAD
//Check whether the user logging in has permission to create a quiz or not
//authtocreate.php form redirects here
//To give permission to a user DB Admin have to make entry for that user in table 'loginad' which contains Email Name Password and UID(Unique CSI ID)
=======
>>>>>>> origin/master
>>>>>>> bfa3cfb0d8e98fca6183b53f2033fab038aed1c0
session_start();
include 'config.php';
$UID = $_POST['UID'];
$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['password'];
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======

>>>>>>> origin/master
>>>>>>> bfa3cfb0d8e98fca6183b53f2033fab038aed1c0
$que=mysql_query("SELECT * FROM loginad WHERE email='".$email."' AND password='".$pass."' AND UID='".$UID."'") or die("Could not execute query");
$cou=mysql_num_rows($que);
if($cou == 0)
{
	header('Location: authtocreate.php');
	//echo $cou;
	//echo $value;
}
else
{
	$_SESSION['email']=$email;
	$perform=mysql_query("UPDATE loginad SET permission=1 WHERE  email='".$email."'") or die("Could not execute Query");
	header('Location: createquiz.php');
}
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======

>>>>>>> origin/master
>>>>>>> bfa3cfb0d8e98fca6183b53f2033fab038aed1c0
?>