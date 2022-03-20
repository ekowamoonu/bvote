var validate;
$(document).ready(function(){

validate=function(fp){
	    
	                     /*fp- first voting page*/
	                     var id=$("#id").val();
                        ;
	                     if(id.length>=8){
                                           
                                             $.post("parsers/id_check_parser.php",{id:id},function(data){
                                                      	if(data==1){window.location="voting.php?electoral="+fp;/*+"&st="+id;*/} 
                                                      	else if(data==2){
    															 $("#id").attr("style","border:4px solid red;color:red");
	       	   	        										 $("#loader").html("<span style='color:red;'>....</span>");
	       	   	        										 $("#header").html("<span style='color:red;'>MULTIPLE VOTING NOT ALLOWED!</span>");
                                                            }
                                                        else{
    															 $("#id").attr("style","border:4px solid red;color:red");
	       	   	        										 $("#loader").html("<span style='color:red;'>....</span>");
	       	   	        										 $("#header").html("<span style='color:red;'>ILLEGAL LOGIN ATTEMPT!</span>");
                                                            }
                                             });       
                                         }

                          else if(id.length==0){
                                                  $("#loader").html("....")
                                                  $("#id").attr("style","border:4px solid #eee;color:black;");
                                                  $("#header").html("<span style='color:black;'>LOGIN WITH YOUR STUDENT ID</span>");
                                                }

                          else          {
                          	                $("#loader").html("<img src='images/283.GIF'/>")
                          	                $("#id").attr("style","border:4px solid #eee;color:black;");
                          	                $("#header").html("<span style='color:black;'>LOGIN WITH YOUR STUDENT ID</span>");
                          	            }
	
                      }//functions ends


});//document.ready function ends