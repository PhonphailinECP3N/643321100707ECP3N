<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "miniproject01";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start(); // เริ่มเซสชัน

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id']; // ใช้ user_id จากเซสชัน

    // เพิ่มข้อมูลลงในตาราง posts
    $sql = "INSERT INTO posts (title, content, user_id) VALUES ('$title', '$content', '$user_id')";

    if ($conn->query($sql) === TRUE) {
        echo "ตั้งกระทู้สำเร็จ";
        header("Location: index1.php"); // ไปยังหน้าแสดงรายการกระทู้หลังจากสร้างเสร็จ
        exit;
    } else {
        echo "เกิดข้อผิดพลาด: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>