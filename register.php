<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="body">
    <h2 class="logo">REGISTER</h2>
    <ul>
        <li><a href="login.php">LOGIN</a></li>
        <li><a href="home.php">HOMEPAGE</a></li>
        <li><a href="index.php">WEBBORD</a></li>
    </ul>
</div>
    <main>
        <form action="register_process.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <!-- <div class="form-group">
                <label for="email">Password:</label>
                <input type="email" id="email" name="email" required>
            </div> -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button  n type="submit">REGISTER</button>
            </div>
        </form>
    </main>
</body>
</html>