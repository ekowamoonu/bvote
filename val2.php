<?php ob_start();
require_once ('samples/functions.php');
require_once ('samples/header.php');
 $log_error="<h5 style='color:red;'>LEVEL 2 AUTHENTICATION</h5>"; ?>

<?php
if(isset($_POST['admin_submit'])){
     if(empty($_POST['passa1'])||$_POST['passa1']==""||empty($_POST['passa2'])||$_POST['passa2']=="")
     {$log_error=log_error("FIELDS INTENTIONALLY LEFT BLANK!");}

    else{
    	  $pass_one=mysqli_real_escape_string($connection,$_POST['passa1']);
    	  $pass_two=mysqli_real_escape_string($connection,$_POST['passa2']);

    	  if(code_validate("CODE","SYSCODE",$pass_one,"ms1")&&code_validate("CODE","SYSCODE",$pass_two,"ms2")){
                  header("Location: val3.php");
    	  }

    	  else{$log_error=log_error();}
        }

}

?>

<link rel="stylesheet" href="css/val2.css"/>
</head>
<body>
	

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="index_form">
		<?php echo $log_error; ?>
		<input type="password" placeholder="&#128274; System PassCode One" name="passa1"/><br/>
        <input type="password" placeholder="&#128274; System PassCode Two" name="passa2"/><br/>
        <input type="submit" name="admin_submit" value="Verify &#8594;"/><br/>
	</form>

	<footer>Bit Distrikt Technologies &copy;<?php echo strtoupper(date("Y M d",time())); ?></footer>
   

</body>
</html>

