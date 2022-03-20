<?php require_once ('../conn/db_connection.php'); ?>

<?php
  
  /*updating candidate's vote count*/

  if(isset($_POST['a'])&&isset($_POST['c']))
  {
       
       $id=$_POST['a'];
       $post_id=$_POST['c'];

  		if(!empty($id))
  	      {
  	           
             $query="UPDATE E_CANDIDATES ";
             $query.="SET CVOTES=CVOTES+1, YES=YES+1 ";
             $query.="WHERE CID='{$id}' ";
             $vote_set=mysqli_query($connection,$query);
 				
 			       $query2="UPDATE POSITIONS ";
             $query2.="SET TOTAL_VOTES_CAST=TOTAL_VOTES_CAST+1 ";
             $query2.="WHERE ID='{$post_id}' ";
             $vote_set2=mysqli_query($connection,$query2);

             //destroy_cookie
             //setcookie("number_of_tabs",0,time()-2,"/jna/");

             if($vote_set2){echo "You successfully voted for ";}
             else{echo "failed".mysqli_error($connection);}

  	      }
  }


  /***********************************/
  //an no vote
    if(isset($_POST['id_cand'])&&isset($_POST['id_pos']))
  {
       
       $id_cand=$_POST['id_cand'];
       $id_pos=$_POST['id_pos'];

      if(!empty($id_cand))
          {
               
             $query="UPDATE E_CANDIDATES ";
             $query.="SET NO=NO+1 ";
             $query.="WHERE CID='{$id_cand}' ";
             $vote_set=mysqli_query($connection,$query);
        
             $query2="UPDATE POSITIONS ";
             $query2.="SET TOTAL_VOTES_CAST=TOTAL_VOTES_CAST+1 ";
             $query2.="WHERE ID='{$id_pos}' ";
             $vote_set2=mysqli_query($connection,$query2);

             setcookie("number_of_tabs",null,time()-20,"/jna/");

             if($vote_set2){echo "You successfully voted for ";}
             else{echo "failed".mysqli_error($connection);}

          }
  }

  /*updating student's voted section*/

  if(isset($_POST['e'])&&isset($_POST['ffp']))
  {
       
       $id=$_POST['e'];
       $ffp=$_POST['ffp'];

      if(!empty($id))
          {
               
             $checkers="UPDATE STUDENTS SET VOTED=1 WHERE ID='{$id}' ";
             $checker_ress=mysqli_query($connection,$checkers);

             $check="UPDATE POSITIONS SET TOTAL_SKIPPED_VOTES=TOTAL_SKIPPED_VOTES+1,TOTAL_VOTES_CAST=TOTAL_VOTES_CAST+1 WHERE NAME='{$ffp}' ";
             $check_ress=mysqli_query($connection,$check);

             //echo "good";

          }
  }

    /*updating skipped votes section*/

  if(isset($_POST['fp']))
  {
       
       $fp=$_POST['fp'];

      if(!empty($fp))
          {
             setcookie("number_of_tabs",null,time()-20,"/jna/");

             $check="UPDATE POSITIONS SET TOTAL_SKIPPED_VOTES=TOTAL_SKIPPED_VOTES+1,TOTAL_VOTES_CAST=TOTAL_VOTES_CAST+1 WHERE NAME='{$fp}' ";
             $check_ress=mysqli_query($connection,$check);

             //echo "good";

          }
  }

?>