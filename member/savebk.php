<?php
require('./utility.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่ามีค่าสำหรับแต่ละฟิลด์หรือไม่
    if (!empty($_POST['memtel']) && !empty($_POST['dateIn']) && !empty($_POST['dateOut']) && !empty($_POST['staId']) && !empty($_POST['listName']) && !empty($_POST['timeIn']) && !empty($_POST['timeOutt'])) {
        // รับค่าจากฟอร์ม
        $memtel = $_POST['memtel'];
        $dateIn = $_POST['dateIn'];
        $dateOut = $_POST['dateOut'];
        $staId = $_POST['staId'];
        $listName = $_POST['listName'];
        $timeIn = $_POST['timeIn'];
        $timeOutt = $_POST['timeOutt'];

        // ตรวจสอบว่ามีการจองซ้ำกันหรือไม่
        $sql_check_duplicate = "SELECT * FROM list WHERE staId = ? AND dateIn = ? AND timeIn = ?";
        $stmt_check_duplicate = mysqli_prepare($condb, $sql_check_duplicate);
        mysqli_stmt_bind_param($stmt_check_duplicate, "sss", $staId, $dateIn, $timeIn);
        mysqli_stmt_execute($stmt_check_duplicate);
        $result_check_duplicate = mysqli_stmt_get_result($stmt_check_duplicate);

        if (mysqli_num_rows($result_check_duplicate) > 0) {
            // พบการจองซ้ำกัน
            echo '<script>alert("สนามนี้มีการจองในวันและเวลาดังกล่าวแล้ว โปรดเลือกสนามใหม่หรือเลือกวันและเวลาใหม่"); window.location.href = "index.php"; </script>';
        } else {
            // ไม่พบการจองซ้ำกัน
            // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูล
            $sql = "INSERT INTO list (memtel, dateIn, dateOut, staId, listName, timeIn, timeOutt) VALUES (?, ?, ?, ?, ?, ?, ?)";

            // เตรียมและ execute statement
            $stmt = mysqli_prepare($condb, $sql);
            mysqli_stmt_bind_param($stmt, "sssssss", $memtel, $dateIn, $dateOut, $staId, $listName, $timeIn, $timeOutt);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                // บันทึกข้อมูลสำเร็จ
                echo '<script>alert("บันทึกข้อมูลการจองเรียบร้อยแล้ว"); window.location.href = "list.php";</script>';
            } else {
                // บันทึกข้อมูลไม่สำเร็จ
                echo '<script>alert("บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ค่ะ"); window.location.href = "stadiumbooking.php";</script>';
            }
        }
    } else {
        // กรอกข้อมูลไม่ครบ
        echo '<script>alert("กรุณากรอกข้อมูลให้ครบถ้วน");</script>';
    }
} else {
    // ไม่มีการส่งข้อมูลผ่านวิธี POST
    header("Location: index.php");
}
