<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: home.php");
            exit();
        } else {
            $error = "รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        $error = "ไม่พบชื่อผู้ใช้งานนี้";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background: #f4f7f6; }
        .login-container { max-width: 400px; margin: 100px auto; padding: 30px; background: #fff; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-top: 4px solid #0d6efd;}
    </style>
</head>
<body>
    <div class="login-container">
        <h3 class="text-center text-primary mb-4">เข้าสู่ระบบรายวิชา IoT</h3>
        <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form method="post" action="">
            <div class="mb-3">
                <label>ชื่อผู้ใช้งาน</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>รหัสผ่าน</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
        </form>
        <div class="text-center mt-3">
            <a href="register.php" class="text-decoration-none">ยังไม่มีบัญชี? สมัครสมาชิก</a> | 
            <a href="index.html" class="text-decoration-none">กลับหน้าหลัก</a>
        </div>
    </div>
</body>
</html>
