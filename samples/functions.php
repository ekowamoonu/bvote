<?php require_once ('conn/db_connection.php');


/*function to validate pass codes from the appropriate tables*/
function code_validate($column,$table,$pass,$id="")
{
	  global $connection;

	if($id=="")
	   {
	     $query="SELECT {$column} FROM {$table} ";
         $results=mysqli_query($connection,$query);
         $reply=mysqli_fetch_assoc($results);
         $existing_code=$reply['CODE'];

         if(password_verify($pass,$existing_code)) {return true;}
         else{return false;}
       }

    if($id!="")
       {
         $query="SELECT {$column} FROM {$table} WHERE ID='{$id}' ";
         $results=mysqli_query($connection,$query);
         $reply=mysqli_fetch_assoc($results);
         $existing_code=$reply['CODE'];

         if(password_verify($pass,$existing_code)) {return true;}
         else{return false;}

       }

}

/*function to print out error messages*/
function log_error($statement="",$color=""){
     
     if($statement==""&&$color==""){return  "<h5 style='color:red;'>ILLEGAL LOGIN ATTEMPT</h5>";}
     else if($statement!=""&&$color==""){return "<h5 style='color:red;'>".$statement."</h5>"; }
     else if($statement!=""&&$color=="green"){return "<h5 style='color:green;'>".$statement."</h5>";}
}

/*function to check whether str lenghts of admin password is greater or equal to 10*/
function slen($check){
     if(strlen($check)>=10){return true;}
     else{return false;}
}

/*function to check if pass and confirm pass fields are the same*/
function check_pass($one,$two){
    if($one===$two){return true;}
    else{return false;}
}

function prep_code($code){
  global $connection;
   $final=mysqli_real_escape_string($connection,$code);
   $final_final=password_hash($final,PASSWORD_BCRYPT,['cost'=>9]);

   return $final_final;
}

function insert_query($table,$value){
      global $connection;
      $quex="INSERT INTO {$table}(CODE) VALUES('{$value}') ";
      $rex=mysqli_query($connection,$quex);

      if($rex){return true;}
      else{return false;}

}

function level3($question,$an1,$an2){
  global $connection;
  if(empty($question)||empty($an1)||empty($an2)||$an2==""||$an1=="")
      { return false;}   
     else
     {
        if(code_validate("CODE","SYSCODE",$question,"sq"))
        {
            if(code_validate("CODE","ANONE",$an1)&&code_validate("CODE","ANTWO",$an2))
            {return true;}
            else{return false;}

      }
        else{return false;}
     }

  
      
}

/*function to check whether candidate has already been added*/
function exists($value,$table,$column)
{
          global $connection;
          $query="SELECT * FROM {$table} WHERE {$column}='{$value}' ";
          $result=mysqli_query($connection,$query);
          $check=mysqli_num_rows($result);
          
          if($check==1){return true;}
          else{return false;}
    
}



?>