<?php ob_start();
require_once ('samples/functions.php');
require_once ('samples/header.php');
$log_error="<h5>THE BID B-VOTE LOGIN</h5>";
?>

<?php
/*authentication when user opts to enter the administrator setup*/
if(isset($_POST['admin_submit'])){
     
      if(!empty($_POST['pass1'])||!empty($_POST['pass2'])||!empty($_POST['pass3'])||empty($_POST['passa'])||$_POST['passa']==null)
      {
      	$log_error=log_error();
      }

      else
      {
         $main_syscde=$_POST['passa'];
        if(code_validate("CODE","SYSCODE",$main_syscde,"ms")){header("Location: val2.php");}
        else{$log_error=log_error();}

      }

}

/*authentication code when user opts to enter any other portal*/
if(isset($_POST['id_submit']) || isset($_POST['vote_submit']) ||isset($_POST['results_submit']))
  {
      if(empty($_POST['pass1'])||empty($_POST['pass2'])||empty($_POST['pass3'])||empty($_POST['passa'])||$_POST['passa']==null||
           $_POST['pass1']==""||$_POST['pass2']==""||$_POST['pass3']==""){$log_error=log_error("FIELDS INTENTIONALLY LEFT BLANK!");}

      else
      {
         $first=$_POST['pass1'];
         $second=$_POST['pass2'];
         $third=$_POST['pass3'];
         $main_syscde=$_POST['passa'];
         
         if(code_validate("CODE","FIRSTEXEC",$first)&&code_validate("CODE","SECONDEXEC",$second)&&code_validate("CODE","THIRDEXEC",$second)
             &&code_validate("CODE","THIRDEXEC",$third)&&code_validate("CODE","SYSCODE",$main_syscde,"ms")
         	)
         {
            header("Location: val3.php");
         }

         else{$log_error=log_error();}



      }



  }
?>

<link rel="stylesheet" href="css/index.css"/>
</head>
<body>
	

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="index_form">
		<?php echo $log_error; ?>
		<input type="password" placeholder="&#128274; First Admin Passcode" name="pass1"/><br/>
		<input type="password" placeholder="&#128274; Second Admin Passcode" name="pass2"/><br/>
        <input type="password" placeholder="&#128274; Third Admin Passcode" name="pass3"/><br/>
        <input type="password" placeholder="&#128274; Main System Passcode" name="passa"/><br/>
        <input type="submit" name="admin_submit" value="Administrator Setup &#8594;"/><br/>
        <input type="submit" name="id_submit" value="Proceed To ID Validation Portal &#8594;"/><br/>
        <input type="submit" name="vote_submit" value="Proceed To Begin Elections &#8594;"/><br/>
        <input type="submit" name="results_submit" value="View Election Results &#8594;"/>
       
	</form>

	<footer>Bit Distrikt Technologies &copy;<?php echo strtoupper(date("Y M d",time())); ?></footer>
   

</body>
</html>

<!--<nav class="index_nav">
                <a href="login.php" data-hover="Login &#8594;" id="lbutton"><span>Login &#8594;</span></a>
                <a href="signup.php" data-hover="Sign Up Now &#10155;" id="Sbutton"><span>Sign Up Now &#10155;</span></a>
               </nav>-->