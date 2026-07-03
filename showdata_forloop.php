<?php 
//connect database
require("dbconnect.php");

//make sql comamnd to connect
$sql = "SELECT * FROM employee";
$result = mysqli_query($con, $sql);

$count = mysqli_num_rows($result);

for ($i=0;$i<$count;$i++){
	$row = mysqli_fetch_object($result);
	echo "id : ".$row->id."<br>";
	echo "firstname : ".$row->fname."<br>";
	echo "lastname : ".$row->lname."<br>";
	echo "gender : ".$row->gender."<br>";
	echo "skills : ".$row->skills."<br>";
	echo "<hr>";

}


if ($result){
	echo"request send sucess";
}else{
	echo mysqli_error($con);
}
?>
