<?php ob_start();
require_once ('samples/functions.php');
require_once ('samples/header.php'); ?>

<?php  $log_error="<h5 id=\"header\">LOGIN WITH YOUR STUDENT ID.</h5>";?>


<?php
/*getting the first position from the positions table*/
$quex="SELECT * FROM POSITIONS ";
$result=mysqli_query($connection,$quex);
$respos=mysqli_fetch_array($result);

$first_post= str_replace(' ','_',$respos['NAME']);

?>

<?php

$input="<input  type=\"text\" id=\"id\" placeholder=\"&#128100; Enter Your ID Number Here\" name=\"id\" onkeyup=\"validate('{$first_post}');restrict('id');\"/><br/>";

?>

<link rel="stylesheet" href="css/id_checker.css"/>
<script type="text/javascript">
    
    var color=0;
    function colorChange()
    {
         var color_array=["#20b45e","#3db546","#23d475"];
          setInterval(function(){
          var bodymain=document.getElementById("bodymain");
           bodymain.setAttribute("style","background-color:"+color_array[color]+";"+'"');
      
          color++;
          if(color>2){color=0;}
          },3000);
   
    }

    function _(x){return document.getElementById(x);}
function restrict(elem){
var tf= _(elem);
var rx= new RegExp;
if(elem==="id"){rx=/[^0-9]/gi;}
tf.value=tf.value.replace(rx,"");
}


</script>
 <script type="text/javascript" src="js/jquery.js"></script>
 <script type="text/javascript" src="js/id_check_parser.js"></script>
</head>
<body id="bodymain" onload="colorChange();">
	

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="index_form">
		<?php echo $log_error; ?>
    <?php echo $input; ?>
		<!-- <input type="text" placeholder="&#128100; Enter Your ID Number Here" name="id" onkeyup="restrict('id');" id="id"/><br/> -->
    <div id="loader">
<!--       <img src="images/283.GIF"/> -->
    </div>
	</form>
	<footer>Bit Distrikt Technologies &copy;<?php echo strtoupper(date("Y M d",time())); ?></footer>
   

</body>
</html>
