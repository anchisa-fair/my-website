<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
if (file_exists('db_connect.php')) {
    include 'db_connect.php'; 
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บทที่ 3 - การประยุกต์ใช้งาน IoT 🌟 | IoT Learning Hub</title>
    
    <!-- Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts: 'Mitr' & 'Kanit' -->
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300;400;500;600&family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-gradient: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            --cyber-gradient: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #1e3a8a 100%);
            --accent-purple: #8b5cf6;
            --accent-cyan: #06b6d4;
            --accent-green: #10b981;
            --accent-yellow: #f59e0b;
            --accent-pink: #ec4899;
            --bg-light: #f8fafc;
        }

        /* 🌐 Enhanced Background with Ambient Glow & Tech Grid */
        body { 
            font-family: 'Mitr', 'Kanit', sans-serif; 
            background: 
                radial-gradient(circle at 10% 15%, rgba(59, 130, 246, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 90% 25%, rgba(139, 92, 246, 0.18) 0%, transparent 45%),
                radial-gradient(circle at 15% 75%, rgba(6, 182, 212, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 85% 85%, rgba(236, 72, 153, 0.12) 0%, transparent 45%),
                linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            background-attachment: fixed;
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow-x: hidden;
        }

        /* Tech Grid Overlay on Body */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: 
                radial-gradient(rgba(37, 99, 235, 0.12) 1.2px, transparent 1.2px),
                radial-gradient(rgba(139, 92, 246, 0.08) 1.2px, transparent 1.2px);
            background-size: 32px 32px;
            background-position: 0 0, 16px 16px;
            pointer-events: none;
            z-index: 0;
            opacity: 0.7;
        }

        /* 🖼️ Top Main Banner Style */
        .top-banner-wrapper {
            background-color: #0b1329;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
        .header-banner-img {
            max-height: 260px;
            object-fit: cover;
            object-position: center;
        }

        /* 🟢 Outer Floating Ambient Light Orbs */
        .bg-shape {
            position: fixed;
            border-radius: 50%;
            filter: blur(85px);
            z-index: 0;
            opacity: 0.45;
            pointer-events: none;
            animation: floatBg 12s ease-in-out infinite alternate;
        }
        .bg-shape-1 {
            width: 420px; height: 420px;
            background: #3b82f6;
            top: -100px; left: -100px;
        }
        .bg-shape-2 {
            width: 460px; height: 460px;
            background: #8b5cf6;
            top: 35%; right: -120px;
            animation-delay: -4s;
        }
        .bg-shape-3 {
            width: 400px; height: 400px;
            background: #06b6d4;
            bottom: -100px; left: -80px;
            animation-delay: -8s;
        }

        @keyframes floatBg {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(35px, -45px) scale(1.08); }
            100% { transform: translate(-25px, 35px) scale(0.95); }
        }

        /* 🟢 Scroll Reading Progress Bar */
        #progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, #2563eb, #06b6d4, #8b5cf6, #ec4899);
            width: 0%;
            z-index: 9999;
            transition: width 0.1s ease-out;
            box-shadow: 0 0 12px rgba(37, 99, 235, 0.6);
        }

        /* Navbar Style */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(16px);
            border-bottom: 2px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            z-index: 1000;
        }

        /* Card Master Glassmorphism */
        .main-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 2px solid #ffffff;
            border-radius: 32px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        /* Cyber Banner Box */
        .cyber-header-box {
            background: var(--cyber-gradient);
            border-radius: 24px;
            color: white;
            padding: 2.5rem 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.22);
        }

        .cyber-header-box::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.3) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Interactive Domain Cards */
        .domain-card {
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.03);
            overflow: hidden;
        }
        .domain-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 20px 35px rgba(37, 99, 235, 0.12);
            border-color: #93c5fd;
        }

        .domain-card img {
            height: 190px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .domain-card:hover img {
            transform: scale(1.06);
        }

        /* Badges & Pills */
        .badge-pill-custom {
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
        }

        /* Feature List Style */
        .feature-list li {
            position: relative;
            padding-left: 24px;
            margin-bottom: 8px;
        }
        .feature-list li::before {
            content: "✨";
            position: absolute;
            left: 0;
            top: 0;
        }

        /* Table Custom Styling */
        .table-custom-wrapper {
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        /* Buttons Style */
        .btn-playful {
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .btn-playful:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        /* Pulse Animation Button */
        .pulse-btn {
            animation: pulseGlow 2s infinite;
        }
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.6); }
            70% { box-shadow: 0 0 0 16px rgba(37, 99, 235, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0); }
        }

        /* Back To Top Button */
        #btn-back-to-top {
            position: fixed;
            bottom: 35px;
            right: 35px;
            display: none;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #2563eb;
            color: #fff;
            border: none;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
            z-index: 99;
            transition: all 0.3s ease;
        }
        #btn-back-to-top:hover {
            transform: scale(1.15) translateY(-3px);
            background: #1d4ed8;
        }
    </style>
</head>
<body>

    <!-- 🟢 Outer Screen Glowing Orbs -->
    <div class="bg-shape bg-shape-1"></div>
    <div class="bg-shape bg-shape-2"></div>
    <div class="bg-shape bg-shape-3"></div>

    <!-- 🟢 Reading Progress Bar -->
    <div id="progress-bar"></div>

    <!-- 🖼️ Top Main Banner (อยู่ด้านบน Navbar) -->
    <div class="top-banner-wrapper position-relative z-1 text-center">
        <a href="home.php">
            <img src="img/banner.png" alt="Internet of Things (IoT) Course & Principles" class="img-fluid w-100 header-banner-img">
        </a>
    </div>

    <!-- 🌐 Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center gap-2" href="home.php">
                <span class="fs-4">🌐</span>
                <span style="letter-spacing: -0.5px;">IoT Learning Hub</span>
            </a>
            
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <!-- ปุ่มดาวน์โหลดใบงาน -->
                <a href="assets/docs/worksheet_lesson3.pdf" download class="btn btn-outline-success btn-sm rounded-pill px-3 btn-playful">
                    <i class="bi bi-file-earmark-arrow-down-fill me-1"></i> ดาวน์โหลดใบงาน
                </a>

                <a href="home.php" class="btn btn-outline-primary btn-sm rounded-pill px-3 btn-playful">
                    <i class="bi bi-grid-fill me-1"></i> หน้ารวมบทเรียน
                </a>
                
                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill d-none d-md-inline-block">
                    👋 สวัสดี, <strong><?php echo htmlspecialchars($_SESSION['username'] ?? 'นักเรียน'); ?></strong>
                </span>
            </div>
        </div>
    </nav>

    <!-- 📦 Main Content Container -->
    <div class="container mt-4 mb-5 flex-grow-1 position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb bg-transparent p-0 small">
                        <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none text-primary"><i class="bi bi-house-door-fill me-1"></i>หน้าหลัก</a></li>
                        <li class="breadcrumb-item active" aria-current="page">บทที่ 3: การประยุกต์ใช้งาน IoT</li>
                    </ol>
                </nav>

                <!-- Main Glassmorphism Card -->
                <div class="main-card p-4 p-md-5 position-relative">

                    <!-- Header Cyber Banner Section -->
                    <div class="cyber-header-box mb-4 position-relative" style="z-index: 1;">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                            <span class="badge bg-primary text-white badge-pill-custom">
                                📖 บทเรียนที่ 3
                            </span>
                            <span class="badge text-white badge-pill-custom" style="background-color: var(--accent-purple);">
                                🚀 Applications & Real-World Use Cases
                            </span>
                        </div>
                        <h1 class="fw-bold text-white display-6 mb-2">
                            การประยุกต์ใช้งาน IoT (IoT Applications) 🌟
                        </h1>
                        <p class="text-light opacity-75 fs-6 mb-0 lh-lg">
                            ท่องโลกเทคโนโลยีเปลี่ยนอนาคต! วิเคราะห์กรณีศึกษา โครงสร้างเซนเซอร์ โปรโตคอล และการประยุกต์ใช้ IoT ในชีวิตจริงอย่างเห็นภาพ
                        </p>
                    </div>

                    <!-- 🎥 Video Section -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <div class="card border-0 rounded-4 overflow-hidden shadow-sm">
                            <div class="card-header bg-white border-bottom p-3 d-flex align-items-center gap-3">
                                <div class="bg-danger text-white rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="bi bi-play-fill fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-0">วิดีโอการเรียนรู้บทที่ 3 🎬</h5>
                                    <small class="text-muted">ชมตัวอย่างการนำ IoT ไปใช้งานในภาคส่วนต่างๆ ทั่วโลก</small>
                                </div>
                            </div>
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/VOV2j4N_U3o" title="IoT Applications Video" allowfullscreen></iframe>
                            </div>
                        </div>
                    </section>

                    <!-- 💡 Intro Concept Card -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <div class="p-4 rounded-4" style="background: linear-gradient(135deg, #eff6ff 0%, #e0e7ff 100%); border: 1px solid #bfdbfe;">
                            <h4 class="fw-bold text-primary mb-2 d-flex align-items-center gap-2">
                                <span class="fs-4">💡</span> IoT เปลี่ยนโลกอย่างไร?
                            </h4>
                            <p class="text-secondary mb-0 small lh-lg">
                                IoT ไม่ได้เป็นเพียงแค่ฮาร์ดแวร์หรือสายไฟ แต่มันคือระบบนิเวศการรับส่งข้อมูลแบบเรียลไทม์ (Real-time Ecosystem) ที่ช่วยให้อุปกรณ์รอบตัวเราสื่อสารกันเอง ตัดสินใจอัตโนมัติ และเชื่อมโลกกายภาพเข้ากับโลกดิจิทัลได้อย่างไร้รอยต่อ!
                            </p>
                        </div>
                    </section>

                    <!-- 🌐 6 Main IoT Domains -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                            <span class="fs-3">🌍</span> โดเมนการใช้งานหลักของ IoT (IoT Domains)
                        </h3>

                        <div class="row g-4">
                            
                            <!-- 1. Smart Home -->
                            <div class="col-md-6">
                                <div class="domain-card h-100 d-flex flex-column">
                                    <div class="overflow-hidden position-relative">
                                        <img src="https://images.unsplash.com/photo-1558002038-1055907df827?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" alt="Smart Home">
                                        <span class="position-absolute top-0 end-0 m-3 badge bg-primary badge-pill-custom">🏠 Smart Home</span>
                                    </div>
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-2">บ้านและอาคารอัจฉริยะ</h5>
                                        <p class="text-muted small mb-3">การรวมศูนย์ระบบควบคุมอาคารผ่านสถาปัตยกรรมไร้สายและการประมวลผลขอบ (Edge Computing) เพื่อความสะดวก ปลอดภัย และประหยัดพลังงาน</p>
                                        <ul class="list-unstyled small text-secondary mb-0 mt-auto feature-list">
                                            <li><strong>Home Automation:</strong> เชื่อมต่อ Zigbee, Z-Wave และ Matter สร้าง Mesh Network ร่วมกับ Local Gateway</li>
                                            <li><strong>Biometric Access:</strong> ปลดล็อกประตูด้วย Capacitive Fingerprint และ Edge AI จดจำใบหน้า</li>
                                            <li><strong>Safety Systems:</strong> เซนเซอร์ PIR, MQ Series ตรวจวัดแก๊สรั่ว พร้อมตัดไฟผ่าน Relay อัตโนมัติ</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Smart Farming -->
                            <div class="col-md-6">
                                <div class="domain-card h-100 d-flex flex-column">
                                    <div class="overflow-hidden position-relative">
                                        <img src="https://images.unsplash.com/photo-1586771107445-d3ca888129ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" alt="Smart Farming">
                                        <span class="position-absolute top-0 end-0 m-3 badge bg-success badge-pill-custom">🌱 Precision Farming</span>
                                    </div>
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-2">การเกษตรแม่นยำสูง</h5>
                                        <p class="text-muted small mb-3">ตรวจวัดปัจจัยสิ่งแวดล้อมด้วยเครือข่ายไร้สายระยะไกล (LoRaWAN) และโดรนสำรวจ เพื่อเพิ่มผลผลิตและลดการใช้สารเคมี</p>
                                        <ul class="list-unstyled small text-secondary mb-0 mt-auto feature-list">
                                            <li><strong>Soil Sensing:</strong> วัดค่า EC, ความชื้น VWC, pH และ NPK สื่อสารผ่าน RS485 Modbus RTU</li>
                                            <li><strong>Automated Fertigation:</strong> คำนวณปริมาณน้ำตามอัตราการระเหย (ET0) ควบคุมปั๊มและวาล์วปุ๋ยอัตโนมัติ</li>
                                            <li><strong>Aerial & Livestock:</strong> โดรนสำรวจดัชนีพืชพรรณ NDVI และแท็ก RFID/GPS ติดตามปศุสัตว์</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- 3. Industrial IoT (IIoT) -->
                            <div class="col-md-6">
                                <div class="domain-card h-100 d-flex flex-column">
                                    <div class="overflow-hidden position-relative">
                                        <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" alt="Industrial IoT">
                                        <span class="position-absolute top-0 end-0 m-3 badge bg-info text-dark badge-pill-custom">🏭 IIoT & Industry 4.0</span>
                                    </div>
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-2">โรงงานอัจฉริยะและระบบอุตสาหกรรม</h5>
                                        <p class="text-muted small mb-3">ยกระดับสายการผลิตด้วย IoT ทางอุตสาหกรรม การสื่อสารระดับเรียลไทม์ และระบบบำรุงรักษาเชิงพยากรณ์</p>
                                        <ul class="list-unstyled small text-secondary mb-0 mt-auto feature-list">
                                            <li><strong>Fieldbus to Cloud:</strong> เชื่อมต่อ PLC และเครื่องจักรผ่าน OPC UA และ Modbus TCP เข้า SCADA/ERP</li>
                                            <li><strong>Predictive Maintenance:</strong> ตรวจวัดแรงสั่นสะเทือนด้วย FFT เพื่อคาดการณ์ความเสียหายของมอเตอร์</li>
                                            <li><strong>Digital Twins & AGV:</strong> จำลองภาพเสมือนของโรงงาน ควบคู่หุ่นยนต์ขนส่งนำทางด้วย LiDAR บน Private 5G</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- 4. Healthcare -->
                            <div class="col-md-6">
                                <div class="domain-card h-100 d-flex flex-column">
                                    <div class="overflow-hidden position-relative">
                                        <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" alt="Healthcare IoMT">
                                        <span class="position-absolute top-0 end-0 m-3 badge bg-warning text-dark badge-pill-custom">⌚ IoMT & Wearables</span>
                                    </div>
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-2">การแพทย์และอุปกรณ์สวมใส่อัจฉริยะ</h5>
                                        <p class="text-muted small mb-3">โครงข่ายอุปกรณ์ตรวจวัดสัญญาณชีพขนาดเล็ก ติดตามสุขภาพทางไกล และระบบช่วยเหลือการแพทย์ฉุกเฉิน</p>
                                        <ul class="list-unstyled small text-secondary mb-0 mt-auto feature-list">
                                            <li><strong>Biomedical Sensing:</strong> ตรวจวัดค่า SpO2 ด้วย PPG และตรวจจับคลื่นไฟฟ้าหัวใจ (ECG) เช็กภาวะหัวใจเต้นผิดจังหวะ</li>
                                            <li><strong>Continuous Glucose (CGM):</strong> เข็มเซนเซอร์วัดระดับน้ำตาลส่งข้อมูลผ่าน BLE เข้ามือถือเรียลไทม์</li>
                                            <li><strong>Fall Detection:</strong> ใช้ IMU 6-Axis ตรวจจับการหกล้มของผู้สูงอายุและแจ้งเตือน SOS พิกัด GPS อัตโนมัติ</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- 5. Smart City -->
                            <div class="col-md-6">
                                <div class="domain-card h-100 d-flex flex-column">
                                    <div class="overflow-hidden position-relative">
                                        <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" alt="Smart City">
                                        <span class="position-absolute top-0 end-0 m-3 badge bg-secondary badge-pill-custom">🏙️ Smart City</span>
                                    </div>
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-2">เมืองอัจฉริยะและการขนส่ง</h5>
                                        <p class="text-muted small mb-3">โครงสร้างพื้นฐานเชื่อมโยงข้อมูลเมือง ระบบบริหารจราจร และห่วงโซ่อุปทานอัจฉริยะเพื่อยกระดับคุณภาพชีวิต</p>
                                        <ul class="list-unstyled small text-secondary mb-0 mt-auto feature-list">
                                            <li><strong>Adaptive Traffic:</strong> กล้อง AI ร่วมกับเซนเซอร์สนามแม่เหล็กปรับสัญญาณไฟจราจรตามความหนาแน่น</li>
                                            <li><strong>Environmental Sensing:</strong> สถานีตรวจวัด PM2.5 และเซนเซอร์ อัลตราโซนิกตรวจจับความจุถังขยะเมือง</li>
                                            <li><strong>Cold Chain Logistics:</strong> ติดตามตู้สินค้าด้วย GNSS ควบคุมอุณหภูมิขนส่งอาหารและเวชภัณฑ์</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- 6. Smart Grid -->
                            <div class="col-md-6">
                                <div class="domain-card h-100 d-flex flex-column">
                                    <div class="overflow-hidden position-relative">
                                        <img src="https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" alt="Smart Grid">
                                        <span class="position-absolute top-0 end-0 m-3 badge bg-danger badge-pill-custom">⚡ Smart Grid</span>
                                    </div>
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-2">โครงข่ายไฟฟ้าอัจฉริยะ</h5>
                                        <p class="text-muted small mb-3">สถาปัตยกรรมไฟฟ้าสองทาง (Two-way Power & Data Flow) ที่บริหารจัดการพลังงานสะอาดและกักเก็บพลังงานอัตโนมัติ</p>
                                        <ul class="list-unstyled small text-secondary mb-0 mt-auto feature-list">
                                            <li><strong>AMI Infrastructure:</strong> สมาร์ทมิเตอร์ส่งข้อมูลสองทาง คิดคำนวณอัตราค่าไฟตามช่วงเวลา (TOU)</li>
                                            <li><strong>DER Balancing:</strong> รักษาสมดุลพลังงานจากโซลาร์เซลล์ร่วมกับแบตเตอรี่กักเก็บพลังงาน (BESS)</li>
                                            <li><strong>V2G Tech:</strong> สถานีชาร์จ EV ดึงพลังงานจากรถยนต์กลับเข้าสู่ระบบไฟฟ้าในช่วงความต้องการสูง (Peak)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>

                    <!-- 🔥 Highlight Box: Edge AI + IoT -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <div class="p-4 p-md-5 rounded-4 text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e293b 0%, #312e81 100%);">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <span class="badge bg-warning text-dark badge-pill-custom mb-2">🚀 Hot Trend 2026</span>
                                    <h4 class="fw-bold text-warning mb-2">AIoT (Artificial Intelligence + IoT)</h4>
                                    <p class="small text-light opacity-75 mb-0 lh-lg">
                                        ปัจจุบัน IoT ไม่ใช่แค่การ "ส่งข้อมูล" ไปเก็บไว้บน Cloud อีกต่อไป แต่มีการใส่ประมวลผล <strong>Edge AI / Machine Learning</strong> ลงในบอร์ดขนาดเล็ก (เช่น ESP32-CAM หรือ Raspberry Pi) ทำให้เซนเซอร์สามารถคิดและตัดสินใจได้ทันทีที่อุปกรณ์ โดยไม่ต้องรอคำสั่งจากเซิร์ฟเวอร์!
                                    </p>
                                </div>
                                <div class="col-lg-4 text-center mt-3 mt-lg-0">
                                    <div class="p-3 bg-white bg-opacity-10 rounded-4 border border-white border-opacity-10">
                                        <i class="bi bi-cpu-fill text-info display-4 mb-2"></i>
                                        <div class="fw-bold text-white small">Edge Computing & Face Recognition</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 🎁 Benefits of IoT Section -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                            <span class="fs-3">🎁</span> ประโยชน์หลักของการประยุกต์ใช้ IoT
                        </h3>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="p-3 rounded-4 bg-light border h-100">
                                    <div class="fs-3 text-primary mb-2">⚡</div>
                                    <h6 class="fw-bold text-dark">1. เพิ่มประสิทธิภาพ</h6>
                                    <p class="small text-muted mb-0">ประมวลผลข้อมูลมหาศาลรวดเร็ว แม่นยำ และช่วยลดข้อผิดพลาดจากมนุษย์ (Human Error)</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded-4 bg-light border h-100">
                                    <div class="fs-3 text-success mb-2">🛋️</div>
                                    <h6 class="fw-bold text-dark">2. สะดวกสบาย</h6>
                                    <p class="small text-muted mb-0">ทำหน้าที่การทำงานประจำ (Routine) แทนมนุษย์ ปลดล็อกเวลาให้ไปสร้างสรรค์งานสำคัญ</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded-4 bg-light border h-100">
                                    <div class="fs-3 text-danger mb-2">💰</div>
                                    <h6 class="fw-bold text-dark">3. ลดต้นทุนยั่งยืน</h6>
                                    <p class="small text-muted mb-0">ลดค่าใช้จ่ายการดูแลรักษา ควบคุมกระบวนการแบบ Just-in-Time ลดของเสียและต้นทุนจม</p>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="p-3 rounded-4 bg-light border h-100">
                                    <div class="fs-3 text-warning mb-2">📲</div>
                                    <h6 class="fw-bold text-dark">4. ไร้ข้อจำกัดเวลาและสถานที่</h6>
                                    <p class="small text-muted mb-0">สามารถติดตามผล ควบคุมอุปกรณ์ และตรวจเช็กสถานะการทำงานได้ตลอด 24 ชั่วโมงผ่านมือถือ</p>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="p-3 rounded-4 bg-light border h-100">
                                    <div class="fs-3 text-purple mb-2" style="color: var(--accent-purple);">🏢</div>
                                    <h6 class="fw-bold text-dark">5. พลิกโฉมองค์กรยุคใหม่</h6>
                                    <p class="small text-muted mb-0">ยกระดับธุรกิจไปสู่ Smart Business / Smart Factory สร้างผลประกอบการและจุดเด่นเหนือนวัตกรรมคู่แข่ง</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 📶 Comparison Table -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                            <span class="fs-3">📡</span> เปรียบเทียบเทคโนโลยีไร้สายใน IoT
                        </h3>
                        
                        <div class="table-custom-wrapper shadow-sm">
                            <table class="table table-hover align-middle mb-0 text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="py-3 text-start ps-4">เทคโนโลยี (Technology) 🛰️</th>
                                        <th class="py-3">ระยะสื่อสาร</th>
                                        <th class="py-3">ความเร็วรับส่ง</th>
                                        <th class="py-3">พลังงาน</th>
                                        <th class="py-3 text-start">กรณีศึกษา (Use Case)</th>
                                    </tr>
                                </thead>
                                <tbody class="small">
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-primary">BLE (Bluetooth Low Energy)</td>
                                        <td>10 - 100 ม.</td>
                                        <td>1 - 2 Mbps</td>
                                        <td><span class="badge bg-success bg-opacity-10 text-success">ต่ำมาก 🔋</span></td>
                                        <td class="text-start">Smart Key, Smart Watch, Health Sensor</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-primary">Zigbee / Z-Wave</td>
                                        <td>10 - 100 ม. (Mesh)</td>
                                        <td>250 kbps</td>
                                        <td><span class="badge bg-success bg-opacity-10 text-success">ต่ำมาก 🔋</span></td>
                                        <td class="text-start">สวิตช์ไฟอัจฉริยะ, เซนเซอร์ประตู Smart Home</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-primary">Wi-Fi (802.11 b/g/n/ax)</td>
                                        <td>30 - 100 ม.</td>
                                        <td>สูง (1+ Gbps)</td>
                                        <td><span class="badge bg-danger bg-opacity-10 text-danger">สูง 🪫</span></td>
                                        <td class="text-start">กล้องวงจรปิด IP Camera, Video Streaming</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-primary">LoRaWAN</td>
                                        <td>2 - 15 กม.</td>
                                        <td>0.3 - 50 kbps</td>
                                        <td><span class="badge bg-success bg-opacity-10 text-success">ต่ำมาก 🔋</span></td>
                                        <td class="text-start">ฟาร์มเกษตรแปลงใหญ่, สมาร์ตมิเตอร์น้ำในเมือง</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-primary">NB-IoT / LTE-M</td>
                                        <td>10 - 15 กม. (Cellular)</td>
                                        <td>20 - 250 kbps</td>
                                        <td><span class="badge bg-info bg-opacity-10 text-info">ต่ำ ⚡</span></td>
                                        <td class="text-start">ติดตามตู้คอนเทนเนอร์, วัดมลพิษในเขตเมือง</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-primary">5G Cellular Network</td>
                                        <td>ครอบคลุมกว้างขวาง</td>
                                        <td>สูงมาก (Up to 10 Gbps)</td>
                                        <td><span class="badge bg-warning bg-opacity-10 text-dark">ปานกลาง-สูง</span></td>
                                        <td class="text-start">หุ่นยนต์ AGV ไร้คนขับ, การผ่าตัดทางไกล</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <!-- 📝 Quiz & Action Box -->
                    <section class="mt-5 position-relative" style="z-index: 1;">
                        <div class="card border-0 rounded-4 text-white shadow-lg overflow-hidden" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);">
                            <div class="card-body p-4 p-md-5 text-center">
                                <h3 class="fw-bold mb-3">🎉 เรียนรู้บทที่ 3 ครบถ้วนแล้ว!</h3>
                                <p class="mb-4 text-white-50 small lh-lg px-md-5">
                                    มาร่วมวัดระดับความเข้าใจเกี่ยวกับการประยุกต์ใช้ IoT เพื่อรับคะแนนสะสมกันเลยครับ!
                                </p>
                                
                                <a href="https://docs.google.com/forms/d/e/1FAIpQLSc9orpxkZsK36jRL5P6zygwTgtQqdytghDyPBLuN6u2-lrLVQ/viewform?usp=publish-editor" 
                                   target="_blank" 
                                   class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary btn-playful pulse-btn">
                                   📝 ทำแบบทดสอบบทที่ 3
                                </a>
                            </div>
                        </div>
                    </section>

                    <!-- Navigation Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-5 position-relative" style="z-index: 1;">
                        <a href="lesson2.php" class="btn btn-outline-secondary rounded-pill px-4 btn-playful">
                            <i class="bi bi-arrow-left me-1"></i> ย้อนกลับบทที่ 2
                        </a>
                        <a href="home.php" class="btn btn-primary rounded-pill px-4 btn-playful">
                            หน้ารวมบทเรียน <i class="bi bi-grid-fill ms-1"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Back To Top Button -->
    <button id="btn-back-to-top" title="กลับขึ้นด้านบน">
        <i class="bi bi-arrow-up fs-5"></i>
    </button>

    <!-- 🦶 ดึง Footer Component จากไฟล์ footer.php -->
    <?php 
    if (file_exists('footer.php')) {
        include 'footer.php'; 
    } else {
    ?>
    <footer class="bg-dark text-white-50 py-4 border-top border-secondary mt-auto">
        <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center small gap-3">
            <div>
                <a href="home.php" class="text-white text-decoration-none fw-semibold">🌐 IoT Learning Hub</a>
            </div>
            <div>
                &copy; 2026 IoT E-Learning System. All rights reserved.
            </div>
        </div>
    </footer>
    <?php } ?>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript สำหรับ Interactive Elements -->
    <script>
        // 1. แถบ Scroll Progress Bar
        window.onscroll = function() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("progress-bar").style.width = scrolled + "%";

            // แสดง/ซ่อน ปุ่ม Back to top
            let backToTopBtn = document.getElementById("btn-back-to-top");
            if (winScroll > 300) {
                backToTopBtn.style.display = "block";
            } else {
                backToTopBtn.style.display = "none";
            }
        };

        // 2. ปุ่ม Back to Top (Smooth Scroll)
        document.getElementById("btn-back-to-top").addEventListener("click", function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>
