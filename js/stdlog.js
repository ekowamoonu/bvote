/*var id_check;*/
$(document).ready(function(){

  /*insert into database id of student*/
  $("#add_to_polls").click(function(e){

      e.preventDefault();
    //get the id number entered
     var id=$("#id").val();

     if(id==0||id.length!=8){alert("Invalid ID provided!");}
     else{
              
              $(".loader-div").html("<img src='images/483.gif'/>");

              $.post("parsers/stdlog_parser.php",{id:id},function(data){
                    
                    if(data==1){ $(".loader-div").html("<img src='images/red_check.png'/><p style='font-weight:bold;'>Voter Already Added!</p>");}
                    else{
                        $(".loader-div").html("<img src='images/green_check.png'/><p style='font-weight:bold;'>Voter May Proceed!</p>");
                    }
                  
              });


     }
     

  });



 




});//document.ready function ends




/*id_check=function(){*/
      
                       /*fp- first voting page*/
                    /*   var id=$("#id").val();

                       if(id.length>=8){
                                            $("#std_image").html("<img src='images/283.GIF'/>");
                                             $.post("parsers/stdlog_parser.php",{id:id},function(data){
                                                        if(data==1){ $("#header").html("<span style='color:green;'>ID IS VALID &#x2713;</span>");
                                                                      $("#id").attr("style","border:4px solid green;color:green;");
                                                                      $("#std_image").html(""); } 
                                                        else if(data==2){
                                                       $("#id").attr("style","border:4px solid red;color:red;");
                                                               $("#std_image").html("<span style='color:red;'>....</span>");
                                                               $("#header").html("<span style='color:red;'>&#10006;&#10006; CANDIDATE HAS ALREADY VOTED </span>");
                                                            }
                                                        else{
                                   $("#id").attr("style","border:4px solid red;color:red");
                                           $("#std_image").html("<span style='color:red;'>....</span>");
                                           $("#header").html("<span style='color:red;'> &#10006; INVALID STUDENT ID</span>");
                                                            }
                                             });       
                                         }

                          else          {
                                            $("#std_image").html("<span style='color:white;'>typing....</span>");
                                            $("#id").attr("style","border:4px solid #eee;color:black;");
                                            $("#header").html("<span style='color:black;'>TYPE STUDENT ID NUMBER TO CHECK VALIDITY</span>");
                                        }
  
                      }*///functions ends