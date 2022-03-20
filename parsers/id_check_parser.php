<?php require_once ('../conn/db_connection.php'); ?>

<?php

if(isset($_POST['id']))
{

	$id=$_POST['id'];

	if(!empty($id))
	{
		$checker="SELECT * FROM STUDENTS WHERE ID='{$id}' ";
		$checker_res=mysqli_query($connection,$checker);
		$row_valid=mysqli_num_rows($checker_res);
		$vote_al=mysqli_fetch_assoc($checker_res);
		$vote_already=$vote_al['VOTED'];



		if($row_valid==1){
			                   if($vote_already==1){
			                   	echo 2;
			                   }
                                else{
                                	   setcookie("stid",$id,time()+2000,"/jna/");
		                               echo 1;
					                 }//vote already statement ends
						 }
		else {
			   echo 0;
			 }

	}//end second if statement


}//END MAIN IF STATEMENT


?>