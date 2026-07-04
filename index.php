<?php

require("dbconnect.php");

$sql = "SELECT * FROM employee";
$result = mysqli_query($con,$sql);

$count=mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container p-3">

        <?php if ($count > 0 ){?>
            <h1 class="text-center">ข้อมูลพนักงาน</h1>
            <hr>
            <form action="deleteTextField.php" class="form-group mb-3" method="POST">
                <label for="">Employee Id</label>
                <input type="text" class="form-control" placeholder="Input employee id to delete" name="idemployee">
                <input type="submit" value="delete data" class="btn btn-danger my-2">
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>รหัสพนักงงาน</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>เพศ</th>
                        <th>ทักษะ</th>
                        <th>ลบข้อมูล</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)){?>
                        <tr>
                            <td><?php echo $row["id"]?></td>
                            <td><?php echo $row["fname"]?></td>
                            <td><?php echo $row["lname"]?></td>
                            <td>
                                <?php if ($row["gender"] == "male"){?>
                                    ชาย
                                <?php }else if ($row["gender"] == "female"){?>
                                    หญิง
                                <?php }?>
                        
                            </td>
                            <td><?php echo $row["skills"]?></td>
                            <td><a href="deleteQueryString.php?idemp=<?php echo $row["id"];?>" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a></td>

                            <form action="multipleDelete.php" method="POST">
                                  <td><input type="checkbox" class="form-check-input" name="idcheckbox[]" value="<?php echo $row["id"];?>"></td>

                          
                        </tr>
                    <?php }?>
                </tbody>
            </table>

        <?php }else{ ?>
            <div class="alert alert-primary">
                ไม่มีข้อมูลพนักงาน
            </div>
        <?php }?>
        
        <a href="insertForm.php" class="btn btn-success">บันทึกข้อมูลพนักงาน</a>
        <input type="submit" value="delete data" class="btn btn-danger">
        </form>

    </div>
   

    
    
</body>
</html>
