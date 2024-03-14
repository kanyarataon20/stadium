<?php
require('./utility.php');
$err = '';
if (isset($_POST['btnl'])) {
    $sql = 'SELECT * FROM member WHERE memtel="' . $_POST['memtel'] . '" ';
    $rs = mysqli_query($condb, $sql);
    if (mysqli_num_rows($rs) == 0) {
        $sql = ' INSERT INTO member (memtel,memfirst,memlast,mememail,mempass,memstatus)
            VALUES ("' . $_POST['memtel'] . '","' . $_POST['memfirst'] . '","' . ($_POST['memlast']) . '","' . $_POST['mememail'] . '","' . md5($_POST['mempass']) . '","0") ';
        mysqli_query($condb, $sql);
        header("Location:login.php");
    } else {
        $err = '<div class="alert alert-danger">อีเมลล์นี้ถูกใช้งานไปแล้ว</div>';
        header("Location:register.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สนามเสือ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./ycss.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-image: url('football2.jpg');
            /* Add your background image URL */
            background-size: cover;
            /* Make sure the background image covers the entire viewport */
            background-repeat: no-repeat;
            /* Prevent the background image from repeating */
            background-position: center center;
            /* Center the background image */
        }

        .navbar {
            background-color: #28a745;
            /* Change navbar background color to green */
            min-height: 40px;
            /* Adjust height of the navbar */
        }

        .navbar-brand img {
            width: 80px;
            /* Adjust size of the logo */
            height: 80px;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #28a745;
            /* Change navbar link color to white */
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: #28a745;
            /* Change navbar link color on hover */
        }

        .navbar-light .navbar-toggler {
            border-color: #28a745;
            /* Change color of the toggler icon */
        }

        .navbar-light .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='%23fff' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-light .navbar-toggler:hover {
            background-color: #28a745;
            /* Change toggler background color on hover */
        }

        .form-container {
            margin-top: 50px;
            /* Adjust margin-top to move the form box down */
            text-align: center;
            background-color: rgba(0, 0, 0, 0.7);
            /* Make the form box semi-transparent */
            padding: 20px;
            /* Add padding for better spacing */
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
            /* Add green shadow to the form box */
            border-radius: 10px;
            /* Add border radius to round the corners */
            border: 2px solid black;
            /* Add black border */
            max-width: 600px;
            /* Set maximum width of the form container */
            margin-left: auto;
            /* Center the form container horizontally */
            margin-right: auto;
            /* Center the form container horizontally */
            color: white;
            /* Set text color to white */
        }

        .footer {
            background-color: #28a745;
            color: white;
            padding: 8px 0;
            /* Adjust footer padding */
            text-align: center;
            width: 100%;
            position: fixed;
            bottom: 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-success p-2 border">
        <div class="container">
            <a href="index.php" class="navbar-brand">
                <img src="./img/lo1.png" alt="logo">
            </a>
            <button class="btn btn-secondary me-2 btn-back" onclick="goBack()"><i class="fas fa-arrow-left"></i> ย้อนกลับ</button>
        </div>
    </nav>
    <div class="container form-container">
        <h1>ป้อนข้อมูลของคุณเพื่อเริ่มต้นใช้งาน..</h1>
        <form method="post">
            <input type="email" name="mememail" placeholder="e-mail" class="form-control w-100 my-2" required>
            <input type="password" name="mempass" placeholder="รหัสผ่าน" class="form-control w-100 my-2" required>
            <input type="text" name="memfirst" placeholder="ชื่อ" class="form-control w-100 my-2" required>
            <input type="text" name="memlast" placeholder="นามสกุล" class="form-control w-100 my-2" required>
            <input type="text" name="memtel" placeholder="เบอร์โทรศัพท์" class="form-control w-100 my-2" required minlength="10" maxlength="10">
            <button name="btnl" class="btn btn-secondary p-3 w-100 mt-3" type="submit">สมัครสมาชิก</button>
        </form>
        <?php echo $err; ?>
    </div>
    <footer class="footer">
        <div class="container">
            <p>Copyright &copy; 2024 สนามเสือ. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function goBack() {
            window.location.href = 'index.php';
        }
    </script>
</body>

</html>