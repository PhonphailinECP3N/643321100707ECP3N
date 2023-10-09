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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
 

    // ตรวจสอบชื่อผู้ใช้ซ้ำ
    $check_duplicate_sql = "SELECT COUNT(*) AS count FROM users WHERE username = '$username'";
    $result = $conn->query($check_duplicate_sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
            echo "ชื่อผู้ใช้นี้มีอยู่แล้ว กรุณาเลือกชื่อผู้ใช้อื่น";
            echo "<br>";
            echo '<a href="register.php">กลับไปที่หน้าลงทะเบียน</a>';
            exit;
        }
    }

    // เพิ่มข้อมูลลงในตาราง users
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "สมัครสมาชิกสำเร็จ";
       header("Location: login.php");
        echo($sql);
        exit;
    } else {
        echo "เกิดข้อผิดพลาด: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>