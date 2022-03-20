<?php 
ob_start();
session_start();


//if(!isset($_SESSION['admin_check'])){header("Location: admin.php");}

require_once ('samples/functions.php');
require_once ('samples/header.php'); ?>
<?php $log_error="<h5>&#128274; ADD POSITIONS AND ELECTORAL CANDIDATES HERE</h5>";?>

<?php

/*select list of all positons on page load*/
$queryx="SELECT * FROM POSITIONS ";
$resultx=mysqli_query($connection,$queryx);
$position_select="";
while($options=mysqli_fetch_assoc($resultx))
				{
					$opt=$options['NAME'];
					$position_select.="<option value='{$opt}'>".str_replace('_',' ',$options['NAME'])."</option>";
				}

/*select lists of all candidates on page load*/
$queryy="SELECT * FROM E_CANDIDATES ";
$resulty=mysqli_query($connection,$queryy);

$can_list="";
while($coptions=mysqli_fetch_assoc($resulty))
{
	$cname=ucfirst($coptions['CNAME']);
	$cpost=ucfirst($coptions['CPOSITION']);
	$can_list.="<span class='name'><b>Candidate Name: </b></span>".$cname."<br/>".
            "<span class='name'><b>Position: </b></span>". $cpost."<br/><br/>";	
}

?>

<?php

/*adding electoral candidate*/
if(isset($_POST['add_submit'])){
	if($_POST['position']=="default"||$_POST['cand_name']==""||empty($_POST['cand_name'])||empty($_FILES["file"]["name"]))
	{$log_error=log_error("&#128274; NAME / IMAGE / POSITION OF CANDIDATE MISSING");}
    else{
    	 $cand_position=$_POST['position'];/*getting position candidate is contesting for*/
    	 $cand_name=mysqli_real_escape_string($connection,$_POST['cand_name']);/*cleaning user input*/

          if(exists($cand_name,"E_CANDIDATES","CNAME")){$log_error=log_error("CANDIDATE ALREADY ADDED");}/*function to check if name already exists*/
          else{
          	 $query="INSERT INTO E_CANDIDATES(CNAME,CPOSITION) VALUES( ";/*insert candidate details into database*/
	    	 $query.="'{$cand_name}','{$cand_position}')";
	         $result=mysqli_query($connection,$query);
	         if($result){$log_error=log_error("&#x2713; CANDIDATE SUCCESSFULLY ADDED","green"); 
                                    
     
                                    /*file upload function here */
									//echo mysqli_insert_id($connection);
	                                $location="candidate_images/";
	                                $name=$_FILES["file"]["name"];

                                  $exploded_name=explode(".",$name); //('name','jpg')
                                  $ext=end($exploded_name); //jpg
                                  
	                                /* $ext=end((explode(".",$name)));*///looks like this is deprecated in php7
	                                $new_name=mysqli_insert_id($connection).".".$ext;
	                              
									                //$type=$_FILES["file"]["type"];
                                  $tmp_details=$_FILES["file"]["tmp_name"];
									                $hello=move_uploaded_file($tmp_details,$location.$new_name);
                                    

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

/*removing an electoral candidate*/
if(isset($_POST['remove_submit'])){
    if($_POST['cand_name']==""||empty($_POST['cand_name']))
	{$log_error=log_error("&#128274; NAME OF CANDIDATE MISSING");}
    else{
    	 $cand_name=mysqli_real_escape_string($connection,$_POST['cand_name']);/*cleaning up candidate name*/
         $query0="SELECT * FROM E_CANDIDATES WHERE CNAME='{$cand_name}' ";/*checking to see if candidate really exists*/
		 $result0=mysqli_query($connection,$query0);
		 $rex0=mysqli_num_rows($result0);
		 if($rex0<1){$log_error=log_error("&#128274; CANDIDATE HAS NOT BEEN ADDED YET");}
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

/*adding new electoral positions*/
if(isset($_POST['position_submit'])){
	  if($_POST['eposition']==""||empty($_POST['eposition']))
	{$log_error=log_error("&#128274; PLEASE SPECIFY ELECTORAL POSITION SLOT");}
    else{
    	  $position=mysqli_real_escape_string($connection,str_replace(' ','_',$_POST['eposition']));
    	  //exists($position,"POSITIONS","NAME");
          if(exists($position,"POSITIONS","NAME")){$log_error=log_error("ELECTORAL POSITION SLOT ALREADY ADDED");}
           else{
		    	 $query="INSERT INTO POSITIONS(NAME) VALUES('{$position}') ";/*inserting into the position table*/
		         $result=mysqli_query($connection,$query);
		         $last_id=mysqli_insert_id($connection);
                 $id_before_last_id=$last_id-1;//picks previous id before last inserted id

		         if($result){$log_error=log_error("ELECTORAL POSITION SUCCESSFULLY ADDED","green");
									$queryx="SELECT * FROM POSITIONS ";
									$resultx=mysqli_query($connection,$queryx);
                                    
                                    /*ADDING NEXT PAGE TO POSITIONS TABLE*/
                                    $num_of_rows_query="SELECT * FROM POSITIONS ";
                                    $num_of_rows_check=mysqli_query($connection,$num_of_rows_query);
                                    $row_count=mysqli_num_rows($num_of_rows_check);
                                    
                                    if($row_count==1){//if block for next update
   														$next="UPDATE POSITIONS ";
   														$next.="SET NEXT='thankyou' ";
   														$next.="WHERE ID='{$last_id}' ";
   														$next_quex=mysqli_query($connection,$next);
                                                     }//if block for next update ends
                                   
                                    else             {//else block for next update starts
                                    	                 $next2="SELECT * FROM POSITIONS ";//trying to get name of last position inserted
                                    	                 $next2.="WHERE ID='{$last_id}' ";
                                    	                 $next_quex2=mysqli_query($connection,$next2);
                                    	                 $next2_results=mysqli_fetch_assoc($next_quex2);
                                    	                 $last_position_name=$next2_results['NAME'];
                                    	                 //$url_ext='.php';
                                    	                 $previous_next_value=$last_position_name;//.$url_ext;

                                                        $next="UPDATE POSITIONS ";/*set next to name of last inserted name*/
   														$next.="SET NEXT='{$previous_next_value}' ";
   														$next.="WHERE ID='{$id_before_last_id}' ";
   														$next_quex=mysqli_query($connection,$next);

   														$next3="UPDATE POSITIONS ";/*set last id to thankyou.php*/
   														$next3.="SET NEXT='thankyou' ";
   														$next3.="WHERE ID='{$last_id}' ";
   														$next_quex3=mysqli_query($connection,$next3);
                                                     }//else block for next update ends

									$position_select="";
									while($options=mysqli_fetch_assoc($resultx))
									{
										$opt=$options['NAME'];
										$position_select.="<option  value='{$opt}'>".str_replace('_',' ',$options['NAME'])."</option>";
									}
 
		          }
             }

    }


}

/*loging out of system*/
if(isset($_POST['logout'])){header("Location: logout.php");}

?>

<link rel="stylesheet" href="css/addcandidates.css"/>
<script type="text/javascript">

function helpDrawer(){var view = document.getElementById("help_div");view.setAttribute("style","right:0px;");}
function helpClose(){
	var drawer=document.getElementById("help_div");
	drawer.setAttribute("style","right:-1000px;");}
function candidateDraw(){var view = document.getElementById("help_div2");view.setAttribute("style","right:0px;");}
function candidateClose(){
	var drawer=document.getElementById("help_div2");
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
		<input type="text" onkeyup="restrict('position');" id="position" placeholder="&#128100; Enter Position Slot For Election And Click 'Add Position' " name="eposition"/><br/>
		<input type="text" onkeyup="restrict('cand_name');" id="cand_name" placeholder="&#128100; Name Of Candidate" name="cand_name"/><br/>
		<select name="position" id="position">
			<option value="default">&#128100; Position Contesting For</option>
			<?php echo $position_select; ?>
		</select><br/>
		<input type="file" name="file"/>
        <input type="submit" name="add_submit" value="Add Candidate &#128100;"/><br/>
        <input type="submit" name="remove_submit" value="Remove Candidate &#10006; "/><br/>
        <input type="submit" name="position_submit" value="Add Position"/><br/>
        <input type="submit" name="logout" value="Logout &#8594;"/>
	</form>


  <div id="nav">
	<h4 class="help help1" onclick="helpDrawer();">Click Here If You Need Help</h4>
  <h4 class="help help2" onclick="candidateDraw();">Click To View List Of Candidates</h4>
  <a href="logout.php"><h4>Logout</h4></a>
  </div>

	<div id="help_div">
    <ul>
    	<li>You first need to add the electoral positions available for contesting.</li>
    	<li>Enter the position name in the first form field and click the 'Add Position' button.</li>
    	<li>Once all the contestable positions have been added, proceed to adding the election candidates.</li>
    	<li>Enter the name of the candidate, select the position he/she is contesting for, browse and upload candidate's image and press the 'Add Candidate Button'.</li>
        <li>To remove a candidate, enter the name of the candidate and click 'Remove Candidate'.</li>
        <li>Click 'Logout' when process is complete and continue from the next page.</li>
        <li>Position slots can't be removed once they have been added. If removal is a must, contact developer.</li>
        <li style="color:red;cursor:pointer;"  onclick="helpClose();">Close This</li>

    </ul>
	</div>

	
    <div id="help_div2">
    <a  onclick="candidateClose();" style="color:red;cursor:pointer;margin-left:340px;text-decoration:none;padding:2px;border-radius:4px;background-color:rgba(255, 0, 0,0.5);color:white;display:block;width:40px;" >close</a>
    <div id="candidate_list">
    <?php echo $can_list; ?>
    </div>
    </div>

	<footer>Bit Distrikt Technologies &copy;<?php echo strtoupper(date("Y M d",time())); ?></footer>
   

</body>
</html>

<!--<nav class="index_nav">
                <a href="login.php" data-hover="Login &#8594;" id="lbutton"><span>Login &#8594;</span></a>
                <a href="signup.php" data-hover="Sign Up Now &#10155;" id="Sbutton"><span>Sign Up Now &#10155;</span></a>
               </nav>-->