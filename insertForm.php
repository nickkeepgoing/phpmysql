<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>บันทึกข้อมูลพนักงาน</title>
</head>
<body>
    <div class="container my-3">
        <h2 class="text-center">แบบฟอร์มบันทึกข้อมูล</h2>
    <form action="insertData.php" method="POST">
        <div class="form-group mb-3">
            <label for="firstname">ชื่อ</label>
            <input type="text" name="fname" id="" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="lastname">นามสกุล</label>
            <input type="text" name="lname" id="" class="form-control">
        </div>
				
				<div class="form-group mb-3">
						<label for="gender" class="form-check-label">เพศ</label>
						<br>

						<input type="radio" name="gender" id="" class="form-check-input" value="male">ชาย
						<input type="radio" name="gender" id=""  class="form-check-input"value="female">หญิง
						<input type="radio" name="gender" id=""  class="form-check-input"value="gay">เก
				</div>

				<div class="form-group mb-3">
						<label for="skill" class="form-check-label">Skills</label>
						<br>

						<input type="checkbox" class="form-check-input" name="skills[]" id=""  value="HTML">HTML
						<input type="checkbox" class="form-check-input" name="skills[]" id=""  value="CSS">CSS
						<input type="checkbox" class="form-check-input" name="skills[]" id=""  value="JAVASCRIPT">JAVASCRIPT
						<input type="checkbox" class="form-check-input" name="skills[]" id=""  value="Arduino">Arduino
				</div>

        <input type="submit" value="submit" class="btn btn-success">
        <input type="reset" value="clear data" class="btn btn-danger">
        <a href="index.php" class="btn btn-primary">กลับหน้าแรก</a>

    </form>

   
    </div>
    
</body>
</html>
