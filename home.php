<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บทเรียน - IoT Course</title>
    <!-- Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- ฟอนต์ Kanit -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Kanit', sans-serif; 
            background: linear-gradient(rgba(245, 247, 250, 0.92), rgba(245, 247, 250, 0.95)), 
                        url('https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1920') no-repeat center center fixed;
            background-size: cover;
            color: #2b2d42;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }

        .banner-image {
            width: 100%;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            margin-bottom: 2.5rem;
            border: 1px solid #e2e8f0;
        }

        .lesson-card { 
            background: #ffffff;
            color: #2b2d42;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); 
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            overflow: hidden;
            position: relative;
        }
        
        .lesson-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #0d6efd, #0dcaf0);
        }

        .lesson-card:hover { 
            transform: translateY(-8px); 
            box-shadow: 0 12px 25px rgba(13, 110, 253, 0.12); 
            border-color: #cbd5e1;
        }

        .lesson-number {
            font-size: 3rem;
            font-weight: 700;
            color: #0d6efd;
            opacity: 0.12;
            position: absolute;
            top: 10px;
            right: 20px;
            line-height: 1;
        }

        footer {
            flex-shrink: 0;
            background-color: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(8px);
            color: #cbd5e1;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        footer a {
            transition: all 0.2s ease;
        }
        footer a:hover {
            color: #38bdf8 !important;
            padding-left: 4px;
        }
        .social-icon {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
            transition: 0.3s;
        }
        .social-icon:hover {
            background: #0d6efd;
            color: #fff !important;
            transform: translateY(-3px);
            padding-left: 0 !important;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="home.php">
                <i class="bi bi-cpu me-2"></i>IoT Course
            </a>
            <div class="d-flex align-items-center">
                <span class="me-3 text-secondary">
                    <i class="bi bi-person-circle me-1 text-primary"></i> คุณ <strong class="text-dark"><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                </span>
                <a href="logout.php" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                    <i class="bi bi-box-arrow-right me-1"></i> ออกจากระบบ
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-5 flex-grow-1">
        
        <!-- ภาพ Banner -->
        <img src="img/banner.png" alt="IoT Course Banner" class="banner-image">

        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark mb-2">สารบัญบทเรียน <span class="text-primary">Internet of Things</span></h2>
            <p class="text-muted">เลือกบทเรียนด้านล่างเพื่อเริ่มต้นการเรียนรู้</p>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            
            <!-- บทที่ 1 -->
            <div class="col">
                <div class="card h-100 lesson-card">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="lesson-number">01</div>
                        <h5 class="card-title fw-bold text-primary mt-2">
                            <i class="bi bi-journal-text me-2"></i>ความรู้เบื้องต้นเกี่ยวกับ IoT
                        </h5>
                        <p class="card-text text-muted mt-2 flex-grow-1">เรียนรู้ความหมาย องค์ประกอบ และการทำงานพื้นฐานของระบบ</p>
                        <a href="lesson1.php" target="_blank" onclick="completeLesson(1)" class="btn btn-primary rounded-pill mt-3 w-100 fw-medium">เข้าสู่บทเรียน</a>
                    </div>
                </div>
            </div>

            <!-- บทที่ 2 -->
            <div class="col">
                <div class="card h-100 lesson-card">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="lesson-number">02</div>
                        <h5 class="card-title fw-bold text-primary mt-2">
                            <i class="bi bi-motherboard me-2"></i>อุปกรณ์และฮาร์ดแวร์
                        </h5>
                        <p class="card-text text-muted mt-2 flex-grow-1">รู้จักไมโครคอนโทรลเลอร์ เซ็นเซอร์ต่างๆ เช่น บอร์ด ESP32</p>
                        <a href="lesson2.php" target="_blank" onclick="completeLesson(2)" class="btn btn-primary rounded-pill mt-3 w-100 fw-medium">เข้าสู่บทเรียน</a>
                    </div>
                </div>
            </div>

            <!-- บทที่ 3 -->
            <div class="col">
                <div class="card h-100 lesson-card">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="lesson-number">03</div>
                        <h5 class="card-title fw-bold text-primary mt-2">
                            <i class="bi bi-grid-3x3-gap-fill me-2"></i>การประยุกต์ใช้งาน IoT
                        </h5>
                        <p class="card-text text-muted mt-2 flex-grow-1">ศึกษากรณีศึกษาการใช้งาน IoT ในโดเมนต่างๆ เช่น Smart Home, Smart Farming, IIoT และ Healthcare</p>
                        <a href="lesson3.php" target="_blank" onclick="completeLesson(3)" class="btn btn-primary rounded-pill mt-3 w-100 fw-medium">เข้าสู่บทเรียน</a>
                    </div>
                </div>
            </div>

            <!-- บทที่ 4 -->
            <div class="col">
                <div class="card h-100 lesson-card">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="lesson-number">04</div>
                        <h5 class="card-title fw-bold text-primary mt-2">
                            <i class="bi bi-shield-lock me-2"></i>ความมั่นคงปลอดภัยและการปกป้องข้อมูล
                        </h5>
                        <p class="card-text text-muted mt-2 flex-grow-1">เรียนรู้ภัยคุกคามไซเบอร์ สามเหลี่ยม CIA, Zero Trust Architecture และการคุ้มครองข้อมูลส่วนบุคคล (PDPA)</p>
                        <a href="lesson4.php" target="_blank" onclick="completeLesson(4)" class="btn btn-primary rounded-pill mt-3 w-100 fw-medium">เข้าสู่บทเรียน</a>
                    </div>
                </div>
            </div>

            <!-- บทที่ 5 -->
            <div class="col">
                <div class="card h-100 lesson-card">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="lesson-number">05</div>
                        <h5 class="card-title fw-bold text-primary mt-2">
                            <i class="bi bi-cpu me-2"></i>องค์ประกอบเชิงลึกของระบบ IoT
                        </h5>
                        <p class="card-text text-muted mt-2 flex-grow-1">เจาะลึกสถาปัตยกรรมระบบ (Architecture), การแปลงสัญญาณ ADC, Edge AI และ Data Pipeline</p>
                        <a href="lesson5.php" target="_blank" onclick="completeLesson(5)" class="btn btn-primary rounded-pill mt-3 w-100 fw-medium">เข้าสู่บทเรียน</a>
                    </div>
                </div>
            </div>

            <!-- แบบทดสอบรวม (ถูกล็อกไว้จนกว่าจะเรียนครบ บทที่ 1-5) -->
            <div class="col">
                <div class="card h-100 lesson-card" id="quiz-card">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="lesson-number text-danger" id="quiz-icon-lock"><i class="bi bi-lock-fill"></i></div>
                        <h5 class="card-title fw-bold text-secondary mt-2" id="quiz-title">
                            <i class="bi bi-file-earmark-text me-2"></i>แบบทดสอบประมวลความรู้
                        </h5>
                        <p class="card-text text-muted mt-2 flex-grow-1" id="quiz-desc">
                            กรุณาเรียนให้ครบทุกบทเรียน (บทที่ 1 - 5) จึงจะสามารถปลดล็อกทำแบบทดสอบได้
                        </p>
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSepgiw4070OF1wcjmV6pgZronfKSdFwhL4PlCLr6J8BRt57FQ/viewform" 
                           id="quiz-btn" target="_blank" class="btn btn-secondary rounded-pill mt-3 w-100 fw-medium disabled" aria-disabled="true">
                            🔒 ยังไม่ปลดล็อก
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ฟุตเตอร์แบบสว่าง -->
    <footer class="pt-4 pb-3 mt-auto">
        <div class="container">
            <div class="row g-4 mb-3">
                <div class="col-lg-4 col-md-6">
                    <h6 class="fw-bold text-white mb-2"><i class="bi bi-cpu text-primary me-2"></i>IoT Learning Platform</h6>
                    <p class="small text-secondary leading-relaxed mb-0">
                        ระบบคลังความรู้ออนไลน์ รายวิชา อินเทอร์เน็ตของสรรพสิ่ง (Internet of Things) มุ่งเน้นการส่งเสริมทักษะด้านเทคโนโลยีสมองกลฝังตัวและระบบเครือข่ายไร้สาย
                    </p>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold text-white mb-2">ลิงก์ด่วน</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-1"><a href="contact.php" class="text-decoration-none text-secondary"><i class="bi bi-chevron-right me-1"></i>ติดต่อเรา</a></li>
                        <li class="mb-1"><a href="login.php" class="text-decoration-none text-secondary"><i class="bi bi-chevron-right me-1"></i>เข้าสู่ระบบ</a></li>
                        <li class="mb-1"><a href="register.php" class="text-decoration-none text-secondary"><i class="bi bi-chevron-right me-1"></i>สมัครสมาชิก</a></li>
                    </ul>
                </div>

                <div class="col-lg-5 col-md-12">
                    <h6 class="fw-bold text-white mb-2">การติดต่อ & โซเชียลมีเดีย</h6>
                    <ul class="list-unstyled small text-secondary mb-2">
                        <li class="mb-1"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>แผนกวิชาเทคโนโลยีธุรกิจดิจิทัล / วิทยาลัยการอาชีพขาณุวรลักษบุรี</li>
                        <li class="mb-1"><i class="bi bi-envelope-fill me-2 text-primary"></i>ckhanupublic.re@ovec.moe.go.th</li>
                        <li class="mb-1"><i class="bi bi-telephone-fill me-2 text-primary"></i>055-XXX-XXX</li>
                    </ul>
                    <div class="d-flex gap-2 pt-1">
                        <a href="https://www.facebook.com/share/1Rtf3gauqj/?mibextid=wwXIfr" target="_blank" class="social-icon" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://youtube.com/@khanuchannel?si=wigcEjTBzo0VfkwS" target="_blank" class="social-icon" title="YouTube"><i class="bi bi-youtube"></i></a>
                        <a href="http://www.khanu.ac.th" target="_blank" class="social-icon" title="Website"><i class="bi bi-globe"></i></a>
                    </div>
                </div>
            </div>

            <hr class="border-secondary opacity-25 my-3">

            <div class="row align-items-center small text-secondary">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    © 2026 IoT Course Online. All Rights Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <span>ออกแบบเพื่อการศึกษาเทคโนโลยีและนวัตกรรมดิจิทัล</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Script สำหรับจัดการสถานะการเรียนและปลดล็อกแบบทดสอบ -->
    <script>
        function checkLessonStatus() {
            let completedCount = 0;
            for (let i = 1; i <= 5; i++) {
                if (localStorage.getItem('lesson_' + i + '_visited') === 'true') {
                    completedCount++;
                }
            }

            const quizBtn = document.getElementById('quiz-btn');
            const quizTitle = document.getElementById('quiz-title');
            const quizDesc = document.getElementById('quiz-desc');
            const quizCard = document.getElementById('quiz-card');
            const quizIconLock = document.getElementById('quiz-icon-lock');

            if (completedCount >= 5) {
                // ปลดล็อกเมื่อเรียนครบทุก 5 บท
                quizBtn.classList.remove('btn-secondary', 'disabled');
                quizBtn.classList.add('btn-success', 'shadow');
                quizBtn.innerHTML = '📝 เริ่มทำแบบทดสอบ (ปลดล็อกแล้ว)';
                quizBtn.removeAttribute('aria-disabled');
                
                quizTitle.classList.remove('text-secondary');
                quizTitle.classList.add('text-success');
                quizDesc.innerHTML = 'คุณเรียนครบทั้ง 5 บทเรียบร้อยแล้ว สามารถคลิกเพื่อทำแบบทดสอบได้เลย';
                quizIconLock.innerHTML = '<i class="bi bi-unlock-fill text-success"></i>';
                quizIconLock.style.opacity = '0.3';
            } else {
                // ยังเรียนไม่ครบ
                quizBtn.classList.add('btn-secondary', 'disabled');
                quizBtn.classList.remove('btn-success', 'shadow');
                quizBtn.innerHTML = `🔒 ยังไม่ปลดล็อก (เรียนแล้ว ${completedCount}/5 บท)`;
                quizBtn.setAttribute('aria-disabled', 'true');
            }
        }

        function completeLesson(lessonNum) {
            localStorage.setItem('lesson_' + lessonNum + '_visited', 'true');
            // อัปเดตหน้าจอทันทีหลังจากคลิก
            setTimeout(checkLessonStatus, 500);
        }

        // ตรวจสอบสถานะทันทีเมื่อโหลดหน้าเว็บ
        window.onload = function() {
            checkLessonStatus();
        };
    </script>
        <!-- Script สำหรับจัดการสถานะการเรียนและปลดล็อกแบบทดสอบ (แยกตามรายชื่อผู้ใช้) -->
    <script>
        // ดึงชื่อ User ปัจจุบันมาจาก PHP
        const currentUsername = "<?php echo $_SESSION['username']; ?>";

        function checkLessonStatus() {
            let completedCount = 0;
            for (let i = 1; i <= 5; i++) {
                // ผูกชื่อ User เข้ากับ Key ของ localStorage เพื่อแยกข้อมูลแต่ละคน
                if (localStorage.getItem(currentUsername + '_lesson_' + i + '_visited') === 'true') {
                    completedCount++;
                }
            }

            const quizBtn = document.getElementById('quiz-btn');
            const quizTitle = document.getElementById('quiz-title');
            const quizDesc = document.getElementById('quiz-desc');
            const quizCard = document.getElementById('quiz-card');
            const quizIconLock = document.getElementById('quiz-icon-lock');

            if (completedCount >= 5) {
                // ปลดล็อกเมื่อเรียนครบทุก 5 บท
                quizBtn.classList.remove('btn-secondary', 'disabled');
                quizBtn.classList.add('btn-success', 'shadow');
                quizBtn.innerHTML = '📝 เริ่มทำแบบทดสอบ (ปลดล็อกแล้ว)';
                quizBtn.removeAttribute('aria-disabled');
                
                quizTitle.classList.remove('text-secondary');
                quizTitle.classList.add('text-success');
                quizDesc.innerHTML = 'คุณเรียนครบทั้ง 5 บทเรียบร้อยแล้ว สามารถคลิกเพื่อทำแบบทดสอบได้เลย';
                quizIconLock.innerHTML = '<i class="bi bi-unlock-fill text-success"></i>';
                quizIconLock.style.opacity = '0.3';
            } else {
                // ยังเรียนไม่ครบ
                quizBtn.classList.add('btn-secondary', 'disabled');
                quizBtn.classList.remove('btn-success', 'shadow');
                quizBtn.innerHTML = `🔒 ยังไม่ปลดล็อก (เรียนแล้ว ${completedCount}/5 บท)`;
                quizBtn.setAttribute('aria-disabled', 'true');
                
                quizTitle.classList.remove('text-success');
                quizTitle.classList.add('text-secondary');
                quizDesc.innerHTML = 'กรุณาเรียนให้ครบทุกบทเรียน (บทที่ 1 - 5) จึงจะสามารถปลดล็อกทำแบบทดสอบได้';
                quizIconLock.innerHTML = '<i class="bi bi-lock-fill"></i>';
                quizIconLock.style.opacity = '1';
            }
        }

        function completeLesson(lessonNum) {
            // บันทึกสถานะแยกตามชื่อ User
            localStorage.setItem(currentUsername + '_lesson_' + lessonNum + '_visited', 'true');
            // อัปเดตหน้าจอทันทีหลังจากคลิก
            setTimeout(checkLessonStatus, 500);
        }

        // ตรวจสอบสถานะทันทีเมื่อโหลดหน้าเว็บ
        window.onload = function() {
            checkLessonStatus();
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
