<?php
require("dbconnect.php");

$findname = $_POST["findname"];

$sql = "SELECT * FROM employee WHERE fname LIKE '%$findname%' ORDER BY fname ASC";
$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);
$order = 1;
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

        <?php if ($count > 0) { ?>
            <h1 class="text-center">ข้อมูลพนักงาน</h1>
            <hr>

            <!-- ฟอร์มที่ 1: ลบด้วยการพิมพ์ id -->
            <form action="searchData.php" class="form-group mb-3" method="POST">
                <label for="">ค้นหาช้อมูล</label>
                <input type="text" class="form-control" placeholder="ป้อนชื่อพนักงาน" name="findname">
                <input type="submit" value="ค้นหา" class="btn btn-dark my-2">
            </form>

            <!-- ฟอร์มที่ 2: ลบหลายรายการ ต้อง "ครอบทั้งตาราง" -->
            <form action="multipleDelete.php" method="POST">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>รหัสพนักงงาน</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>เพศ</th>
                            <th>ทักษะ</th>
                            <th>แก้ไขข้อมูล</th>
                            <th>ลบข้อมูล</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $order++; ?></td>
                                <td><?php echo $row["fname"]; ?></td>
                                <td><?php echo $row["lname"]; ?></td>
                                <td>
                                    <?php if ($row["gender"] == "male") { ?>
                                        ชาย
                                    <?php } else if ($row["gender"] == "female") { ?>
                                        หญิง
                                    <?php } ?>
                                </td>
                                <td><?php echo $row["skills"]; ?></td>
                                <td><a href="editform.php?id=<?php echo $row["id"];?>" class="btn btn-primary">Edit</a></td>
                                <td>
                                    <a href="deleteQueryString.php?idemp=<?php echo $row["id"]; ?>"
                                       onclick="return confirm('Are you sure to delete?')"
                                       class="btn btn-danger">Delete</a>
                                </td>
                                <td>
                                    <input type="checkbox" class="form-check-input"
                                           name="idcheckbox[]" value="<?php echo $row["id"]; ?>">
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <input type="submit" value="ลบข้อมูล" class="btn btn-danger">
                <button type="button" class="btn btn-info" onclick="checkAll()">เลือกทั้งหมด</button>
                <button type="button" class="btn btn-warning" onclick="uncheckAll()">ยกเลิก</button>
            </form>

        <?php } else { ?>
            <div class="alert alert-primary">
                ไม่มีข้อมูลพนักงาน
            </div>
        <?php } ?>

        <a href="index.php" class="btn btn-success mt-3">Back</a>

    </div>
</body>
<script>
    function checkAll() {
        var checkboxes = document.getElementsByName('idcheckbox[]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = true;
        }
    }

    function uncheckAll() {
        var checkboxes = document.getElementsByName('idcheckbox[]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = false;
        }
    }
</script>
</html>