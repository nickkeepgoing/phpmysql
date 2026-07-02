<?php
// connect database
require("dbconnect.php");
echo "first name = ".$_POST["fname"]."<br>";
echo "last name = ".$_POST["lname"]."<br>";
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$gender = $_POST["gender"];
$skills = implode(",",$_POST["skills"]);
$sql = "INSERT INTO employee(fname,lname,gender,skills) VALUES('$fname','$lname','$gender','$skills')";

$result = mysqli_query($con,$sql);
if($result){
	echo "Save data success"."<br>";
}else{
	echo mysqli_errors($con);
}
?>
