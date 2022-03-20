<?php 
session_start();
ob_start();
if(!isset($_SESSION['STD_LOG'])){header("Location: val3.php");}
require_once ('samples/functions.php');
require_once ('samples/header.php'); ?>

<?php
/*getting the first position from the positions table*/
/*$quex="SELECT * FROM POSITIONS ";
$result=mysqli_query($connection,$quex);
$respos=mysqli_fetch_array($result);

$first_post= str_replace(' ','_',$respos['NAME']);*/



?>

<link rel="stylesheet" href="css/instructions.css"/>
</head>
<body>
	

	<div id="overall_container">
		<div id="proceed_div"><img src="images/proceed.png"/></div>
		<div id="instruction_set">
			<ul>
				<li>This system protects all voting data on a secured database where it is encrypted and stored.</li>
				<li>Copies of the election results will automatically be generated on the server pc to prevent rigging.</li>
			    <li>The Student's ID Validation Portal is where the ID of every student to vote is validated before he/she continuous to voting.</li>
				<li>Any number of computers can be used for the ID checking.</li>
				<li>This system does not allow multiple voting by a single student.</li>
				<li>It does this by dynamically checking whether the ID has been used before as the agent enters it.</li>
				<li>Final results can be viewed only when the election is over.</li>
				<li>Click proceed to be directed to the Student's ID Validation Portal.</li>
				
			</ul>
		</div>
		<a href="stdlog.php" style="margin-left:150px;text-align:center;">Proceed To ID Validations &#8594;</a>
   
	</div>
	
   

</body>
</html>
