<?php
require('./utility.php');

$sql2 = "SELECT * FROM member";
$rs2 = mysqli_query($condb, $sql2);
$data2 =  mysqli_fetch_assoc($rs2);

if (isset($_POST['btn1'])) {
    $sql = 'UPDATE stadium SET staName="' . $_POST['staName'] . '",staType="' . $_POST['staType'] . '",staPrice="' . $_POST['staPrice'] . '" 
        WHERE staId ="' . $_POST['staId'] . '"';
    mysqli_query($condb, $sql);
    header('Location:stadium.php');

    if (!empty($_FILES['staPic']['name'])) {
        move_uploaded_file($_FILES['staPic']['tmp_name'], '../img/' . $_FILES['staPic']['name']);
        $sql .= ' ,staPic = "' . $_FILES['staPic']['name'] . '" ';
    }

    $sql .= 'WHERE staPic="' . $_SESSION['user']['staPic'] . '"';
    mysqli_query($condb, $sql);

    $sql = 'SELECT * FROM stadium WHERE staPic="' . $_SESSION['user']['staPic'] . '"';
    $rs = mysqli_query($condb, $sql);
    $_SESSION['user'] = mysqli_fetch_assoc($rs);
}
if (isset($_GET['staId'])) {
    $sql = 'SELECT * FROM stadium WHERE staId="' . $_GET['staId'] . '" ';
    $rs = mysqli_query($condb, $sql);
    $_SESSION['user'] = mysqli_fetch_assoc($rs);
} else {
    // กรณีที่ไม่มีค่า staId หรือมีค่าไม่ถูกต้อง สามารถจัดการได้ตามความเหมาะสม
    // เช่น การ redirect หรือแสดงข้อความแจ้งเตือน
}

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
</head>

<body>
    <div class="nav">
        <div class="col-md ">
            <?php require('./navbar.php') ?>
        </div>
    </div>
    <br><br><br>
    <div class="container-fluid ">
        <center>
            <br>
            <div class="col-6 border rounded mt-2 p-2 ">
                <h1>แก้ไขข้อมูลสนาม</h1>
                <form method="POST" enctype="multipart/form-data">
                    <div class="col-4">
                        <?php
                        if ($_SESSION['user']['staPic'] == null) {
                            echo '<img src="../img/t_15681789971513926916.jpg" class="img-thumbnail">';
                        } else {
                            echo '<img src="../img/' . $_SESSION['user']['staPic'] . '" class="img-thumbnail">';
                        }
                        ?>
                    </div>
                    <div class="col-8 text-start d-flex flex-column justify-content-end">
                        <input type="file" name="staPic" class="form-control" placeholder="ภาพสนาม">
                    </div>
                    <input type="text" name="staId" placeholder="หมายเลขสนาม" class="form-control w-100 my-2" value="<?php echo $_SESSION['user']['staId'] ?> " readonly>
                    <input type="text" name="staType" placeholder="ประเภท" class="form-control w-100 my-2" value="<?php echo $_SESSION['user']['staType'] ?> " readonly>
                    <input type="text" name="staName" placeholder="ชื่อสนาม" class="form-control w-100 my-2" value="<?php echo $_SESSION['user']['staName'] ?> ">
                    <input type="text" name="staPrice" placeholder="ราคา" class="form-control w-100 my-2" value="<?php echo $_SESSION['user']['staPrice'] ?> ">
                    <br>
                    <a href="stadium.php"> <button name="btnadd" type="button" class="btn btn-outline-secondary p-3  mt-3 ">กลับ</button></a>
                    <button type="submit" class="btn btn-secondary p-3  mt-3" name="btn1">บันทึก</button>
                </form>
            </div>
            <br>
    </div>
</body>

</html>