<?php
include 'config.php';
session_start();
$db = $_SESSION['qname'];
$quizname=$db.'_score';
//$answer=$_POST['group1'];
$fetch=mysql_query("SELECT * from $db WHERE q_no='".$_SESSION['q_no']."'");
$ans=mysql_fetch_array($fetch);
$result = mysql_query("SELECT * FROM $db");
$num_rows = mysql_num_rows($result);
$_SESSION['count']=$num_rows;
if($_SESSION['q_no']<$num_rows)
{
	if(!empty($_POST['check_list'])) 
	{
		$check = $_POST['check_list'];
		$a=0; //Number of answers given
		$x=0; //Total Number of options marked by user
		$d=0; //While loop constrain initialization
		while($d<=3)
		{
			if(isset($check[$d]))
				$x=$x+1;
				$d++;
		}
		$i = substr_count($ans['answer'], ',');
		$answ = explode(",",$ans['answer']);
		for($j=0;$j<=$i;$j++)
		{
			for($z=0;$z<4;$z++)
			{
				if(isset($check[$z]))
				{
					if($answ[$j]==$check[$z])
						$a=$a+1;
				}
			}
		}
				$c=$a/($i+1);		//$c is the Positive Score Scored by the user
				$y=($x-$a)/($i+1);  //$y is the Negative Score Scored by the user
				$f=$c-$y;			//$f is the Final Score to be updated
		$t=time();
		echo($t . "<br>");
		echo(date("Y-m-d",$t));
		$upd=mysql_query("UPDATE $quizname SET score=score+'$f', time='$t' WHERE email='".$_SESSION['email']."'") or die("Score Not Updated");
		$_SESSION['q_no']=$_SESSION['q_no']+1;
		header('Location: quiz.php?Name='.$db);
	}
	else
	{
		$_SESSION['q_no']=$_SESSION['q_no']+1;
		header('Location: quiz.php?Name='.$db);
	}
}
else
{
	if(!empty($_POST['check_list'])) 
	{
		$check = $_POST['check_list'];
		$a=0; //Number of answers given
		$x=0; //Total Number of options marked by user
		$d=0; //While loop constrain initialization
		while($d<=3)
		{
			if(isset($check[$d]))
				$x=$x+1;
				$d++;
		}
		$i = substr_count($ans['answer'], ',');
		$answ = explode(",",$ans['answer']);
		for($j=0;$j<=$i;$j++)
		{
			for($z=0;$z<4;$z++)
			{
				if(isset($check[$z]))
				{
					if($answ[$j]==$check[$z])
						$a=$a+1;
				}
			}
		}
				$c=$a/($i+1);		//$c is the Positive Score Scored by the user
				$y=($x-$a)/($i+1);  //$y is the Negative Score Scored by the user
				$f=$c-$y;			//$f is the Final Score to be updated
		$t=time();
		echo($t . "<br>");
		echo(date("Y-m-d",$t));
		$upd=mysql_query("UPDATE $quizname SET score=score+'$f' , time='$t' WHERE email='".$_SESSION['email']."'") or die("Score Not Updated");
		header('Location: result.php?Name='.$db);
	}
	else
	{
		header('Location: result.php?Name='.$db);
	}
}
?>
