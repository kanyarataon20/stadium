<?php
require('./utility.php');

$sql = "SELECT * FROM stadium ORDER BY staId ASC";
$rs = mysqli_query($condb, $sql);
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

<body>
  <div class="nav">
    <div class="col-md ">
      <?php require('./navbar.php') ?>
    </div>
  </div>
  <br><br><br>
  <?php
  while ($data =  mysqli_fetch_assoc($rs)) {
  ?>
    <br><br>
    <center>
      <div class="card" style="width:400px">
        <div class="card-body">
          <h4 class="card-title"><?php echo $data['staName']; ?></h4>
          <p class="card-text">ประเภท<?php echo $data['staType']; ?></p>
          <p class="card-text">ชั่วโมงละ <?php echo $data['staPrice']; ?></p>
          <p class="card-text">เปิด 09.00 ปิด 22.00</p>
          <a href="login.php?staId=<?php echo $data['staId']; ?>&act=booking" class="btn btn-success">จองสนาม</a>
        </div>
        <?php
        if ($data['staPic'] == null) {
          echo '<img src="./img/t_15681789971513926916.jpg" class="img-thumbnail" >';
        } else {
          echo '<img src="./img/' . $data['staPic'] . '" class="img-thumbnail" >';
        }
        ?>
      </div>
    <?php } ?>
    </center>
    <br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>