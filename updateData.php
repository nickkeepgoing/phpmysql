<?php
require("dbconnect.php");


// connect database


$id =  $_POST["id"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$gender = $_POST["gender"];

if (!empty($_POST["skills"])){
	$skills = implode(",",$_POST["skills"]);
}else{
	$skills = "none";
}


$sql = "UPDATE employee SET fname = '$fname',lname='$lname',gender = '$gender',skills = '$skills' WHERE  id = $id";

$result = mysqli_query($con,$sql);
if($result){
	header("location:index.php")	;
	exit(0);
}else{
	echo mysqli_errors($con);
}


?>