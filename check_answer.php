<?php
/*
**This Code Checks the answer!!
**MCQ-Single Choice
**MCQ-Multiple Choice
***Multiple Choice check consists of +ve as well as -ve marking depending upon number of options selected
**Text Input Answers
*/
include 'config.php';
session_start();
$db = $_SESSION['qname'];
$quizname=$db.'_score';
//$answer=$_POST['group1'];
//$ans['answer'] consists of correct answer
$fetch=mysql_query("SELECT * from $db WHERE q_no='".$_SESSION['q_no']."'");
$ans=mysql_fetch_array($fetch);
$result = mysql_query("SELECT * FROM $db");
$num_rows = mysql_num_rows($result);
$_SESSION['count']=$num_rows;
//If Question No. < Last Question No.
//In order to redirect it to Next Question page
if($_SESSION['q_no']<$num_rows)
{
	//If Answer is MCQ
	if(!empty($_POST['check_list'])) 
	{
		$check = $_POST['check_list'];
		$a=0; //Number of answers given
		$x=0; //Total Number of options marked by user
		$d=0; //While loop constrain initialization
		while($d<=3)
		{
			if(isset($check[$d]))
				$x=$x+1;//Counting value for $x
				$d++;
		}
		// Exploding Multiple Answers by ',' in order to check to multiple options
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
		$upd=mysql_query("UPDATE $quizname SET score=score+'$f' WHERE email='".$_SESSION['email']."'") or die("Score Not Updated");
		$_SESSION['q_no']=$_SESSION['q_no']+1;
		header('Location: quiz.php?Name='.$db);
	}
	//Checking for Simple Text String Answer
	else
		if(isset($_POST['answer']))
		{
			if($_POST['answer']==$ans['answer'])
			{
				$upd=mysql_query("UPDATE $quizname SET score=score+1 WHERE email='".$_SESSION['email']."'") or die("Score Not Updated");
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
		$_SESSION['q_no']=$_SESSION['q_no']+1;
		header('Location: quiz.php?Name='.$db);
	}
}
//When Current Question is Last one of quiz
//In order to redirect it to result page
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
		$upd=mysql_query("UPDATE $quizname SET score=score+'$f' WHERE email='".$_SESSION['email']."'") or die("Score Not Updated");
		header('Location: result.php?Name='.$db);
	}
	else
		if(isset($_POST['answer']))
		{
			if($_POST['answer']==$ans['answer'])
			{
				$upd=mysql_query("UPDATE $quizname SET score=score+1 WHERE email='".$_SESSION['email']."'") or die("Score Not Updated");
				header('Location: result.php?Name='.$db);
			}
			else
			{
				header('Location: result.php?Name='.$db);
			}
		}
	else
	{
		header('Location: result.php?Name='.$db);
	}
}
?>