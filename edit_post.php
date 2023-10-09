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
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    // เชื่อมต่อฐานข้อมูล
    $db = new mysqli('localhost', 'root', '', 'miniproject01');

    if ($db->connect_error) {
        die('Connection failed: ' . $db->connect_error);
    }

    // สร้างคำสั่ง SQL เพื่อแก้ไขกระทู้
    $sql = "UPDATE posts SET title = '$title', content = '$content' WHERE id = $post_id AND user_id = $user_id";

    if ($db->query($sql) === TRUE) {
        header('Location: profile.php'); // เมื่อแก้ไขกระทู้สำเร็จ กลับไปยังโปรไฟล์
        exit;
    } else {
        echo 'Error: ' . $sql . '<br>' . $db->error;
    }

    $db->close();
} else {
    // รับ ID ของกระทู้ที่จะแก้ไขจากพารามิเตอร์
    if (isset($_GET['id'])) {
        $post_id = $_GET['id'];
        $user_id = $_SESSION['user_id'];

        // เชื่อมต่อฐานข้อมูล
        $db = new mysqli('localhost', 'root', '', 'miniproject01');
        if ($db->connect_error) {
            die('Connection failed: ' . $db->connect_error);
        }

        // ค้นหาข้อมูลกระทู้ที่ต้องการแก้ไข
        $sql = "SELECT * FROM posts WHERE id = $post_id AND user_id = $user_id";
        $result = $db->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $title = $row['title'];
            $content = $row['content'];
        } else {
            echo 'ไม่พบกระทู้ที่ต้องการแก้ไข';
            exit;
        }

        $db->close();
    } else {
        echo 'ไม่ระบุ ID ของกระทู้ที่ต้องการแก้ไข';
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขกระทู้</title>
    <link rel="stylesheet" href="edit1.css">
</head>
<body>
<div class="body">
<h2 class="logo">Edit Post</h2>
        <ul>
            <li><a href="home.php">HOMEPAGE</a></li>
            <li><a href="profile.php">PROFIEL</a></li>
            <li><a href="logout.php" id="logoutBtn">LOGOUT</a></li>
        </ul>
    </div>
    
    <main>
        <form action="edit_post.php" method="POST">
            <input type="hidden" name="post_id" value="<?= $post_id ?>">
            <div class="form-group">
                <label for="title">หัวข้อ:</label>
                <input type="text" id="title" name="title" value="<?= $title ?>" required>
            </div>
            <div class="form-group">
                <label for="content">เนื้อหา:</label>
                <textarea type="text" id="content" name="content" required><?= $content ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit">บันทึก</button>
            </div>
        </form>
    </main>
</body>
</html>