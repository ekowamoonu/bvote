<?php
session_start();

$_SESSION['ADMIN']=null;
$_SESSION['STD_LOG']=null;
$_SESSION['RESULTS']=null;

header("Location: index_main.php");

?>