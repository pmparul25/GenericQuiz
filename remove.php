<?php
//Removing Quiz Which is completed or has some error other for other reasons!!
include 'config.php';
session_start();
$_SESSION['r_q_no']=$_POST['r_q_no'];
$r_q_no=$_POST['r_q_no'];
$qname=$_SESSION['qname'];
$organizer=$_SESSION['oname'];
$remove=mysql_query("DELETE from $qname WHERE q_no='$r_q_no'");
header('Location: done.php');
?>