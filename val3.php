<?php 
session_start();
ob_start();
require_once ('samples/functions.php');
require_once ('samples/header.php'); ?>
<?php $log_error="<h5 style='color:red;'>LEVEL 3 AUTHENTICATION</h5>";?>

<?php 
/*authentication code when user opts to enter admin portal*/
if(isset($_POST['admin_submit'])){
   if(level3($_POST['pass1'],$_POST['pass2'],$_POST['pass3'])){$_SESSION['ADMIN']="ADMIN";header("Location: admin.php");}
    else{$log_error=log_error("ACCESS TO ADMINISTRATOR SECTOR DENIED");}
}

/*authentication code when user opts to enter ID validation*/
if(isset($_POST['id_submit'])){
     if(level3($_POST['pass1'],$_POST['pass2'],$_POST['pass3'])){$_SESSION['STD_LOG']="STD_LOG";header("Location: instructions.php");}
    else{$log_error=log_error();}
}

/*authentication code when user opts to proceed to view elcetions*/
if(isset($_POST['vote_submit'])){
     if(level3($_POST['pass1'],$_POST['pass2'],$_POST['pass3'])){$_SESSION['STD_LOG']="STD_LOG";header("Location: id_checker.php");}
    else{$log_error=log_error("ACCESS TO VOTING PORTAL DENIED");}
}

/*authentication code when user opts to view results*/
if(isset($_POST['results_submit'])){
     if(level3($_POST['pass1'],$_POST['pass2'],$_POST['pass3'])){$_SESSION['RESULTS']="RESULTS";header("Location: restype_decide.php");}
     else{$log_error=log_error("ACCESS TO ELECTION RESULTS DENIED");}  
}


?>


<link rel="stylesheet" href="css/val3.css"/>
</head>
<body>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="index_form">
		<?php echo $log_error; ?>
		<input type="password" placeholder="&#128274; Enter Security Question" name="pass1"/><br/>
		<input type="password" placeholder="&#128274; Enter First Answer Here " name="pass2"/><br/>
        <input type="password" placeholder="&#128274; Enter Second Answer Here" name="pass3"/><br/>
        <input type="submit" name="admin_submit" value="Proceed To Administrator Setup &#8594;"/>
        <input type="submit" name="id_submit" value="Proceed To ID Validation Portal &#8594;"/><br/>
        <input type="submit" name="vote_submit" value="Proceed To Begin Elections &#8594;"/><br/>
        <input type="submit" name="results_submit" value="Proceed To View Election Results &#8594;"/>
	</form>

	<footer>Bit Distrikt Technologies &copy;<?php echo strtoupper(date("Y M d",time())); ?></footer>
   

</body>
</html>
