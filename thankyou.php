<?php ob_start();
require_once ('samples/functions.php');
require_once ('samples/header.php'); ?>

<?php
/*getting the first position from the positions table*/
$quex="SELECT * FROM POSITIONS ";
$result=mysqli_query($connection,$quex);
$respos=mysqli_fetch_array($result);

$first_post= str_replace(' ','_',$respos['NAME']);


?>

<?php 
  $restart="<script type=\"text/javascript\">";
  $restart.="function votingRestart()";
  $restart.="{";
  $restart.="setTimeout(\"window.location='id_checker.php'\",3000);";
  $restart.="}";
  $restart.="</script>";

?>

<link rel="stylesheet" href="css/thankyou.css"/>
</head>
<?php echo $restart; ?>

<body onload="votingRestart();">
	

	<div id="overall_container">
       <h1>Thank You For Voting!</h1>
       <img src="images/thankyou.png"/>
	</div>
	
   

</body>
</html>
