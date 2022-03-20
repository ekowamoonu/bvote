<?php require_once ('../conn/db_connection.php'); ?>

<?php

if(isset($_POST['id']))
{

	$id=$_POST['id'];

	if(!empty($id))
	{
        $check_id="SELECT * FROM STUDENTS WHERE ID=".$id;
        $check=mysqli_query($connection,$check_id);
        $available=mysqli_num_rows($check);
        
        //check if candidate has already been inserted
        if($available>=1){echo 1;}
        else{
        	 $insert_query="INSERT INTO STUDENTS(ID) VALUES('{$id}')";
        	 $query_results=mysqli_query($connection,$insert_query);

        	 if($query_results){echo 2;}
        }
		
	


  }

}//END MAIN IF STATEMENT

/*	$row_valid=mysqli_num_rows($checker_res);
		$vote_al=mysqli_fetch_assoc($checker_res);
		$vote_already=$vote_al['VOTED'];



		if($row_valid==1){
			                   if($vote_already==1){echo 2;}
                                else{
		                            	echo 1;
					                }*///vote already statement ends
	/*					 }
		else 			 {
								echo 0;
						 }*/

	//}//end second if statement


?>