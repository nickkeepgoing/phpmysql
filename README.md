# PHP + MySQL: ระบบจัดการข้อมูลพนักงาน (CRUD)

[![PHP](https://img.shields.io/badge/PHP-mysqli-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-database-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.8-7952B3?logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![XAMPP](https://img.shields.io/badge/XAMPP-local%20server-FB7A24?logo=xampp&logoColor=white)](https://www.apachefriends.org/)

โปรเจกต์ฝึกเขียนเว็บด้วย **PHP native + MySQL (mysqli)** ทำระบบจัดการข้อมูลพนักงานแบบ **CRUD** (Create, Read, Update, Delete) เขียนตามคลิปสอนใน YouTube:

📺 **อ้างอิงคลิป:** https://youtu.be/K3XYF7-gDG8

---

## สารบัญ

- [ภาพรวมโปรเจกต์](#ภาพรวมโปรเจกต์)
- [โครงสร้างฐานข้อมูล](#โครงสร้างฐานข้อมูล)
- [โครงสร้างไฟล์](#โครงสร้างไฟล์)
- [แนวคิด/คำสั่งสำคัญที่ได้เรียนรู้](#แนวคิดคำสั่งสำคัญที่ได้เรียนรู้)
- [จุดที่ควรระวัง / ปรับปรุงต่อ](#จุดที่ควรระวัง--ปรับปรุงต่อ)
- [วิธีติดตั้งและรันโปรเจกต์](#วิธีติดตั้งและรันโปรเจกต์)

---

## ภาพรวมโปรเจกต์

เว็บแอปนี้ไม่ใช้เฟรมเวิร์ก เขียน PHP ผสม HTML ตรง ๆ (PHP native) และใช้ **Bootstrap 5** จัดหน้าตา ฟีเจอร์หลักที่ทำได้:

- แสดงรายการพนักงานทั้งหมด พร้อมเรียงลำดับตามชื่อ
- เพิ่มข้อมูลพนักงานใหม่ (ชื่อ, นามสกุล, เพศ, ทักษะหลายรายการ)
- แก้ไขข้อมูลพนักงานเดิม พร้อม pre-select ค่าฟอร์มเดิม
- ลบข้อมูลได้ 3 รูปแบบ: ลบทีละรายการผ่าน URL, ผ่านฟอร์ม, และลบหลายรายการพร้อมกันด้วย checkbox
- ค้นหาพนักงานจากชื่อแบบ partial match

---

## โครงสร้างฐานข้อมูล

- ฐานข้อมูลชื่อ `mydata`
- ตารางชื่อ `employee` มีคอลัมน์อย่างน้อยดังนี้:

| คอลัมน์  | ชนิดข้อมูล      | ความหมาย                          |
|----------|-----------------|------------------------------------|
| id       | INT (PK, AI)    | รหัสพนักงาน                        |
| fname    | VARCHAR         | ชื่อ                                |
| lname    | VARCHAR         | นามสกุล                            |
| gender   | VARCHAR         | เพศ (`male`, `female`, `gay`)       |
| skills   | VARCHAR/TEXT    | ทักษะ เก็บเป็นสตริงคั่นด้วย comma  |

> ต้องสร้างฐานข้อมูล + ตารางนี้เองผ่าน phpMyAdmin ก่อนรันโปรเจกต์ (ไม่มีไฟล์ .sql แนบมาด้วย)

---

## โครงสร้างไฟล์

```
phpmysql/
├── dbconnect.php              # เชื่อมต่อ MySQL (ใช้ร่วมกันทุกไฟล์)
├── index.php                  # หน้าแรก: แสดงตาราง + ค้นหา + ลบหลายรายการ
├── searchData.php             # ค้นหาพนักงานจากชื่อ (LIKE)
├── insertForm.php             # ฟอร์มเพิ่มข้อมูล
├── insertData.php             # ประมวลผลการเพิ่มข้อมูล (INSERT)
├── editform.php                # ฟอร์มแก้ไขข้อมูล (pre-fill ค่าเดิม)
├── updateData.php             # ประมวลผลการแก้ไขข้อมูล (UPDATE)
├── deleteQueryString.php      # ลบทีละ 1 รายการผ่าน query string ($_GET)
├── deleteTextField.php        # ลบทีละ 1 รายการผ่านฟอร์ม ($_POST)
├── multipleDelete.php         # ลบหลายรายการพร้อมกัน (checkbox)
├── showdata_fetchassoc.php    # ตัวอย่าง mysqli_fetch_assoc()
├── showdata_fetcharray.php    # ตัวอย่าง mysqli_fetch_array()
├── showdata_fetchobject.php   # ตัวอย่าง mysqli_fetch_object()
├── showdata_fetchrow.php      # ตัวอย่าง mysqli_fetch_row()
├── showdata_forloop.php       # ตัวอย่างวนลูปด้วย for
└── showdata_while.php         # ตัวอย่างวนลูปด้วย while
```

### การเชื่อมต่อฐานข้อมูล
- **[dbconnect.php](dbconnect.php)** — ไฟล์กลางสำหรับเชื่อมต่อ MySQL ด้วย `mysqli_connect()` ทุกไฟล์ที่ต้องคุยกับ DB จะ `require("dbconnect.php")` ไฟล์นี้

### แสดงข้อมูล (Read) — ตัวอย่างวิธี fetch ข้อมูลหลายแบบ
ไฟล์กลุ่มนี้เป็นไฟล์ทดลอง/สาธิตวิธีดึงข้อมูลจาก `mysqli_query()` แบบต่าง ๆ (ไม่ใช่หน้าใช้งานจริง):

| ไฟล์ | ฟังก์ชันที่ใช้ | จุดสังเกต |
|------|----------------|-----------|
| [showdata_fetchassoc.php](showdata_fetchassoc.php) | `mysqli_fetch_assoc()` | ดึงแถวเป็น associative array เข้าถึงด้วยชื่อคอลัมน์ `$row["fname"]` |
| [showdata_fetcharray.php](showdata_fetcharray.php) | `mysqli_fetch_array($result, MYSQLI_BOTH)` | ได้ทั้งแบบ index และ key ในตัวเดียว |
| [showdata_fetchobject.php](showdata_fetchobject.php) | `mysqli_fetch_object()` | ดึงแถวเป็น object เข้าถึงด้วย `$row->fname` |
| [showdata_fetchrow.php](showdata_fetchrow.php) | `mysqli_fetch_row()` | ดึงแถวเป็น indexed array `$row[0]`, `$row[1]` ... |
| [showdata_forloop.php](showdata_forloop.php) | `for` + `mysqli_num_rows()` | วนลูปตามจำนวนแถวที่นับได้ (`$count`) |
| [showdata_while.php](showdata_while.php) | `while ($row = mysqli_fetch_row($result))` | วนลูปจนกว่าจะไม่มีแถวเหลือ (นิยมใช้ที่สุด) |

**สิ่งที่ควรเข้าใจ:** ฟังก์ชัน fetch ต่างกันแค่ "รูปแบบผลลัพธ์" แต่หลักการเดียวกันคือ query → ได้ `$result` → fetch ทีละแถวจนหมด

### หน้าหลัก / แสดงตารางข้อมูลจริง
- **[index.php](index.php)** — หน้าแรกของเว็บ
  - Query ข้อมูลทั้งหมด เรียงตามชื่อ (`ORDER BY fname ASC`)
  - แสดงผลเป็นตาราง Bootstrap พร้อมลำดับ (running number `$order++`)
  - แปลงค่า `gender` เป็นภาษาไทย (male → ชาย, female → หญิง) ด้วย `if/else`
  - มีฟอร์มค้นหาชื่อพนักงาน (ส่งไป `searchData.php`)
  - มีตาราง + checkbox สำหรับลบทีละหลายรายการ (ส่งไป `multipleDelete.php`)
  - แต่ละแถวมีปุ่ม Edit → ไป `editform.php` และปุ่ม Delete → ไป `deleteQueryString.php`
  - มีปุ่มลิงก์ไปหน้าเพิ่มข้อมูล `insertForm.php`
  - มี JavaScript เล็ก ๆ 2 ฟังก์ชัน (`checkAll()`, `uncheckAll()`) ไว้ติ๊ก/ยกเลิกติ๊กเลือกทั้งหมด

### ค้นหาข้อมูล (Search)
- **[searchData.php](searchData.php)** — รับค่าจากฟอร์มค้นหา (`$_POST["findname"]`) แล้ว query ด้วย `LIKE '%คำค้น%'` แสดงผลเป็นตารางแบบเดียวกับ `index.php`

### เพิ่มข้อมูล (Create)
- **[insertForm.php](insertForm.php)** — ฟอร์ม HTML สำหรับกรอกข้อมูลพนักงานใหม่ (ชื่อ, นามสกุล, เพศเป็น radio, ทักษะเป็น checkbox หลายค่า `skills[]`)
- **[insertData.php](insertData.php)** — รับค่าจากฟอร์ม, แปลง `skills[]` (array) เป็นสตริงคั่น comma ด้วย `implode(",", ...)`, แล้ว `INSERT INTO employee(...)` เมื่อสำเร็จ `header("location:index.php")` กลับหน้าแรก

### แก้ไขข้อมูล (Update)
- **[editform.php](editform.php)** — รับ `id` จาก URL (`$_GET["id"]`), query ข้อมูลเดิมมาเติมในฟอร์ม (ค่าเดิมของ radio/checkbox ถูกทำ pre-select ด้วย `checked` โดยเช็คจาก `$row["gender"]` และ `explode(',', $row["skills"])` + `in_array()`)
- **[updateData.php](updateData.php)** — รับค่าจากฟอร์มแก้ไข แล้ว `UPDATE employee SET ... WHERE id = $id`

### ลบข้อมูล (Delete) — 3 วิธี
| ไฟล์ | วิธีส่งค่า | คำสั่ง SQL |
|------|-----------|------------|
| [deleteQueryString.php](deleteQueryString.php) | ลบทีละ 1 รายการ ผ่าน query string ใน URL (`?idemp=xx`, `$_GET`) | `DELETE FROM employee WHERE id = $id` |
| [deleteTextField.php](deleteTextField.php) | ลบทีละ 1 รายการ ผ่านฟอร์ม textfield (`$_POST["idemployee"]`) | `DELETE FROM employee WHERE id = $id` |
| [multipleDelete.php](multipleDelete.php) | ลบหลายรายการพร้อมกัน จาก checkbox ที่ติ๊กไว้ (`$_POST["idcheckbox"]` เป็น array) แปลงเป็น string ด้วย `implode(",", ...)` | `DELETE FROM employee WHERE id in ($mul_id)` |

---

## แนวคิด/คำสั่งสำคัญที่ได้เรียนรู้

1. **การเชื่อมต่อฐานข้อมูล**: `mysqli_connect(host, user, password, database)`
2. **การ query**: `mysqli_query($con, $sql)` คืนค่า `$result`
3. **การนับแถว**: `mysqli_num_rows($result)`
4. **การดึงข้อมูลทีละแถว**: `mysqli_fetch_assoc()`, `mysqli_fetch_array()`, `mysqli_fetch_object()`, `mysqli_fetch_row()`
5. **การวนลูปแสดงข้อมูลทั้งหมด**: ใช้ `while` (จนกว่า fetch จะได้ `false`/`null`) หรือ `for` ร่วมกับ `mysqli_num_rows()`
6. **การรับค่าจากฟอร์ม**: `$_POST[...]` (method="POST") และ `$_GET[...]` (ส่งผ่าน query string ใน URL)
7. **การจัดการ input หลายค่า (checkbox)**: ตั้งชื่อ input เป็น `name="skills[]"` เพื่อให้ PHP รับเป็น array แล้วแปลงเป็นสตริงด้วย `implode(",", $array)` ก่อนบันทึกลง DB, และแปลงกลับเป็น array ด้วย `explode(',', $string)` ตอนดึงมาแสดง/เช็ค checked
8. **การ pre-select ฟอร์ม (radio/checkbox)**: เทียบค่าจาก DB กับค่าที่ต้องการ แล้ว echo attribute `checked` แบบมีเงื่อนไข
9. **CRUD ครบวงจร**:
   - Create → `INSERT INTO ... VALUES (...)`
   - Read → `SELECT * FROM ...`
   - Update → `UPDATE ... SET ... WHERE id = ...`
   - Delete → `DELETE FROM ... WHERE id = ...` หรือ `WHERE id IN (...)` สำหรับลบหลายรายการ
10. **การค้นหาแบบ partial match**: `WHERE column LIKE '%คำค้น%'`
11. **การ redirect หลังทำงานสำเร็จ**: `header("location:index.php"); exit;` — ป้องกันการ submit ฟอร์มซ้ำเมื่อรีเฟรชหน้า
12. **การยืนยันก่อนลบฝั่ง client**: `onclick="return confirm('...')"` ใน JavaScript

---

## จุดที่ควรระวัง / ปรับปรุงต่อ

ข้อสังเกตจากโค้ดปัจจุบัน (เป้าหมายหลักของโปรเจกต์คือฝึกพื้นฐาน จึงยังไม่ได้แก้ไขจุดเหล่านี้):

- ทุกคำสั่ง SQL ต่อ string จากค่า `$_POST`/`$_GET` ตรง ๆ (เช่น `"...WHERE id = $id"`) ซึ่งเสี่ยงต่อ **SQL Injection** ในการใช้งานจริงควรเปลี่ยนไปใช้ **Prepared Statements** (`mysqli_prepare` + bind parameter) แทน
- ใน [insertData.php](insertData.php) มีจุดพิมพ์ผิด `mysqli_errors($con)` (ที่ถูกคือ `mysqli_error($con)` ไม่มี s)
- ค่าที่ดึงจาก DB มาแสดงผล (เช่น `$row["fname"]`) ยังไม่ได้ผ่าน `htmlspecialchars()` ก่อน echo ซึ่งเสี่ยงต่อ **XSS** หากมีการกรอกข้อมูลที่มี HTML/script tag เข้ามา

---

## วิธีติดตั้งและรันโปรเจกต์

### สิ่งที่ต้องมี
- [XAMPP](https://www.apachefriends.org/) (Apache + MySQL + PHP)

### ขั้นตอน

1. Clone โปรเจกต์นี้ไว้ในโฟลเดอร์ `htdocs` ของ XAMPP:
   ```bash
   git clone https://github.com/nickkeepgoing/phpmysql.git C:/xampp/htdocs/phpmysql
   ```
2. เปิดโปรแกรม XAMPP Control Panel แล้วกด **Start** ที่ `Apache` และ `MySQL`
3. เข้า phpMyAdmin (`http://localhost/phpmyadmin`) แล้วสร้าง:
   - ฐานข้อมูลชื่อ `mydata`
   - ตารางชื่อ `employee` ตามโครงสร้างใน [โครงสร้างฐานข้อมูล](#โครงสร้างฐานข้อมูล)
4. เปิดเบราว์เซอร์ไปที่:
   ```
   http://localhost/phpmysql/index.php
   ```

---

## อ้างอิง

- คลิปสอนต้นฉบับ: https://youtu.be/K3XYF7-gDG8
