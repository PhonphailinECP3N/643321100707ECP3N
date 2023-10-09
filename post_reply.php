<?php
// เริ่ม session หรือเช็คการล็อคอิน
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // กระโดดไปหน้าล็อคอินถ้ายังไม่ล็อคอิน
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากแบบฟอร์ม
    $post_id = $_POST['post_id'];
    $reply_content = $_POST['reply_content'];
    $user_id = $_SESSION['user_id'];

    // เชื่อมต่อฐานข้อมูล
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "miniproject01";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // แปลงข้อมูลสตริงให้เป็นรูปแบบที่ปลอดภัยสำหรับ SQL
    $reply_content = $conn->real_escape_string($reply_content);

    // เพิ่มการตอบกลับลงในตาราง replies
    $sql = "INSERT INTO reply (post_id, user_id, reply_content) VALUES ('$post_id', '$user_id', '$reply_content')";

    if ($conn->query($sql) === TRUE) {
        // หลังจากบันทึกการตอบกลับสำเร็จ ให้ redirect ไปยังหน้ากระทู้ที่คุณต้องการ
        header("Location: reply.php?post_id=$post_id");
        exit;
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }

    $conn->close();
}