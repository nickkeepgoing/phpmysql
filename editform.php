<?php
require("dbconnect.php");
$id =  $_GET["id"];

$sql = "SELECT * FROM employee WHERE id = $id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>แก้ไขข้อมูลพนักงาน</title>
</head>
<body>
    <div class="container my-3">
        <h2 class="text-center">แบบฟอร์มแก้ไขข้อมูล</h2>
    <form action="updateData.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
        <div class="form-group mb-3">
            <label for="firstname">ชื่อ</label>
            <input type="text" name="fname" id="" class="form-control" value="<?php echo $row["fname"];?>">
        </div>
        <div class="form-group mb-3">
            <label for="lastname">นามสกุล</label>
            <input type="text" name="lname" id="" class="form-control" value="<?php echo $row["lname"];?>">
        </div>
				
				<div class="form-group mb-3">
						<label for="gender" class="form-check-label">เพศ</label>
						<br>
                        <?php 
                        if ($row["gender"] == "male"){
                            echo "<input type='radio' name='gender' id='' class='form-check-input' value='male' checked>ชาย";
                            echo "<input type='radio' name='gender' id=''  class='form-check-input'value='female'>หญิง";
                            echo "<input type='radio' name='gender' id=''  class='form-check-input'value='gay'>เก";
                        }else if ($row["gender"] == "female"){
                            echo "<input type='radio' name='gender' id='' class='form-check-input' value='male'>ชาย";
                            echo "<input type='radio' name='gender' id='' class='form-check-input' value='female' checked>หญิง";
                            echo "<input type='radio' name='gender' id=''  class='form-check-input'value='gay'>เก";
                        }else{
                            echo "<input type='radio' name='gender' id='' class='form-check-input' value='male'>ชาย";
                            echo "<input type='radio' name='gender' id='' class='form-check-input' value='female'>หญิง";
                            echo "<input type='radio' name='gender' id=''  class='form-check-input'value='gay'>เก";
                        }
                        ?>
						<input type="radio" name="gender" id="" class="form-check-input" value="male">ชาย
						<input type="radio" name="gender" id=""  class="form-check-input"value="female">หญิง
						<input type="radio" name="gender" id=""  class="form-check-input"value="gay">เก
				</div>

				<div class="form-group mb-3">
						<label for="skill" class="form-check-label">Skills</label>
						<br>
                        
                        <?php 
                        $selectedSkills = explode(',', $row["skills"]);
                        ?>
						<input type="checkbox" class="form-check-input" name="skills[]" id=""  value="HTML" <?php echo in_array('HTML', $selectedSkills) ? 'checked' : ''; ?>>HTML
						<input type="checkbox" class="form-check-input" name="skills[]" id=""  value="CSS" <?php echo in_array('CSS', $selectedSkills) ? 'checked' : ''; ?>>CSS
						<input type="checkbox" class="form-check-input" name="skills[]" id=""  value="JAVASCRIPT" <?php echo in_array('JAVASCRIPT', $selectedSkills) ? 'checked' : ''; ?>>JAVASCRIPT
						<input type="checkbox" class="form-check-input" name="skills[]" id=""  value="Arduino" <?php echo in_array('Arduino', $selectedSkills) ? 'checked' : ''; ?>>Arduino
				</div>

        <input type="submit" value="submit" class="btn btn-success">
        <input type="reset" value="clear data" class="btn btn-danger">
        <a href="index.php" class="btn btn-primary">กลับหน้าแรก</a>

    </form>

   
    </div>
    
</body>
</html>
