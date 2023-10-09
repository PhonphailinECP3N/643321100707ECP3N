<?php
session_start();

// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "miniproject01";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ตรวจสอบชื่อผู้ใช้และรหัสผ่าน
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // ล็อกอินสำเร็จ
        $row = $result->fetch_assoc();
        // กำหนดค่าเซสชัน
        $_SESSION['user_id'] = $row['id'];
        // เด้งไปยังหน้าหลังจากล็อกอินสำเร็จ
        header("Location: index1.php");
        exit;
    } else {
        // ล็อกอินไม่สำเร็จ
        echo "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    }
}

$conn->close();
?>