<?php ob_start();
   require_once ('conn/db_connection.php');
class intialiseTables
{
   function __construct(){
    global $connection;

    //FIRSTEXEC Table
 $query9="CREATE TABLE IF NOT EXISTS FIRSTEXEC( ";
 $query9.="CODE VARCHAR(200) ";
 $query9.=" )";
 
 $result9=mysqli_query($connection,$query9);
 
 //SECONDEXEC Table
 $query8="CREATE TABLE IF NOT EXISTS SECONDEXEC( ";
 $query8.="CODE VARCHAR(200) ";
 $query8.=" )";
 
 $result8=mysqli_query($connection,$query8);

 //THIRDEXEC Table
 $query1="CREATE TABLE IF NOT EXISTS THIRDEXEC( ";
 $query1.="CODE VARCHAR(200) ";
 $query1.=" )";
 
 $result1=mysqli_query($connection,$query1);

  //SYSTEMCODE TABLE
 $query2="CREATE TABLE IF NOT EXISTS SYSCODE( ";
 $query2.="CODE VARCHAR(200), ";
 $query2.="ID VARCHAR(3), ";
 $query2.="PRIMARY KEY(ID) ";
 $query2.=")";
 
 $result2=mysqli_query($connection,$query2);

 //ACTIVATION TABLE
 $queryv="CREATE TABLE IF NOT EXISTS ACTIVATED( ";
 $queryv.="ACTIVATION BOOLEAN,";
 $queryv.="ID INT,";
 $queryv.="PRIMARY KEY(ID)";
 $queryv.=")";
 
 $resultv=mysqli_query($connection,$queryv);

 //POSITIONS TABLE
 $queryv2="CREATE TABLE IF NOT EXISTS POSITIONS( ";
 $queryv2.="NAME VARCHAR(50),";
 $queryv2.="TOTAL_VOTES_CAST INT DEFAULT 0,";
 $queryv2.="ID INT AUTO_INCREMENT,";
 $queryv2.="NEXT VARCHAR(20) NULL,";
 $queryv2.="TOTAL_SKIPPED_VOTES INT DEFAULT 0,";
 $queryv2.="PRIMARY KEY(ID)";
 $queryv2.=")";
 
 $resultv2=mysqli_query($connection,$queryv2);

 //POSITIONS TABLE
 $queryv3="CREATE TABLE IF NOT EXISTS E_CANDIDATES( ";
 $queryv3.="CNAME VARCHAR(50),";
 $queryv3.="CPOSITION VARCHAR(50), ";
 //$queryv3.="CIMAGE VARCHAR(2),";
 $queryv3.="CVOTES INT DEFAULT 0,";
 $queryv3.="YES INT DEFAULT 0,";
 $queryv3.="NO INT DEFAULT 0,";
 $queryv3.="CID INT AUTO_INCREMENT, ";
 $queryv3.="PRIMARY KEY(CID) ";
 $queryv3.=")";
 
 $resultv3=mysqli_query($connection,$queryv3);

 $queryv1="INSERT INTO ACTIVATED(ACTIVATION,ID) VALUES('0',2) ";
 $resultv1=mysqli_query($connection,$queryv1);

 //STUDENT DATABASE TABLE
 $queryve="CREATE TABLE IF NOT EXISTS STUDENTS( ";
 $queryve.="ID VARCHAR(11),";
 $queryve.="VOTED BOOLEAN DEFAULT 0,";
 $queryve.="PRIMARY KEY(ID)";
 $queryve.=")";
 
 $resultve=mysqli_query($connection,$queryve);

/* $queryvp="INSERT INTO STUDENTS(ID) VALUES('10467525'),('10467625'),('10467725'),('10467825'),('10467925') ";
 $resultvp=mysqli_query($connection,$queryvp);*/

 //ANSWER ONE TABLE
  $queryx="CREATE TABLE IF NOT EXISTS ANONE( ";
  $queryx.="CODE VARCHAR(200) ";
  $queryx.=")";
 
 $resultx=mysqli_query($connection,$queryx);
 //ANSWER TWO TABLE
  $querym="CREATE TABLE IF NOT EXISTS ANTWO( ";
  $querym.="CODE VARCHAR(200) ";
  $querym.=")";
 
 $resulty=mysqli_query($connection,$querym);
 
 /*hashing system passcodes*/
 $ms="xetyvpom34";
 $ms1="36zwqdmot";
 $ms2="qlowizyghi72";
 $sq="whatisthedifferenceofmand12";
 $anone="evana278";
 $antwo="pyt34wmy";

 $ms_final=password_hash($ms,PASSWORD_BCRYPT,['cost'=>8]);
 $ms1_final=password_hash($ms1,PASSWORD_BCRYPT,['cost'=>8]);
 $ms2_final=password_hash($ms2,PASSWORD_BCRYPT,['cost'=>8]);
 $sq_final=password_hash($sq,PASSWORD_BCRYPT,['cost'=>8]);
 $anone_final=password_hash($anone,PASSWORD_BCRYPT,['cost'=>8]);
 $antwo_final=password_hash($antwo,PASSWORD_BCRYPT,['cost'=>8]);
 
 
 //CODE INSERTIONS 
  $query3="INSERT INTO SYSCODE(CODE,ID) VALUES ";
  $query3.="('{$ms_final}','ms'),";
  $query3.="('{$ms1_final}','ms1'),";
  $query3.="('{$ms2_final}','ms2'),";
  $query3.="('{$sq_final}','sq') ";
 
 $result3=mysqli_query($connection,$query3);

//ANONE INSERTIONS
$query6="INSERT INTO ANONE(CODE) VALUES ";
$query6.="('{$anone_final}')";

$result6=mysqli_query($connection,$query6);

 //ANTWO INSERTIONS
$queryo="INSERT INTO ANTWO(CODE) VALUES ";
$queryo.="('{$antwo_final}')";

$resulto=mysqli_query($connection,$queryo);

   }

}

$new_system=new intialiseTables();

header("Location: initializing.php");

?>

