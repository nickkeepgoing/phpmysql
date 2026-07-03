<?php
require("dbconnect.php");

$sql = "SELECT * FROM employee";
$result = mysqli_query($con,$sql);

$row = mysqli_fetch_assoc($result);

echo "id : ".$row["id"]."<br>";
echo "firstname : ".$row["fname"]."<br>";
echo "lastname : ".$row["lname"]."<br>";
echo "gender : ".$row["gender"]."<br>";
echo "skills : ".$row["skills"]."<br>";
echo "<hr>";
?>
