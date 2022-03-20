<?php ob_start();
require_once ('samples/functions.php');
require_once ('samples/header.php'); ?>

<link rel="stylesheet" href="css/res_final.css"/>

<?php
      $position_links="";

      //pick statistics from first position
      if(isset($_GET['results'])){
        $position=$_GET['results'];
      }


      $no_percent="";
      $yes_percent="";
      $see_percent="";

 ?>


 <?php

 /********************************************************************************************************/
       //get all other position links
       $position_query="SELECT * FROM POSITIONS";
       $pos_results=mysqli_query($connection,$position_query);

       while($links=mysqli_fetch_assoc($pos_results)){

        $pos_name=$links['NAME'];
        $position_links.='<a href="res_final.php?results='.$pos_name.'" class="position-btn">'.$pos_name.'</a>';
       }

/********************************************************************************************************/
  ?>

   <?php

 /********************************************************************************************************/
       //get all statistics of selected positions
       $p_query="SELECT * FROM POSITIONS WHERE NAME='".$position."'";
       $p_results=mysqli_query($connection,$p_query);
       $stats=mysqli_fetch_assoc($p_results);
       $total_votes_cast=$stats['TOTAL_VOTES_CAST'];
       $total_skipped_votes=$stats['TOTAL_SKIPPED_VOTES'];

       //calculate total valid votes
       $total_valid_votes=(int)$total_votes_cast-(int)$total_skipped_votes;
       

/********************************************************************************************************/
  ?>



<?php 

  $cquery="SELECT * FROM E_CANDIDATES WHERE CPOSITION='".$position."' ORDER BY CVOTES DESC";
  $report=mysqli_query($connection,$cquery); 
  $number_of_candidates=mysqli_num_rows($report);

  //file handling
  $location="candidate_images/";
  $cand="";

  /*code snippet to write results to a secrete text file*/
  $raw_details[]="";
  $time_now=date('D M d H:m:s',time());

  /*********************************************/

       //calculate no/yes percentage if only one candidate
       if($number_of_candidates==1){
                $single_man=mysqli_fetch_assoc($report);
                $no=$single_man['NO'];
                $yes=$single_man['YES'];
                $cvotes=$single_man['CVOTES'];
                $cname=$single_man['CNAME'];
                $cposition=strtoupper($single_man['CPOSITION']);
                $id=$single_man['CID'];
                $see_percent='<button class="show-btn">Show No/Yes Percentages</button>';

                      if($total_valid_votes!=0){
                                      
                                        $no_perc=((int)$no/$total_valid_votes)*100;
                                        $yes_perc=((int)$yes/$total_valid_votes)*100;
                                        $no_percent=round($no_perc,2);
                                        $yes_percent=round($yes_perc,2);
                                        $percentage=($cvotes/$total_valid_votes)*100;
                                        $cpercentage=round($percentage,2);
                                 }
                    else{ $no_percent=0;$yes_percent=0;$cpercentage=0;}

                /*reading candidate images*/
                          $handle=opendir($location);
                          $i=0;
                          if($handle)
                          {
                             while($file=readdir($handle))
                              {
                                $exploded=explode(".",$file);
                                $ext=end($exploded);
                                $name=reset($exploded);
                              /* $ext=end(explode(".",$file));
                                $name=reset(explode(".",$file));*/

                                if($file!='.'&&$file!='..'&&$name==$id)
                                    {
                                        $can_image=$name.".".$ext;
                          
                                    }
                                
                              }


                           }


      
      $cand.="<div id='candidate_container'>";
      $cand.=" <div id='image_div'><img width='200' height='200' src=\"candidate_images/{$can_image}\"/></div>";
      $cand.="<div id='voting_div'>";
      $cand.="<div id='candidate_details_div'><div id='inside_cand_div'>";
      $cand.="<h1>".$cname."</h1>";
      /*$cand.="<h2>FOR ".str_replace('_',' ',$cposition)."</h2>";*/
      $cand.="<h2 style='color:green;'>".$cvotes." VOTES</h2>";
     /* $cand.="<h2 style='color:blue;'>".$cpercentage."%</h2>";*/
      $cand.="</div> </div>";
     /* $cand.="<div id='click_to_vote_div'><img class='check_image' src='images/res_final.png'/></div>";*/
      $cand.="</div></div>";
                    
     
      $raw_details[]="TIME: ".$time_now." ".$cname." ".$cposition." ".$cvotes;
                              
          }//end main if

       else{
               $see_percent="";

                        while($candidate=mysqli_fetch_assoc($report))
                        {


                            $cname=$candidate['CNAME'];
                            $cvotes=$candidate['CVOTES'];
                            $cposition=strtoupper($candidate['CPOSITION']);
                            $id=$candidate['CID'];

                            if($total_valid_votes!=0&&$cvotes!=0){
                                            $percentage=($cvotes/$total_valid_votes)*100;
                                            $cpercentage=round($percentage,2);
                                       }
                            else{$cpercentage=0;}

                                                /*reading candidate images*/
                                                $handle=opendir($location);
                                                $i=0;
                                                if($handle)
                                                {
                                                   while($file=readdir($handle))
                                                    {
                                                      $exploded=explode(".",$file);
                                                      $ext=end($exploded);
                                                      $name=reset($exploded);
                                                    /* $ext=end(explode(".",$file));
                                                      $name=reset(explode(".",$file));*/

                                                      if($file!='.'&&$file!='..'&&$name==$id)
                                                          {
                                                              $can_image=$name.".".$ext;
                                                
                                                          }
                                                      
                                                    }


                                                 }


                            
                            $cand.="<div id='candidate_container'>";
                            $cand.=" <div id='image_div'><img width='200' height='200' src=\"candidate_images/{$can_image}\"/></div>";
                            $cand.="<div id='voting_div'>";
                            $cand.="<div id='candidate_details_div'><div id='inside_cand_div'>";
                            $cand.="<h1>".$cname."</h1>";
                            /*$cand.="<h2>FOR ".str_replace('_',' ',$cposition)."</h2>";*/
                            $cand.="<h2 style='color:green;'>".$cvotes." VOTES</h2>";
                            $cand.="<h2 style='color:blue;'>".$cpercentage."%</h2>";
                            $cand.="</div> </div>";
                           /* $cand.="<div id='click_to_vote_div'><img class='check_image' src='images/res_final.png'/></div>";*/
                            $cand.="</div></div>";
                                          
                           
                            $raw_details[]="TIME: ".$time_now." ".$cname." ".$cposition." ".$cvotes;
                                                                                            

                        }


 }//end mainelse

   /*write results to a secrete file on the server(this is for backup in case of any rigging attempt)*/  
    $backup_location="checker/backup_file.txt"; 
    $handle=fopen($backup_location,"a"); 

    foreach($raw_details as $value){
    fwrite($handle,$value."\r\n");  
  }


?>
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

  <a  class="logout" href="logout.php">Logout</a>
  <a  class="logout2">The final results</a>

   <div id="overall_container">
   <div class="position-title">
    <h2 style="font-weight:bold;font-size:30px;color:red;"><?php echo strtoupper($position); ?></h2>
    <h2>Total Votes Cast: <?php echo $total_votes_cast; ?> </h2>
    <h2>Skipped Votes:  <?php echo $total_skipped_votes; ?></h2>
    <h2>Total Valid Votes: <?php echo $total_valid_votes; ?></h2>
    <?php echo $see_percent; ?>
   <!--  <button class="show-btn">Show No/Yes Percentages</button>-->
    <h2 style='color:grey;' class="yesno">No Votes Perecentage: <?php echo $no_percent; ?>%</h2>
    <h2 style='color:grey;' class="yesno">Yes Votes Percentage: <?php echo $yes_percent; ?>%</h2> 
   </div>

   <?php echo $cand; ?>
    	 <!-- <div id="candidate_container">
    	         <div id="image_div"><img src="images/voting_image.png"/></div>
                  <div id="voting_div">
                     <div id="candidate_details_div">
                        <div id="inside_cand_div">
                          <h1>BLANKSON-AFFUL GILBERT M</h1>
                          <h2>FOR PRESIDENT</h2>
                       </div>
                     </div>
                 <div id="click_to_vote_div"><a href="#" class="hover_link"><img class="check_image" src="images/check_image.png"/></a></div>
               </div>
    	      </div> -->

    </div>
    <div class="other-positions">
      <?php echo $position_links; ?>
     <!--  <a href="#"  class="position-btn">Vice</a> -->
    <!--   <a href="#"  class="position-btn">Secretary Wine</a>
      <a href="#"  class="position-btn">Secretary Maggot</a>
      <a href="#"  class="position-btn">Secretary Maggot</a>
      <a href="#"  class="position-btn">Secretary Maggot</a>
      <a href="#"  class="position-btn">Secretary Maggot</a>
      <a href="#"  class="position-btn">Secretary Maggot</a>
      <a href="#"  class="position-btn">Esug presi</a> -->
    </div>
  <footer>Bit Distrikt Technologies &copy;<?php echo strtoupper(date("Y M d",time())); ?></footer>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript">
  $(function(){

                $(".yesno").hide();
                
                $(".show-btn").click(function(){
                  
                  $(this).hide();
                  $(".yesno").show();
                
                });

  });
  </script>
   

</body>
</html>
