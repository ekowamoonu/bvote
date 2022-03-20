<?php ob_start();
require_once ('samples/functions.php');
require_once ('samples/header.php'); 

/*if(isset($_GET['st']))
{
  $login_details=$_GET['st'];

}*/

if(isset($_COOKIE['stid']))
{

 $login_details=$_COOKIE['stid'];

}

?>

<?php

$cand="";
$vote_links="";

/*code to handle dynamic change of positions and candidates*/
if(isset($_GET['electoral']))
{  
  //$first_position=str_replace('_',' ',$_GET['electoral']);
   $first_position=$_GET['electoral'];
  /*get next page from the first position */
  if($first_position=='thankyou')
  {
    header("Location: thankyou.php?st={$login_details}");
  }
  
  /*Get ID of first position to update total vote cast for that position in POSITIONS table*/
  $get_query="SELECT ID FROM POSITIONS WHERE NAME='{$first_position}' ";
  $get_quex=mysqli_query($connection,$get_query);
  $value=mysqli_fetch_assoc($get_quex);
  $final=$value['ID'];/*Get id of first position to be contested for*/

   /*Get next after position to STORE in the next variable to be passed to the js file*/
  $get_queryz="SELECT * FROM POSITIONS WHERE NAME='{$first_position}' ";
  $get_quexz=mysqli_query($connection,$get_queryz);
  $valuez=mysqli_fetch_assoc($get_quexz);
  $finaln=$valuez['NEXT'];/*Get next position to be contested for*/


  $cquery="SELECT * FROM E_CANDIDATES WHERE CPOSITION='{$first_position}' ";
  $report=mysqli_query($connection,$cquery);
  $num_of_candidates=mysqli_num_rows($report);
 
  /*FOR RUNOFF: IF no candidates exists for a particular position, skip to the next position*/
  if($num_of_candidates==0&&$first_position!='thankyou'){header("Location: voting.php?electoral={$finaln}&st={$login_details}");}
  else if($num_of_candidates==0&&$first_position=='thankyou')
  {
      $checkers="UPDATE STUDENTS SET VOTED=1 WHERE ID='{$login_details}' ";
      $checker_ress=mysqli_query($connection,$checkers);

  }


/*********************************************************************************/
  //check if candidate is the only one contesting
  $candidate_num=$num_of_candidates;
  $location="candidate_images/";

  if($candidate_num==1){
         
          $cans=mysqli_fetch_assoc($report);
          $cname=$cans['CNAME'];
          $id=$cans['CID'];
          $cposition=strtoupper($cans['CPOSITION']);

          
          $vote_links.="<p class='text-center'><a href='#' title='Click To Vote' onclick=\"yes_now('{$id}','{$cname}','{$final}','{$finaln}','{$login_details}');vote_update('{$login_details}','{$finaln}');\" class='hover_link btn btn-success'> Yes <i class='fa fa-thumbs-up fa-2x'></i></a></p>";
          $vote_links.="<p class='text-center'><a href='#' title='Click To Vote' onclick=\"no_now('{$id}','{$cname}','{$final}','{$finaln}','{$login_details}');vote_update('{$login_details}','{$finaln}');\" class='hover_link btn btn-danger'> No <i class='fa fa-thumbs-down fa-2x'></i></a></p>";


                                       /*reading candidate images*/
                                          $handle=opendir($location);
                                          $i=0;
                                          if($handle)
                                          {
                                             while($file=readdir($handle))
                                              {
                                                $explode_file=explode(".",$file);
                                                $ext=end($explode_file);
                                                $name=reset($explode_file);

                                               /*$ext=end(explode(".",$file)); *///deprecated in php 7*/
                                              /* $name=reset(explode(".",$file));*/

                                                if($file!='.'&&$file!='..'&&$name==$id)
                                                    {
                                                        $can_image=$name.".".$ext;
                                                   }
                                                
                                              }


                                           }
                      
                            $cand.="<div class='row'>
                                  <div class='col-md-3'>
                                    <div class='profile-image'>
                                      <img src='candidate_images/{$can_image}' class='img img-responsive'/>
                                    </div>
                                  </div>
                                  <div class='col-md-6 candidate-details'>
                                    <h4>".$cname."</h4>
                                    <h5>FOR ".str_replace('_',' ',$cposition)."</h5>
                                  </div>
                                  <div class='col-md-3 thumb-vote'>
                                    ".$vote_links."
                                  </div>
                              </div>";
         
     }//end if only one candidate
  else{


                  $location="candidate_images/";
                  
                  while($candidate=mysqli_fetch_assoc($report))
                  {
                      static $r=1;
                      $cname=$candidate['CNAME'];
                      $cposition=strtoupper($candidate['CPOSITION']);
                      $id=$candidate['CID'];

                                          /*reading candidate images*/
                                          $handle=opendir($location);
                                          $i=0;
                                          if($handle)
                                          {
                                             while($file=readdir($handle))
                                              {
                                                $explode_file=explode(".",$file);
                                                $ext=end($explode_file);
                                                $name=reset($explode_file);
                                               /*$ext=end(explode(".",$file)); *///deprecated in php 7
                                               /* $name=reset(explode(".",$file));*/

                                                if($file!='.'&&$file!='..'&&$name==$id)
                                                    {
                                                        $can_image=$name.".".$ext;
                                          
                                                    }
                                                
                                              }


                                           }

                       $cand.="<div class='row'>
                                  <div class='col-md-3'>
                                    <div class='profile-image'>
                                      <img src='candidate_images/{$can_image}' class='img img-responsive'/>
                                    </div>
                                  </div>
                                  <div class='col-md-7 candidate-details'>
                                    <h4><span class='badge' style='background-color:red;'>".$r."</span> ".$cname."</h4>
                                    <h5>FOR ".str_replace('_',' ',$cposition)."</h5>
                                  </div>
                                  <div class='col-md-2 thumb-vote'>
                                    <a href='#' onclick=\"vote_now('{$id}','{$cname}','{$final}','{$finaln}','{$login_details}');vote_update('{$login_details}','{$finaln}');\" title='Click To Vote' class='hover_link'><img class='check_image' src='images/check_image.png'/></a>
                                  </div>
                              </div>";

                      $r++;
                                                                                            

                  }//end while


      }//end else

  
 
/***************************************************************************************/



}//end main if

/*Thus if new positions have not been added yet, system will simply redirect you to the level 3 validation*/
else{
  header("Location: val3.php");
}


if(isset($_POST['cancel_vote'])){
    
    $checkers="UPDATE STUDENTS SET VOTED=1 WHERE ID='{$login_details}' ";
    $checker_res=mysqli_query($connection,$checkers);
    
    if($checker_res){
      header("Location: id_checker.php");
    }

}

?>
<link rel="stylesheet" href="assets/css/font-awesome.min.css"/>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/jquery-confirm.min.css"/>
<link rel="stylesheet" href="css/voting.css"/>
<script type="text/javascript">
    
    var color=0;
    function colorChange()
    {
         var color_array=["#20b45e","#43a518","#3db546","#23d475","#a5eb1f","#4fdec3","#5e761d","#8daa39","#7b5c09","#791525","#076034","#550808","#804c06"];
          setInterval(function(){
          var bodymain=document.getElementById("bodymain");
           bodymain.setAttribute("style","background-color:"+color_array[color]+";"+'"');
      
          color++;
          if(color>10){color=0;}
          },2900);
   
    }

</script>

</head>
<body id="bodymain" onload="colorChange();">

  <div class="overlay-div" style="display:none;">
    <img src="images/vote_loader.gif"/>
  </div>

  <div class="container voting-container">
    <div class="row"><div class="col-md-12"><p class="text-center"><a class="skipimg btn btn-primary" onclick="<?php echo "vote_update('{$login_details}','{$finaln}','{$first_position}');" ?>" href="voting.php?electoral=<?php echo $finaln; ?>&st=<?php echo $login_details; ?>">Skip To Next Position <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a></p></div> </div>
    <?php echo $cand; ?>
 <!--    <div class="row">
        <div class="col-md-3">
          <div class="profile-image">
            <img src="images/voting_image.png" class="img img-responsive"/>
          </div>
        </div>
        <div class="col-md-7 candidate-details">
          <h4>BLANKSON-AFFUL GILBERT M</h4>
          <h5>FOR PRESIDENT</h5>
        </div>
        <div class="col-md-2 thumb-vote">
          <a href="#" class="hover_link"><img class="check_image" src="images/check_image.png"/></a>
        </div>
    </div> -->

    
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
         <p class="text-center" style="font-size:19px;color:white;padding:0;margin:0;">Bit Distrikt Technologies &copy;<?php echo strtoupper(date("Y M d",time())); ?></p>
      </div>
    </div>
  </div>


<div class="alert-div" style="display:none;">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="submit" name="cancel_vote" class="btn btn-default" value="Cancel Vote Procedure For User"/>
  </form>
</div>



 
 <script type="text/javascript" src="js/jquery.js"></script>
 <script type="text/javascript" src="js/jquery-confirm.min.js"></script>
 <script type="text/javascript">
  $(function(){
   //script to change click to vote image when mouse is hovered on it
   $(".check_image").mouseover(function(){
    $(this).attr("src","images/check_vote_image.png");}).mouseout(function(){$(this).attr("src","images/check_image.png");
  });});
 </script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>  
<script type="text/javascript" src="js/vote_counter.js"></script>
<script type="text/javascript">
$(function(){
   var snd = new Audio("industrialalarm.mp3");
   $(window).blur(function(){
    
     snd.addEventListener('ended',function(){
        this.currentTime=0;
        this.play();
       },false);
       snd.play();
    
      for(i=1;i<7;i++){
       window.open("illegal.html","","width=1600,height:1000");
      }
       
       $(".alert-div").attr("style","display:block;");
     
   });

});

</script>
</body>
</html>
