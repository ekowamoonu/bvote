<?php 
session_start();
ob_start(); 
if(!isset($_SESSION['ADMIN'])){header("Location: val3.php");}

?>
<?php require_once ('samples/functions.php'); ?>
<?php require_once ('samples/header.php'); ?>
<?php  $log_error="<h5>&#128274; SETUP PASSWORDS FOR THREE MAJOR POLLING AGENTS. ENTER PASSWORDS INDIVUDUALLY.</h5>";?>

<?php 

//check if administrator privileges have already been set
$queryn="SELECT ACTIVATION FROM ACTIVATED "; 
$queryn.="WHERE ID=2";
$rea=mysqli_query($connection,$queryn);

$act=mysqli_fetch_assoc($rea);

if($act['ACTIVATION']==0){$status_admin_setup="";$status="disabled";}
else{$status_admin_setup="disabled";$status="";}


?>


<?php
 /*code to set up three admin passwords*/
 if(isset($_POST['admin_submit']))
 {
 	/*enforce check to make sure that admin codes are not set twice*/
 	$query_check="SELECT CODE FROM FIRSTEXEC ";
 	$check=mysqli_query($connection,$query_check);
 	$check_res=mysqli_num_rows($check);
 	if($check_res>=1){$log_error=log_error("&#128274; ADMINISTRATOR PRIVILEGES ALREADY SETUP");}

    else{
    if($_POST['pass1']!=null&&$_POST['pass2']!=null&&$_POST['pass3']!=null&&$_POST['pass1c']!=null&&$_POST['pass2c']!=null
        &&$_POST['pass3c']!=null)
      {    

          $fexe=$_POST['pass1'];
      	  $sexe=$_POST['pass2'];
      	  $texe=$_POST['pass3'];
      	  $fexec=$_POST['pass1c'];
      	  $sexec=$_POST['pass2c'];
      	  $texec=$_POST['pass3c'];
          if(slen($fexec)&&slen($sexec)&&slen($texec))
             {
                if(check_pass($fexe,$fexec)&&check_pass($sexe,$sexec)&&check_pass($texe,$texec))
                	{
                		  $fexec_prep=prep_code($fexec);
                		   $sexec_prep=prep_code($sexec);
                		   $texec_prep=prep_code($texec);
                          
                            if(insert_query("FIRSTEXEC",$fexec_prep)&&insert_query("SECONDEXEC",$sexec_prep)&&insert_query("THIRDEXEC",$texec_prep))
                              {
                                $queryz="UPDATE ACTIVATED ";
                                $queryz.="SET ACTIVATION=1 WHERE ID=2 ";
                                $active=mysqli_query($connection,$queryz);

                                $queryn="SELECT ACTIVATION FROM ACTIVATED "; 
                                    $queryn.="WHERE ID=2";
                                    $rea=mysqli_query($connection,$queryn);

                                    $act=mysqli_fetch_assoc($rea);

                                    if($act['ACTIVATION']==0){$status_admin_setup="";$status="disabled";}
                                    else{$status_admin_setup="disabled";$status="";}
                                if($active){
                              	$log_error=log_error("&#128274; ADMINISTRATOR PRIVILEGES SETUP COMPLETE, PROCEED TO ADDING CANDIDATES AND POSTIONS","green");
                                   }
                                
                              }
                      
                  

                	}
                else{$log_error=log_error("&#128274; PASSWORD CONFIRM FIELDS DON'T MATCH");}
             }

          else{$log_error=log_error("&#128274; PASSWORD CHARACTERS SHOULD BE 10 CHARACTERS OR MORE");}


      }
    
     else{$log_error=log_error("&#128274; ALL THREE ADMINS MUST SET AND CONFIRM THEIR PASSWORDS");}
}
   
}


 /*code to proceed to adding election candidates and electoral positions*/
if(isset($_POST['ar_submit'])){$_SESSION['admin_check']=2;header("Location: addcandidates.php");}

 /*code to proceed to setting up runoff*/
if(isset($_POST['ro_submit'])){header("Location: runoff.php");}

?>
<link rel="stylesheet" href="css/admin.css"/>
</head>
<body>
	
  <div id="nav">
  <a href="logout.php"><h4>Logout</h4></a>
  </div>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="index_form">
		<?php echo $log_error; ?>
		<input type="password" placeholder="&#128274; First Admin Password  (10 characters or more)" name="pass1"/>
		<input type="password" placeholder="&#128274; First Admin Password Confirm" name="pass1c"/><br/>
		<input type="password" placeholder="&#128274; Second Admin Password  (10 characters or more)" name="pass2"/>
		<input type="password" placeholder="&#128274; Second Admin Password Confirm" name="pass2c"/><br/>
        <input type="password" placeholder="&#128274; Third Admin Password  (10 characters or more)" name="pass3"/>
        <input type="password" placeholder="&#128274; Third Admin Password Confirm" name="pass3c"/><br/>
        <input type="submit" name="admin_submit" <?php echo $status_admin_setup; ?> value="Set Passwords (Can't Be Changed Once They Are Set)"/><br/>
        <input type="submit" name="ar_submit" <?php echo $status; ?> value="Add/Remove Election Candidates &#8594;"/>
        <input type="submit" name="ro_submit" <?php echo $status; ?> value="RunOff SetUp &#8594;"/>
  
	</form>

	<footer>Bit Distrikt Technologies &copy;<?php echo strtoupper(date("Y M d",time())); ?></footer>
   

</body>
</html>
