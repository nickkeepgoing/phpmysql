<?php 
//connect database
require("dbconnect.php");

//make sql comamnd to connect
$sql = "SELECT * FROM employee";
$result = mysqli_query($con, $sql);

$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_row($result)){
	echo "id : ".$row[0]."<br>";
	echo "firstname : ".$row[1]."<br>";
	echo "lastname : ".$row[2]."<br>";
	echo "gender : ".$row[3]."<br>";
	echo "skills : ".$row[4]."<br>";
	echo "<hr>";

}


if ($result){
	echo"request send sucess";
}else{
	echo mysqli_error($con);
}
?>
