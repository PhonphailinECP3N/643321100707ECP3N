<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
    <h2 class="logo">LOGIN</h2>
        <ul>
              <li><a href="register.php">REGISTER</a></li>
             <li><a href="home.php">HOMEPAGE</a></li>
            <li><a href="index.php">WEBBORD</a></li>
        </ul>
    

    <div class="content">
        <main>
            <form action="login_process.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit">LOGIN</button>
                </div>
            </form>
        </main>
    </div>
    </div>
</body>
</html>