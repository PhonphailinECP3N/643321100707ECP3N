<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: profile.php');
    exit;
}

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $user_id = $_SESSION['user_id'];

    // เชื่อมต่อฐานข้อมูล
    $db = new mysqli('localhost', 'root', '', 'miniproject01');
    if ($db->connect_error) {
        die('Connection failed: ' . $db->connect_error);
    }

    // ตรวจสอบว่าผู้ใช้เป็นเจ้าของกระทู้หรือไม่
    $check_sql = "SELECT * FROM posts WHERE id = $post_id AND user_id = $user_id";
    $check_result = $db->query($check_sql);

    if ($check_result->num_rows == 1) {
        // ลบกระทู้
        $delete_sql = "DELETE FROM posts WHERE id = $post_id";
        if ($db->query($delete_sql) === TRUE) {
            header('Location: profile.php'); // เมื่อลบสำเร็จ กลับไปยังโปรไฟล์
            exit;
        } else {
            echo 'Error deleting post: ' . $db->error;
        }
    } else {
        echo 'คุณไม่มีสิทธิ์ในการลบกระทู้นี้';
    }

    $db->close();
} else {
    echo 'ไม่ระบุ ID ของกระทู้ที่ต้องการลบ';
}
?>