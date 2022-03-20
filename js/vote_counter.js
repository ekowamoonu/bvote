var vote_now;
var vote_update;
var yes_now;
var no_now;
$(document).ready(function(){

vote_now=function(a,b,c,d,e){
	    
	    /*a- id of candidate*/
	    /*b- name of candidate*/
	    /*c- id of position..used to update the total vote cast for a particular position*/
	    /*d- next page*/
	    /*e -student id*/

	    $.confirm({

	    	title: 'Confirm Vote!',
	    	content: 'Vote For '+b+'?',
	    	buttons: {
	    		confirm: function(){
	    			 $(".overlay-div").attr("style","display:block;"); 
	    	                   
	    	                    
					           /*send id of candidate to vote_parser for update to take place*/
						       $.post("parsers/vote_parser.php",{a:a,c:c},function(data){
					                  
					                          window.location="voting.php?electoral="+d+"&st="+e;
					                           
					                           $(".overlay-div").attr("style","display:none;"); 
					             });


	    		},cancel: function(){
	    			$.alert("Vote Cancelled!");
	    		}
	    	}
	    });//end confirm

   

        	    

}//functions ends

/*************************************************************************************************************************/
yes_now=function(a,b,c,d,e){
	    
	    /*a- id of candidate*/
	    /*b- name of candidate*/
	    /*c- id of position..used to update the total vote cast for a particular position*/
	    /*d- next page*/
	    /*e -student id*/

    
	   
	    $.confirm({

	    	title: 'Confirm Vote!',
	    	content: 'Yes to '+b+'?',
	    	buttons: {
	    		confirm: function(){
	    			 $(".overlay-div").attr("style","display:block;"); 
	    	                   
	    	                    
					           /*send id of candidate to vote_parser for update to take place*/
						       $.post("parsers/vote_parser.php",{a:a,c:c},function(data){
					                  
					                          window.location="voting.php?electoral="+d+"&st="+e;
					                           
					                           $(".overlay-div").attr("style","display:none;"); 
					             });


	    		},cancel: function(){
	    			$.alert("Vote Cancelled!");
	    		}
	    	}
	    });//end confirm

        	    

}//functions ends

/*************************************************************************************************************************/

/*************************************************************************************************************************/
no_now=function(a,b,c,d,e){
	    
	    /*a- id of candidate*/
	    /*b- name of candidate*/
	    /*c- id of position..used to update the total vote cast for a particular position*/
	    /*d- next page*/
	    /*e -student id*/

    
	 	    $.confirm({

	    	title: 'Confirm Vote!',
	    	content: 'No to '+b+'?',
	    	buttons: {
	    		confirm: function(){
	    			 $(".overlay-div").attr("style","display:block;"); 
	    	                   
	    	                    
					           /*send id of candidate to vote_parser for update to take place*/
						      $.post("parsers/vote_parser.php",{id_cand:a,id_pos:c},function(data){
					                  

					                           window.location="voting.php?electoral="+d+"&st="+e;
					                           $(".overlay-div").attr("style","display:none;"); 
					             });


	    		},cancel: function(){
	    			$.alert("Vote Cancelled!");
	    		}
	    	}
	    });//end confirm
	    
        	    

}//functions ends

/*************************************************************************************************************************/
vote_update=function(e,np,fp){
	  /*e- studentid*/

	  if(np=="thankyou"){
                              $.post("parsers/vote_parser.php",{e:e,ffp:fp},function(data){
                                        
                                      });

	                    }

	   else{

	   	     $.post("parsers/vote_parser.php",{fp:fp},function(data){
               });

	   }
     

}/*vote_update function ends here*/





});//document.ready function ends
