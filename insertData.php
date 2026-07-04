<?php
// connect database
require("dbconnect.php");
echo "first name = ".$_POST["fname"]."<br>";
echo "last name = ".$_POST["lname"]."<br>";
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$gender = $_POST["gender"];

if (!empty($_POST["skills"])){
	$skills = implode(",",$_POST["skills"]);
}else{
	$skills = "none";
}


$sql = "INSERT INTO employee(fname,lname,gender,skills) VALUES('$fname','$lname','$gender','$skills')";

$result = mysqli_query($con,$sql);
if($result){
	header("location:index.php")	;
	exit(0);
}else{
	echo mysqli_errors($con);
}
?>
