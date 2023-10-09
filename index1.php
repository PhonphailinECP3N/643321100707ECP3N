<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เว็บบอร์ด</title>
    <link rel="stylesheet" href="index1.css">
</head>
<body>
    <div class="main">
    <h2 class="logo">WEBBORD</h2>
    <div class="menu">
        <ul>
            <li> <a href="login.php"><li>LOGIN / REGISTER</a>
            <li><a href="home.php">HOMEPAGE</a></li>
            <li><a href="profile.php">PROFIEL</a></li>
            <li><a href="logout.php" id="logoutBtn">LOGOUT</a></li>
        </ul>
    </div>
    </div>
    
    <main>
        <!-- แสดงรายการกระทู้ที่ดึงมาจากฐานข้อมูล -->
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
        // สร้างคำสั่ง SQL เพื่อดึงรายการกระทู้
        $sql = "SELECT * FROM posts ORDER BY created_at DESC";
        $result = $conn->query($sql);
        $totalPosts = $result->num_rows;

        echo "<div class='post-1'>";
        echo "<p>โพสต์ทั้งหมด: " . $totalPosts . " โพสต์</p>";
        // สร้างคำสั่ง SQL เพื่อดึงความคิดเห็น (การตอบกลับ)
        $commentSql = "SELECT * FROM replies ORDER BY reply_content DESC";
        $commentResult = $conn->query($commentSql);

        // นับจำนวนความคิดเห็น (การตอบกลับ)
        $totalComments = $commentResult;

        echo "<p>การตอบกลับทั้งหมด: " . $totalComments . " ความคิดเห็น</p>";
        echo "</div>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='post'>";
                echo "<h2>หัวข้อ:" . $row['title'] . "</h2>";
                echo "<p>กระทู้:" . $row['content'] . "</p>";
                echo "<p>id: " . $row['user_id'] . "</p>";
                echo "<button><a href='reply.php?post_id=" . $row['id'] . "'>REPLY</a></button>"; // เพิ่มลิงก์นี้
                echo "<button><a href='delete_post.php?post_id=" . $row['id'] . "'>DELETE</a></button>"; // เพิ่มลิงก์หรือปุ่ม "ลบ" นี้
                echo "</div>";
            }
        } else {
            echo "ไม่พบกระทู้";
        }

        $conn->close();
        ?>
    </main>

    <footer>
        <!-- สร้างลิงก์ไปยังหน้าตั้งกระทู้ใหม่ -->
        <a href="create_post.php">NEWPOST</a>
    </footer>
</body>
</html>