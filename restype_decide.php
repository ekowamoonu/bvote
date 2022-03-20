<?php ob_start();
require_once ('samples/functions.php');
require_once ('samples/header.php'); ?>

<link rel="stylesheet" href="css/restype_decide.css"/>
</head>

<?php
/*getting the first position from the positions table*/
$quex="SELECT * FROM POSITIONS ";
$result=mysqli_query($connection,$quex);
$respos=mysqli_fetch_array($result);

$first_post= str_replace(' ','_',$respos['NAME']);



?>
<body>

 <nav>
 	<a href="res.php" target="_blank">View Vote-in-Progess Results &#8594;</a>
 	<a href="res_final.php?results=<?php echo $first_post; ?>" target="_blank">View Final Election Results &#8594;</a>
 </nav>

 <footer>Bit Distrikt Technologies &copy;<?php echo strtoupper(date("Y M d",time())); ?></footer>
 
</body>
</html>

<!--<nav class="index_nav">
                <a href="login.php" data-hover="Login &#8594;" id="lbutton"><span>Login &#8594;</span></a>
                <a href="signup.php" data-hover="Sign Up Now &#10155;" id="Sbutton"><span>Sign Up Now &#10155;</span></a>
               </nav>-->