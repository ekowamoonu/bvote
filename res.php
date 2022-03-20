<?php 
require_once ('samples/functions.php');
require_once ('samples/header.php'); ?>

<?php
$display="";
$vote_counting="SELECT * FROM POSITIONS ORDER BY TOTAL_VOTES_CAST DESC";
$vote_count=mysqli_query($connection,$vote_counting);

$vote_c="SELECT * FROM STUDENTS WHERE VOTED=1 ";
$vote_co=mysqli_query($connection,$vote_c);
$so_far=0;

while($count_res=mysqli_fetch_assoc($vote_count))
{
	$e_pos=str_replace('_',' ',$count_res['NAME']);
	$e_count=$count_res['TOTAL_VOTES_CAST'];
	$display.='<div class="col-md-3 md3"><div class="display"><h3>'.$e_pos.'</h3><h1>'.$e_count.' Votes</h1></div></div>';
}

while($count_r=mysqli_fetch_assoc($vote_co))
{
	$so_far++;
}

?>
<link rel="stylesheet" href="assets/css/font-awesome.min.css"/>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/animate.css"/>
<link rel="stylesheet" href="css/res.css"/>
</head>
<script type="text/javascript">
function constantRefresh(){setInterval("location.reload()",1000);}
</script>

<body id="bodymain" onload="constantRefresh();">

	<div class="container heading">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center"><i class="fa fa-user"></i> Live vote count <span class="badge wow animated bounceIn"><?php echo $so_far; ?></span></h2>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<?php echo $display; ?>
		</div>
	</div>


   <div class="timer">
   	<h1 class="text-center"><span style='color:white;'><i class="fa fa-history"></i>  <?php echo strtoupper(strftime("%H:%M:%S",time())); ?> </span></h1>
   </div>



<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/wow.min.js"></script>
<script>
        new WOW().init();
</script>

</body>
</html>
