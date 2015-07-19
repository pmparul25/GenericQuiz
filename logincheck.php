<?php
//index.php login form redirect here
//Check corresponding entry of user in table 'users' Entry in 'users' table is made via register.html
include 'config.php';
session_start();
$email=$_POST['email'];
$pass=$_POST['password'];
$chk= mysql_query("SELECT * FROM users WHERE email='".$email."' AND password='".$pass."'") or die("Could not execute query");
$arr=mysql_fetch_array($chk);
$name=$arr['name'];
$cou=mysql_num_rows($chk);
if($cou == 0)
{
	header('Location: index.php?no_entry_found');
}
else
{	
	echo $_SESSION['email']=$email;
	echo $_SESSION['name']=$name;
	header('Location: index.php');
}

?>