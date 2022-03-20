<?php 
session_start();
ob_start();
require_once ('samples/functions.php');
require_once ('samples/header.php'); ?>
<?php $log_error="<h5>&#128274; REMOVE CANDIDATES NOT CONTESTING IN RUNOFF</h5>";?>

<?php

/*removing an electoral candidate*/
if(isset($_POST['remove_submit'])){
    if($_POST['cand_name']==""||empty($_POST['cand_name']))
	{$log_error=log_error("&#128274; NAME OF CANDIDATE MISSING");}
    else{
    	 $cand_name=mysqli_real_escape_string($connection,$_POST['cand_name']);/*cleaning up candidate name*/
         $query0="SELECT * FROM E_CANDIDATES WHERE CNAME='{$cand_name}' ";/*checking to see if candidate really exists*/
		 $result0=mysqli_query($connection,$query0);
		 $rex0=mysqli_num_rows($result0);
		 if($rex0<1){$log_error=log_error("&#128274; CANDIDATE HAS DOES NOT EXIST");}
         else{
    	 $query="DELETE FROM E_CANDIDATES WHERE CNAME='{$cand_name}' ";/*deleting row details of candidate from user*/
         $result=mysqli_query($connection,$query);
         if($result){$log_error=log_error("&#x2713; CANDIDATE SUCCESSFULLY REMOVED","green");
              $queryx="SELECT * FROM E_CANDIDATES ";
									$resultx=mysqli_query($connection,$queryx);

									$can_list="";
									while($options=mysqli_fetch_assoc($resultx))
									{
										$cname=ucfirst($options['CNAME']);
										$cpost=ucfirst($options['CPOSITION']);
									    $can_list.="<span class='name'><b>Candidate Name: </b></span>".$cname."<br/>".
                                        "<span class='name'><b>Position: </b></span>". $cpost."<br/><br/>";	
									 
									}

       }
    }
}

}


/*Resetting all vote counters to 0 */
if(isset($_POST['reset_submit'])){
                                    $counter_query="UPDATE E_CANDIDATES SET CVOTES=0 ";
                                    $counter_reset=mysqli_query($connection,$counter_query);

                                    $counter_query2="UPDATE POSITIONS SET TOTAL_VOTES_CAST=0 ";
                                    $counter_reset2=mysqli_query($connection,$counter_query2);
                                    if($counter_reset2){$log_error=log_error("&#x2713; VOTE COUNTS FOR ALL CANDIDATES AND POSITIONS HAVE BEEN RESET","green");}
      
                                 }

/*loging out of system*/
if(isset($_POST['logout'])){header("Location: logout.php");}

?>

<link rel="stylesheet" href="css/runoff.css"/>
<script type="text/javascript">

function helpDrawer(){var view = document.getElementById("help_div");view.setAttribute("style","right:0px;");}
function helpClose(){
	var drawer=document.getElementById("help_div");
	drawer.setAttribute("style","right:-1000px;");}
function _(x){return document.getElementById(x);}
function restrict(elem){
var tf= _(elem);
var rx= new RegExp;
if(elem==="position"||elem==="cand_name"){rx=/[^.-a-zA-Z0-9 ]/gi;}
tf.value=tf.value.replace(rx,"");
}


</script>
</head>
<body>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="index_form" enctype="multipart/form-data">
		<?php echo $log_error; ?>
  <input type="text" onkeyup="restrict('cand_name');" id="cand_name" placeholder="&#128100; Name of candidate not contesting" name="cand_name"/><br/>
        <input type="submit" name="remove_submit" value="Remove Candidate &#10006; "/><br/>
        <input type="submit" name="reset_submit" value="Reset All Vote Counters &#x21bb;"/><br/>
        <input type="submit" name="logout" value="Logout &#8594;"/>
	</form>


  <div id="nav">
	<h4 class="help help1" onclick="helpDrawer();">Click Here If You Need Help</h4>
  <a href="logout.php"><h4>Logout</h4></a>
  </div>

	<div id="help_div">
    <ul>
    	   <li>Enter name of candidate not contesting in runoff and click the 'Remove Candidate' button.</li>
         <li>Click 'Reset All Vote Counters' to reset all previous results to zero.</li>
         <li>Click 'Logout' when process is complete and continue from the next page.</li>
     
        <li style="color:red;cursor:pointer;"  onclick="helpClose();">Close This</li>

    </ul>
	</div>


	<footer>Bit Distrikt Technologies &copy;<?php echo strtoupper(date("Y M d",time())); ?></footer>
   

</body>
</html>

<!--<nav class="index_nav">
                <a href="login.php" data-hover="Login &#8594;" id="lbutton"><span>Login &#8594;</span></a>
                <a href="signup.php" data-hover="Sign Up Now &#10155;" id="Sbutton"><span>Sign Up Now &#10155;</span></a>
               </nav>-->