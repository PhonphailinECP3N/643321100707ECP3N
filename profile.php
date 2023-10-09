
<?php
// เริ่ม session หรือเช็คการล็อคอิน
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // กระโดดไปหน้าล็อคอินถ้ายังไม่ล็อคอิน
    exit;
}

// เชื่อมต่อฐานข้อมูล
$db = new mysqli('localhost', 'root', '', 'miniproject01');

if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

// ดึงข้อมูลผู้ใช้จาก session
$user_id = $_SESSION['user_id'];

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$sql = "SELECT * FROM users WHERE id = $user_id";
$userResult = $db->query($sql);

if ($userResult->num_rows > 0) {
    $userRow = $userResult->fetch_assoc();
    $username = $userRow['username'];
}

// ดึงรายการกระทู้ของผู้ใช้จากฐานข้อมูล
$sql = "SELECT * FROM posts WHERE user_id = $user_id";
$result = $db->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์ผู้ใช้</title>
    <link rel="stylesheet" href="profile1.css">
</head>
<body> 
<div class="main">
    <h2 class="logo">PROFIEL</h2>
        <ul>
            <li><a href="login.php">LOGIN</a></li>
            <li><a href="index.php">WEBBORD</a></li>
            <li><a href="profile.php">PROFIEL</a></li>
            <li><a href="logout.php" id="logoutBtn">LOGOUT</a></li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <p>Username: <?= isset($username) ? $username : 'N/A' ?></p>
            <p>User ID: <?= $user_id ?></p>
        </header>
        
        <main>
            <div class="profile">
                <h2>กระทู้ของคุณ</h2>
           
                <?php while ($row = $result->fetch_assoc()): ?>
                    
                    <p><?= $row['content'] ?></p>
                    <a href="edit_post.php?id=<?= $row['id'] ?>" class="edit-link">EDIT</a>
                    <a href="delete_post.php?post_id=<?= $row['id'] ?>" class="edit-link">DELETE</a> <!-- เพิ่มปุ่มลบ -->
                <?php endwhile; ?>
            </div>
            <a href="create_post.php" class="add-post-link">ADDNEW</a>
        </main>
    </div>
</body>
</html>
