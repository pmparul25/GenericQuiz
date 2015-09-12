<?php
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
mkdir("uploads/$qname", 0777);
$sql = mysql_query("CREATE TABLE $qname(
q_no INT(6) PRIMARY KEY AUTO_INCREMENT, 
question VARCHAR(250) NOT NULL,
option1 VARCHAR(50),
option2 VARCHAR(50),
option3 VARCHAR(50),
option4 VARCHAR(50),
answer VARCHAR(50) NOT NULL,
img_url VARCHAR(100),
organizer VARCHAR(50) NOT NULL
)") or die("Table Already Exists, Contact Database Admin");
if($sql)
	header('Location: pushentry.php');
else
	echo "<script>alert('Unable to Create Table!! Contact Admin.');window.location= 'authtocreate.php';</script>";
?>