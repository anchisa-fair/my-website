<?php
session_start();
require 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // ตรวจสอบว่ารหัสผ่านทั้งสองช่องตรงกันหรือไม่
    if ($password !== $confirm_password) {
        $error = "รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน กรุณาลองใหม่อีกครั้ง";
    } else {
        // เข้ารหัส password เมื่อรหัสผ่านตรงกันแล้ว
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('สมัครสมาชิกสำเร็จ!'); window.location.href='login.php';</script>";
            exit();
        } else {
            $error = "เกิดข้อผิดพลาด: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก - IoT Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Prompt', sans-serif; 
            background: linear-gradient(rgba(10, 30, 60, 0.75), rgba(10, 30, 60, 0.75)), 
                        url('https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1920') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container { 
            width: 100%;
            max-width: 420px; 
            padding: 35px; 
            background: rgba(255, 255, 255, 0.95); 
            border-radius: 12px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.2); 
            border-top: 5px solid #198754; 
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3 class="text-center text-success mb-4 fw-bold">สมัครสมาชิก</h3>

        <!-- แสดงข้อความแจ้งเตือนเมื่อรหัสผ่านไม่ตรงกัน -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">ชื่อผู้ใช้งาน</label>
                <input type="text" name="username" class="form-control" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">อีเมล</label>
                <input type="email" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">รหัสผ่าน</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">ยืนยันรหัสผ่าน</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100 py-2 fw-bold">สมัครสมาชิก</button>
        </form>
        <div class="text-center mt-3">
            <a href="login.php" class="text-decoration-none">มีบัญชีแล้ว? เข้าสู่ระบบ</a> | 
            <a href="index.html" class="text-decoration-none text-secondary">กลับหน้าหลัก</a>
        </div>
    </div>
</body>
</html>
