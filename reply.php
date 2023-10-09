<?php
// เชื่อมต่อฐานข้อมูล
$conn = new mysqli('localhost', 'root', '', 'miniproject01');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับค่า post_id จาก URL
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // สร้างคำสั่ง SQL เพื่อดึงข้อมูลกระทู้
    $sql = "SELECT * FROM posts WHERE id = $post_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $post_title = $row['title'];
        $post_content = $row['content'];
        $post_user_id = $row['user_id'];
        $post_created_at = $row['created_at'];
    } else {
        echo "ไม่พบกระทู้";
        exit;
    }

    // สร้างคำสั่ง SQL เพื่อดึงข้อมูลตอบกลับ
    $sql = "SELECT * FROM reply WHERE post_id = $post_id";
    $result = $conn->query($sql);

    $replies = array();
    while ($row = $result->fetch_assoc()) {
        $replies[] = $row;
    }
} else {
    echo "ไม่ระบุ ID ของกระทู้";
    exit;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตอบกลับกระทู้</title>
    <link rel="stylesheet" href="reply.css">
</head>
<body>
    <div class="body">
    <h2 class="logo">REPLY</h2>
            <ul>
                <li> <a href="login.php"><li>LOGIN / REGISTER</a>
                <li><a href="home.php">HOMEPAGE</a></li>
                <li><a href="index.php">WEBBORD</a></li>
                <li><a href="logout.php" id="logoutBtn">LOGOUT</a></li>
            </ul>
    </div>
    <div class="main-content">
    <main>
    <div class="post">
        <h2>หัวข้อ: <?= $post_title ?></h2>
        <p>กระทู้: <?= $post_content ?></p>
        <p>โดย: <?= $post_user_id ?></p>
        <p>เวลา: <?= $post_created_at ?></p>
    </div>

    <h2>ตอบกลับ</h2>
    <ul class="replies">
        <?php foreach ($replies as $reply): ?>
            <li>
                <div class="reply">
                    <?php if (isset($reply['reply_content'])): ?>
                        <p><?= $reply['reply_content'] ?></p>
                    <?php endif; ?>
                    <p>โดยผู้ใช้: <?= $reply['user_id'] ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- สร้างแบบฟอร์มสำหรับการตอบกลับ -->
    <form action="post_reply.php" method="POST">
        <input type="hidden" name="post_id" value="<?= $post_id ?>">
        <div class="form-group">
            <label for="reply_content">เนื้อหา:</label>
            <textarea id="reply_content" name="reply_content" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit">ตอบกลับ</button>
        </div>
    </form>
</main>
    </div>
</body>
</html>