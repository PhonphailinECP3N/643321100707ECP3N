<?php
// เริ่ม session หรือเช็คการล็อคอิน
session_start();

// ตรวจสอบว่าผู้ใช้ล็อคอินหรือไม่
if (isset($_SESSION['username'])) {
    // ถ้าล็อคอินอยู่ ให้ทำลาย session เพื่อออกจากระบบ
    session_unset(); // ล้างข้อมูลใน session
    session_destroy(); // ทำลาย session

    // แสดงเตือนใน JavaScript ว่าออกจากระบบแล้ว
    echo '<script>alert("ออกจากระบบแล้ว");</script>';
}

// หลังจากออกจากระบบให้ redirect ไปยังหน้า login
header('Location: login.php');
exit;
?>