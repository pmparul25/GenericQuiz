<?php
include 'config.php';
session_start();
$qname=$_GET['Name'];
echo $qname;
$delta = 24;
$reduce_brightness = true;
$reduce_gradients = true;
$num_results = 20;

include_once("colors.inc.php");
$ex=new GetMostCommonColors();
$colors=$ex->Get_Color("test.jpg", $num_results, $reduce_brightness, $reduce_gradients, $delta);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title>Image Color Extraction</title>
	<style type="text/css">
		* {margin: 0; padding: 0}
		body {text-align: center;}
		div#wrap {margin: 10px auto; text-align: left; position: relative; width: 500px;}
		img {width: 200px;}
		table {border: solid #000 1px; border-collapse: collapse;}
		td {border: solid #000 1px; padding: 2px 5px; white-space: nowrap;}
		br {width: 100%; height: 1px; clear: both; }
	</style>
</head>
<body>
<div id="wrap">
<?php
$colors=$ex->Get_Color("information/$qname.jpg", $num_results, $reduce_brightness, $reduce_gradients, $delta);
?>
<?php
$max=0;
$maxcolor='#000';
foreach ( $colors as $hex => $count )
{
	if ( $count > $max )
	{
		$max = $count;
		$maxcolor = $hex;
	}
}
$_SESSION['max-color'] = $maxcolor;
$_SESSION['qname'] = $qname;
header('Location: information.php');
?>
</div>
</body>
</html>
