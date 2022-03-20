<?php ob_start();
require_once ('samples/functions.php');
require_once ('samples/header.php'); ?>
<?php  $log_error="<h5 id=\"header\">ENTER AND ADD STUDENT ID NUMBER TO POLLING SYSTEM.</h5>";?>

<link rel="stylesheet" href="css/stdlog.css"/>
<script type="text/javascript">
    
    var color=0;
    function colorChange()
    {
         var color_array=["#eee","#e7edee","#dbdada","white"];
          setInterval(function(){
          var bodymain=document.getElementById("bodymain");
           bodymain.setAttribute("style","background-color:"+color_array[color]+";"+'"');
      
          color++;
          if(color>3){color=0;}
          },3000);
   
    }

function helpDrawer()
{ var view = document.getElementById("help_div");
     view.setAttribute("style","right:0px;");
}

function helpClose()
{
	var drawer=document.getElementById("help_div");
	drawer.setAttribute("style","right:-1000px;");
}

function _(x){return document.getElementById(x);}
function restrict(elem){
var tf= _(elem);
var rx= new RegExp;
if(elem==="id"){rx=/[^0-9]/gi;}
tf.value=tf.value.replace(rx,"");
}


</script>
 <script type="text/javascript" src="js/jquery.js"></script>
 <script type="text/javascript" src="js/stdlog.js"></script>
</head>
<body id="bodymain" onload="colorChange();">
	

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="index_form">
		<?php echo $log_error; ?>
	  <input type="text" placeholder="&#128100; Enter ID Number Of Voter" name="id"  id="id"/><br/><!-- onkeyup="id_check();restrict('id');" -->
    <!-- <div id="std_details">
			<div id="std_image"><img src="images/stdlog_image.png"/></div>
			<div id="std_id_details">
       <b class="st_det">Name: </b><b><span>Gilbert Blankson-Afful</span></b><br/> -->
     <!--   <b class="st_det">Hall: </b><b><span>JNA Hall</span></b> -->
     <!--  </div>
		</div><br/> -->
    <button class="submit-btn" id="add_to_polls">Add To Polls</button>
    <div class="loader-div">
      <!-- <img src="images/green_check.png"/>
      <p style='font-weight:bold;'>Voter May Proceed!</p> -->
    </div>
	</form>

	<h4 class="help" onclick="helpDrawer();">Click Here If You Need Help</h4>
	<div id="help_div">
    <ul>
    	<li>Simply enter the ID number of the voter and click the 'Add To Polls' button.</li>
    	<li>The 'voted' status of candidate is automatically set to false.</li>
    	<li>This status changes dynamically immediately the voter finishes the voting process.</li>
      <li>Please crosscheck the photo of the voter to that on the id card.</li>
      <li style="color:red;cursor:pointer;"  onclick="helpClose();">Close This</li>

    </ul>
	</div>

	<footer>Bit Distrikt Technologies &copy;<?php echo strtoupper(date("Y M d",time())); ?></footer>
   

</body>
</html>
