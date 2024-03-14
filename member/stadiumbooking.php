<?php
require('./utility.php');

$sql2 = "SELECT * FROM member ";
$rs2 = mysqli_query($condb, $sql2);
$data2 =  mysqli_fetch_assoc($rs2);

$sql = 'SELECT * FROM stadium WHERE staId = "' . $_GET['staId'] . '" ';
$rs = mysqli_query($condb, $sql);
$data = mysqli_fetch_assoc($rs);
$nowdate = date("Y-m-d");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>สนามเสือ</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./ycss.css">
<style>
  #hTop {
    background-image: url("img/bg.jpg");
    height: 450px;
  }
</style>

<body>
  <div class="nav">
    <div class="col-md ">
      <?php require('./navbar.php') ?>
    </div>
  </div>
  <br><br><br><br>
  <div style="margin-left: 20px;">
    <form action="savebk.php" method="post">
      <div class="form-group row">
        <label class="col-sm-2 ">ชื่อสนาม</label>
        <div class="col-sm-4">
          <input type="text" name="staName" class="form-control" disabled value="<?php echo $data['staName']; ?>">
          <input type="hidden" name="staId" value="<?php echo $data['staId']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 ">วันที่เริ่ม</label>
        <div class="col-sm-5">
          <input type="date" name="dateIn" class="form-control" value="<?php echo $nowdate ?>" required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 ">เวลาเริ่ม</label>
        <div class="col-sm-5">
          <select name="timeIn" id="timeIn" class="form-control" required>
            <?php
            // วนลูปสร้างรายการเวลาตั้งแต่ 09:00 ถึง 22:00 ทุกๆ 60 นาที
            for ($hour = 9; $hour <= 22; $hour++) {
              for ($minute = 0; $minute <= 50; $minute += 60) {
                // กำหนดรูปแบบของเวลาในรูปแบบ HH:MM
                $time = sprintf("%02d:%02d", $hour, $minute);
                // สร้างตัวเลือกของเวลา
                echo "<option value=\"$time\">$time</option>";
              }
            }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 ">วันที่สิ้นสุด</label>
        <div class="col-sm-5">
          <input type="date" name="dateOut" class="form-control" value="<?php echo $nowdate ?>" required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 ">เวลาสิ้นสุด</label>
        <div class="col-sm-5">
          <select name="timeOutt" id="timeOutt" class="form-control" required>
            <?php
            // วนลูปสร้างรายการเวลาตั้งแต่ 09:00 ถึง 22:00 ทุกๆ 60 นาที
            for ($hour = 9; $hour <= 22; $hour++) {
              for ($minute = 0; $minute <= 50; $minute += 60) {
                // กำหนดรูปแบบของเวลาในรูปแบบ HH:MM
                $time = sprintf("%02d:%02d", $hour, $minute);
                // สร้างตัวเลือกของเวลา
                echo "<option value=\"$time\">$time</option>";
              }
            }
            ?>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 ">ชื่อผู้จอง</label>
          <div class="col-sm-7">
            <input type="text" name="listName" class="form-control" required placeholder="ชื่อผู้จอง">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 ">เบอร์โทร</label>
          <div class="col-sm-7">
            <input type="text" name="memtel" class="form-control" required placeholder="เบอร์โทร" minlength="10" maxlength="10">
          </div>
        </div><br>
        <center>
          <label>ค่ามัดจำ 50</label><br>
          <img src="../img/prompay.JPG" width="200px" height="100%">
        </center>
        <div class="form-group row">
          <label class="col-sm-2 "></label>
          <div class="col-sm-10">
            <input type="hidden" name="staId" value="<?php echo $_GET['staId']; ?>">
            <button type="submit" class="btn btn-success" onclick="validateTime()">บันทึกการจอง</button>
            <br>
          </div>
        </div>
    </form>
    <center>
      <a href="index.php"><button type="submit" class="btn btn-outline-success">ย้อนกลับ</button></a>
    </center>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>