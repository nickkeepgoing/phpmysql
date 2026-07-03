<?php
require("dbconnect.php");

$sql = "SELECT * FROM employee";
$result = mysqli_query($con,$sql);

$row = mysqli_fetch_row($result);

echo "id : ".$row[0]."<br>";
echo "firstname : ".$row[1]."<br>";
echo "lastname : ".$row[2]."<br>";
echo "gender : ".$row[3]."<br>";
echo "skills : ".$row[4]."<br>";
echo "<hr>";

echo "id : ".$row[0]."<br>";
echo "firstname : ".$row[1]."<br>";
echo "lastname : ".$row[2]."<br>";
echo "gender : ".$row[3]."<br>";
echo "skills : ".$row[4]."<br>";
echo "<hr>";

echo "id : ".$row[0]."<br>";
echo "firstname : ".$row[1]."<br>";
echo "lastname : ".$row[2]."<br>";
echo "gender : ".$row[3]."<br>";
echo "skills : ".$row[4]."<br>";
echo "<hr>";


echo "id : ".$row[0]."<br>";
echo "firstname : ".$row[1]."<br>";
echo "lastname : ".$row[2]."<br>";
echo "gender : ".$row[3]."<br>";
echo "skills : ".$row[4]."<br>";
echo "<hr>";
?>
