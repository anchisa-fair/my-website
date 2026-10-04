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
    <title>บทที่ 4 - ความมั่นคงปลอดภัยและการปกป้องข้อมูลในระบบ IoT 🛡️ | IoT Learning Hub</title>
    
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts: 'Mitr' & 'Kanit' -->
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300;400;500;600&family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-gradient: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            --cyber-gradient: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #311042 100%);
            --accent-pink: #ec4899;
            --accent-yellow: #f59e0b;
            --accent-green: #10b981;
            --accent-cyan: #06b6d4;
            --accent-purple: #8b5cf6;
            --accent-red: #ef4444;
            --bg-light: #f8fafc;
        }

        body { 
            font-family: 'Mitr', 'Kanit', sans-serif; 
            background: radial-gradient(circle at 10% 10%, rgba(239, 68, 68, 0.08) 0%, transparent 40%),
                        radial-gradient(circle at 90% 80%, rgba(139, 92, 246, 0.12) 0%, transparent 45%),
                        linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            background-attachment: fixed;
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        /* 🔴 Reading Progress Bar */
        #progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, #ef4444, #f59e0b, #ec4899, #8b5cf6, #06b6d4);
            width: 0%;
            z-index: 9999;
            transition: width 0.1s ease-out;
            box-shadow: 0 0 12px rgba(239, 68, 68, 0.6);
        }

        /* Navbar Style */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(16px);
            border-bottom: 2px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            z-index: 1000;
        }

        /* Main Card Container Modern Glassmorphism */
        .main-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 2px solid #ffffff;
            border-radius: 32px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.07);
            position: relative;
            overflow: hidden;
        }

        /* Animated Blobs */
        .floating-blob {
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            filter: blur(70px);
            z-index: 0;
            opacity: 0.35;
            animation: floatAnim 10s ease-in-out infinite alternate;
        }
        .blob-1 { background: #fca5a5; top: -60px; right: -50px; }
        .blob-2 { background: #c084fc; bottom: 80px; left: -60px; animation-delay: -5s; }
        .blob-3 { background: #67e8f9; top: 40%; right: -80px; animation-delay: -2s; }

        @keyframes floatAnim {
            0% { transform: translateY(0px) rotate(0deg) scale(1); }
            100% { transform: translateY(-40px) rotate(15deg) scale(1.1); }
        }

        /* Cyber Banner Box */
        .cyber-header-box {
            background: var(--cyber-gradient);
            border-radius: 24px;
            color: white;
            padding: 2.5rem 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.25);
        }

        .cyber-header-box::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 80% 20%, rgba(236, 72, 153, 0.25) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Interactive Domain Cards */
        .security-card {
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.03);
            overflow: hidden;
        }
        .security-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 20px 35px rgba(239, 68, 68, 0.12);
            border-color: #fca5a5;
        }

        .security-card img {
            height: 190px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .security-card:hover img {
            transform: scale(1.07);
        }

        /* Feature List Style */
        .feature-list li {
            position: relative;
            padding-left: 28px;
            margin-bottom: 10px;
        }
        .feature-list li::before {
            content: "🛡️";
            position: absolute;
            left: 0;
            top: 0;
            font-size: 0.9rem;
        }

        /* Badges & Pills */
        .badge-pill-custom {
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
        }

        /* CIA Triad Cards */
        .cia-card {
            border-radius: 20px;
            padding: 24px;
            background: #ffffff;
            border: 2px solid #f1f5f9;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0,0,0,0.04);
        }
        .cia-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(37, 99, 235, 0.1);
        }

        /* Table Custom Styling */
        .table-custom-wrapper {
            border-radius: 22px;
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
            0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.6); }
            70% { box-shadow: 0 0 0 16px rgba(239, 68, 68, 0); }
            100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
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
            background: #ef4444;
            color: #fff;
            border: none;
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
            z-index: 99;
            transition: all 0.3s ease;
        }
        #btn-back-to-top:hover {
            transform: scale(1.15) translateY(-3px);
            background: #dc2626;
        }
    </style>
</head>
<body>

    <!-- 🔴 Scroll Reading Progress Bar -->
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
                        <li class="breadcrumb-item active" aria-current="page">บทที่ 4: ความมั่นคงปลอดภัยในระบบ IoT</li>
                    </ol>
                </nav>

                <!-- Main Glassmorphism Card -->
                <div class="main-card p-4 p-md-5 position-relative">
                    <div class="floating-blob blob-1"></div>
                    <div class="floating-blob blob-2"></div>
                    <div class="floating-blob blob-3"></div>

                    <!-- Cyber Banner Header -->
                    <div class="cyber-header-box mb-4 position-relative" style="z-index: 1;">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                            <span class="badge bg-danger text-white badge-pill-custom">
                                📖 บทเรียนที่ 4
                            </span>
                            <span class="badge text-white badge-pill-custom" style="background-color: var(--accent-purple);">
                                🔒 Security, Privacy & Protection
                            </span>
                        </div>
                        <h1 class="fw-bold text-white display-6 mb-2">
                            ความมั่นคงปลอดภัยและการปกป้องข้อมูลในระบบ IoT 🔐
                        </h1>
                        <p class="text-light opacity-75 fs-6 mb-0 lh-lg">
                            เจาะลึกภัยคุกคามทางไซเบอร์ กลไกการเข้ารหัสข้อมูล (SSL/TLS) สถาปัตยกรรมแบบ Zero Trust และความรับผิดชอบตามกฎหมายคุ้มครองข้อมูลส่วนบุคคล (PDPA)
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
                                    <h5 class="fw-bold text-dark mb-0">วิดีโอการเรียนรู้บทที่ 4 🎬</h5>
                                    <small class="text-muted">เรียนรู้ความสำคัญของ IoT Security และวิธีป้องกันภัยคุกคามรอบตัว</small>
                                </div>
                            </div>
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/IsWdxAx8cxo" title="IoT Security Video" allowfullscreen></iframe>
                            </div>
                        </div>
                    </section>

                    <!-- 🛡️ Intro Definition Card -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <div class="p-4 rounded-4" style="background: linear-gradient(135deg, #fef2f2 0%, #ffe4e6 100%); border: 1px solid #fecdd3;">
                            <h4 class="fw-bold text-danger mb-2 d-flex align-items-center gap-2">
                                <span class="fs-4">🛡️</span> ความมั่นคงปลอดภัยในระบบ IoT คืออะไร?
                            </h4>
                            <p class="text-secondary mb-0 small lh-lg">
                                <strong>ความปลอดภัยของ IoT (IoT Security)</strong> คือ แขนงสำคัญของ Cybersecurity ที่มุ่งเน้นการปกป้อง ตรวจสอบ และแก้ไขภัยคุกคามบนอุปกรณ์เชื่อมต่ออินเทอร์เน็ต ครอบคลุมตั้งแต่เซนเซอร์ บอร์ดไมโครคอนโทรลเลอร์ (ESP32/Arduino) กล้องวงจรปิด กลอนประตูอัจฉริยะ ไปจนถึงระบบควบคุมในโรงงานอุตสาหกรรม โดยมีเป้าหมายเพื่อป้องกันไม่ให้แฮกเกอร์ลักลอบเข้าถึงข้อมูล ดักฟัง หรือใช้บอร์ดเป็นฐานการโจมตี
                            </p>
                        </div>
                    </section>

                    <!-- 📐 Section: CIA Triad in IoT -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                            <span class="fs-3">🔺</span> สามเหลี่ยมความปลอดภัย (CIA Triad ใน IoT)
                        </h3>
                        <p class="text-muted small mb-4">
                            การออกแบบระบบ IoT ที่มั่นคงปลอดภัยต้องยึดหลักสำคัญ 3 ประการ ได้แก่:
                        </p>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="cia-card h-100 border-start border-primary border-4">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <i class="bi bi-eye-slash-fill fs-3 text-primary"></i>
                                        <h5 class="fw-bold text-primary mb-0">1. Confidentiality</h5>
                                    </div>
                                    <h6 class="fw-bold text-dark small mb-2">การรักษาความลับข้อมูล</h6>
                                    <p class="text-muted small mb-0">
                                        รับประกันว่าข้อมูลเซนเซอร์ กล้อง หรือรหัสผ่าน จะถูกอ่านโดยผู้ที่มีสิทธิ์เท่านั้น ผ่านการเข้ารหัส (Encryption) เช่น MQTTS หรือ TLS
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="cia-card h-100 border-start border-success border-4">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <i class="bi bi-shield-check fs-3 text-success"></i>
                                        <h5 class="fw-bold text-success mb-0">2. Integrity</h5>
                                    </div>
                                    <h6 class="fw-bold text-dark small mb-2">ความถูกต้องสมบูรณ์</h6>
                                    <p class="text-muted small mb-0">
                                        ป้องกันไม่ให้ข้อมูลถูกแอบแก้ไขหรือปลอมแปลงระหว่างทาง เช่น การดักแก้ไขคำสั่งเปิด-ปิดประตู โดยใช้ Digital Signature และ HMAC
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="cia-card h-100 border-start border-warning border-4">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <i class="bi bi-cpu-fill fs-3 text-warning"></i>
                                        <h5 class="fw-bold text-warning-emphasis mb-0">3. Availability</h5>
                                    </div>
                                    <h6 class="fw-bold text-dark small mb-2">ความพร้อมใช้งาน</h6>
                                    <p class="text-muted small mb-0">
                                        ระบบและอุปกรณ์ IoT ต้องทำงานได้ต่อเนื่อง ไม่ล่มเมื่อถูกโจมตีแบบ DDoS หรือถูกป่วนสัญญาณไร้สาย (Jamming)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 💡 Why IoT Security Matters -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                            <span class="fs-3">💡</span> เหตุใดความปลอดภัยของ IoT จึงมีความสำคัญยิ่ง?
                        </h3>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                                    <div class="fs-2 text-primary mb-2">🚀</div>
                                    <h6 class="fw-bold text-primary mb-2">เติบโตอย่างก้าวกระโดด</h6>
                                    <p class="text-muted small mb-0">อุปกรณ์ IoT มีจำนวนแซงหน้าคอมพิวเตอร์ คิดเป็นกว่า <strong>54%</strong> ของอุปกรณ์เชื่อมต่อทั้งหมด และคาดว่าจะพุ่งสูงเกิน <strong>30 พันล้านเครื่อง</strong> ทั่วโลก!</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                                    <div class="fs-2 text-warning mb-2">🏠</div>
                                    <h6 class="fw-bold text-warning-emphasis mb-2">ปัจจัยการทำงานทางไกล</h6>
                                    <p class="text-muted small mb-0">การทำงานแบบ Remote Work ทำให้ผู้ใช้เข้าถึงระบบองค์กรผ่าน Smart Home ซึ่งไร้มาตรการป้องกันที่เข้มงวด กลายเป็นเป้าหมายของแฮกเกอร์</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                                    <div class="fs-2 text-danger mb-2">⚠️</div>
                                    <h6 class="fw-bold text-danger mb-2">ประตูสู่เครือข่ายหลัก</h6>
                                    <p class="text-muted small mb-0">อุปกรณ์ IoT ที่มีช่องโหว่ถูกใช้เป็น <strong>Gateway / Pivot Point</strong> ให้แฮกเกอร์แทรกซึมเข้าขโมยข้อมูลสำคัญในเครือข่ายองค์กร</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 💥 Real World Attack Case Studies -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                            <span class="fs-3">💥</span> กรณีศึกษาการโจมตีในโลกจริง (Real Attack Cases)
                        </h3>

                        <div class="row g-4">
                            <!-- Case 1: Mirai Botnet -->
                            <div class="col-lg-6">
                                <div class="p-4 rounded-4 text-white h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #111827 0%, #881337 100%);">
                                    <span class="badge bg-danger text-white badge-pill-custom mb-2">DDoS Attack</span>
                                    <h4 class="fw-bold text-warning mb-2"><i class="bi bi-robot me-2"></i>Mirai Botnet (2016)</h4>
                                    <p class="small text-light opacity-85 mb-0 lh-lg">
                                        แฮกเกอร์เจาะระบบกล้อง CCTV และเราเตอร์ตามบ้านที่ไม่ได้เปลี่ยนรหัสผ่านเริ่มต้น (Default Password) ยึดอุปกรณ์นับล้านเครื่องมาสร้างเป็น <strong>Botnet Army</strong> ยิง DDoS ถล่ม DNS Provider จนเว็บยักษ์ใหญ่ระดับโลกอย่าง Twitter, Netflix, Spotify ล่มทั้งทวีป!
                                    </p>
                                </div>
                            </div>

                            <!-- Case 2: Jeep Hack -->
                            <div class="col-lg-6">
                                <div class="p-4 rounded-4 text-white h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
                                    <span class="badge bg-cyan text-dark bg-info badge-pill-custom mb-2">Automotive Attack</span>
                                    <h4 class="fw-bold text-cyan mb-2" style="color: #38bdf8;"><i class="bi bi-car-front-fill me-2"></i>Jeep Cherokee Hack (2015)</h4>
                                    <p class="small text-light opacity-85 mb-0 lh-lg">
                                        นักวิจัยความปลอดภัยเจาะระบบ Smart Entertainment ผ่านเครือข่ายไร้สาย และสามารถส่งคำสั่งไปควบคุมระบบเบรกและพวงมาลัยของรถยนต์ขณะวิ่งบนทางหลวงได้จากระยะไกล ส่งผลให้บริษัทต้องเรียกคืนรถยนต์กว่า 1.4 ล้านคัน!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 🧱 4 Main Security Topics -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                            <span class="fs-3">🧱</span> 4 เสาหลักความปลอดภัย IoT (Core Pillars)
                        </h3>

                        <div class="row g-4">
                            <!-- Topic 1 -->
                            <div class="col-md-6">
                                <div class="security-card h-100 d-flex flex-column">
                                    <div class="overflow-hidden position-relative">
                                        <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" alt="Vulnerabilities">
                                        <span class="position-absolute top-0 end-0 m-3 badge bg-danger badge-pill-custom">⚠️ Threat Analysis</span>
                                    </div>
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-2">ภัยคุกคามทางไซเบอร์ในระบบ IoT (Cyber Threats)</h5>
                                        <p class="text-muted small mb-3">อุปกรณ์ IoT มักถูกออกแบบมาเน้นความสะดวกและราคาถูก จนข้ามมาตรฐานความปลอดภัยที่รัดกุม</p>
                                        <ul class="list-unstyled small text-secondary mb-0 mt-auto feature-list">
                                            <li><strong>Default Passwords:</strong> ไม่เปลี่ยนรหัสผ่านเริ่มต้นจากโรงงาน (เช่น admin/admin) ทำให้สุ่มเจาะง่าย</li>
                                            <li><strong>Botnet Infection:</strong> ถูกฝังมัลแวร์ควบคุมเพื่อนำไปใช้ยิง DDoS Attack ขนาดใหญ่</li>
                                            <li><strong>Unencrypted Comms:</strong> ส่งข้อมูลแบบ Cleartext ทำให้ถูกดักฟังข้อมูล (Eavesdropping) ได้ทันที</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Topic 2 -->
                            <div class="col-md-6">
                                <div class="security-card h-100 d-flex flex-column">
                                    <div class="overflow-hidden position-relative">
                                        <img src="https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" alt="Best Practices">
                                        <span class="position-absolute top-0 end-0 m-3 badge bg-success badge-pill-custom">🔐 Encryption & SSL/TLS</span>
                                    </div>
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-2">การเข้ารหัสและการใช้งาน SSL/TLS</h5>
                                        <p class="text-muted small mb-3">หลักปฏิบัติพื้นฐานเพื่อรับประกันว่าฮาร์ดแวร์และซอฟต์แวร์จะรับส่งข้อมูลได้อย่างปลอดภัย</p>
                                        <ul class="list-unstyled small text-secondary mb-0 mt-auto feature-list">
                                            <li><strong>SSL/TLS Protocols:</strong> เข้ารหัสการเชื่อมต่อระหว่าง Edge Device กับ Cloud Server</li>
                                            <li><strong>OTA Firmware Updates:</strong> อัปเดตแพตช์ซอฟต์แวร์ผ่านอากาศอย่างปลอดภัยเพื่อปิดช่องโหว่</li>
                                            <li><strong>Strong Authentication:</strong> ใช้ Digital Certificate (X.509) ร่วมกับการยืนยันตัวตนแบบหลายปัจจัย (MFA)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Topic 3 -->
                            <div class="col-md-6">
                                <div class="security-card h-100 d-flex flex-column">
                                    <div class="overflow-hidden position-relative">
                                        <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" alt="Privacy & PDPA">
                                        <span class="position-absolute top-0 end-0 m-3 badge bg-warning text-dark badge-pill-custom">📜 กฎหมาย PDPA กับ IoT</span>
                                    </div>
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-2">ความเป็นส่วนตัวของข้อมูลและกฎหมาย PDPA</h5>
                                        <p class="text-muted small mb-3">อุปกรณ์ IoT บันทึกพฤติกรรมผู้ใช้งานตลอดเวลา จึงต้องมีการคุ้มครองข้อมูลส่วนบุคคลตามกฎหมายอย่างเคร่งครัด</p>
                                        <ul class="list-unstyled small text-secondary mb-0 mt-auto feature-list">
                                            <li><strong>Consent Management:</strong> ต้องขอความยินยอมจากผู้ใช้ก่อนจัดเก็บข้อมูลส่วนบุคคล</li>
                                            <li><strong>Data Anonymization:</strong> แปลงข้อมูลให้อยู่ในรูปแบบที่ไม่สามารถระบุตัวตนได้</li>
                                            <li><strong>Right to be Forgotten:</strong> ผู้ใช้มีสิทธิ์ร้องขอให้ลบหรือทำลายข้อมูลของตนเอง</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Topic 4 -->
                            <div class="col-md-6">
                                <div class="security-card h-100 d-flex flex-column">
                                    <div class="overflow-hidden position-relative">
                                        <img src="https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" alt="Zero Trust">
                                        <span class="position-absolute top-0 end-0 m-3 badge bg-info text-dark badge-pill-custom">🛡️ Zero Trust Architecture</span>
                                    </div>
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-2">สถาปัตยกรรม Zero Trust ในระบบ IoT</h5>
                                        <p class="text-muted small mb-3">ยึดหลัก "ไม่ไว้วางใจใคร ตรวจสอบเสมอ" (Never Trust, Always Verify) ทั้งภายในและภายนอกเครือข่าย</p>
                                        <ul class="list-unstyled small text-secondary mb-0 mt-auto feature-list">
                                            <li><strong>Micro-segmentation:</strong> แยกเครือข่ายอุปกรณ์ IoT ออกจากโครงสร้างเครือข่ายหลัก</li>
                                            <li><strong>Least Privilege Access:</strong> กำหนดสิทธิ์การเข้าถึงทรัพยากรเท่าที่จำเป็นเท่านั้น</li>
                                            <li><strong>Continuous Monitoring:</strong> ตรวจสอบพฤติกรรมผิดปกติและการเชื่อมต่อแบบเรียลไทม์</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 📊 Comparison Table Section -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                            <span class="fs-3">📊</span> เปรียบเทียบโปรโตคอลการสื่อสารที่ปลอดภัย (Secure Protocols)
                        </h3>
                        
                        <div class="table-custom-wrapper shadow-sm">
                            <table class="table table-hover align-middle mb-0 text-center">
                                <thead class="table-danger">
                                    <tr>
                                        <th class="py-3 text-start ps-4">โปรโตคอลดั้งเดิม ⚠️️</th>
                                        <th class="py-3">โปรโตคอลปลอดภัย 🔒</th>
                                        <th class="py-3">กลไกการเข้ารหัส</th>
                                        <th class="py-3 text-start">ระดับความคุ้มครอง 🛡️</th>
                                    </tr>
                                </thead>
                                <tbody class="small">
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-danger">HTTP</td>
                                        <td class="fw-bold text-success">HTTPS</td>
                                        <td>TLS / SSL (Port 443)</td>
                                        <td class="text-start">เข้ารหัสเว็บและ REST API สมบูรณ์</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-danger">MQTT</td>
                                        <td class="fw-bold text-success">MQTTS</td>
                                        <td>TLS / SSL (Port 8883)</td>
                                        <td class="text-start">เข้ารหัสการ Publish/Subscribe ป้องกันดักฟัง</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-danger">CoAP</td>
                                        <td class="fw-bold text-success">CoAPS</td>
                                        <td>DTLS over UDP</td>
                                        <td class="text-start">เข้ารหัสสำหรับอุปกรณ์จิ๋วประหยัดพลังงาน</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <!-- ✨ [NEW SECTION] IoT Security Best Practices & Checklist -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <div class="p-4 p-md-5 rounded-4 bg-white border shadow-sm">
                            <h3 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                                <span class="fs-3">🌟</span> แนวปฏิบัติที่ดีที่สุดในการรักษาความปลอดภัย IoT (Best Practices)
                            </h3>
                            <p class="text-muted small mb-4">
                                แนวทางปฏิบัติสำหรับนักพัฒนาและผู้ใช้งานในการป้องกันอุปกรณ์ IoT จากความเสี่ยงรอบด้าน:
                            </p>

                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded-3 h-100 border">
                                        <h6 class="fw-bold text-primary mb-2"><i class="bi bi-key-fill me-1"></i> 1. เปลี่ยนรหัสผ่านทันที</h6>
                                        <p class="text-muted small mb-0">ห้ามใช้รหัสผ่านเริ่มต้นจากโรงงาน (Default Credentials) เด็ดขาด ควรกำหนดรหัสผ่านที่ซับซ้อนและคาดเดายาก</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded-3 h-100 border">
                                        <h6 class="fw-bold text-success mb-2"><i class="bi bi-router-fill me-1"></i> 2. แยกวงแลน (Guest/IoT Network)</h6>
                                        <p class="text-muted small mb-0">ควรแยกเครือข่าย Wi-Fi สำหรับอุปกรณ์ IoT ออกจากเครือข่ายหลักที่ใช้เก็บข้อมูลสำคัญ เพื่อป้องกันหากอุปกรณ์ถูกเจาะ</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded-3 h-100 border">
                                        <h6 class="fw-bold text-warning-emphasis mb-2"><i class="bi bi-arrow-repeat me-1"></i> 3. อัปเดตเฟิร์มแวร์สม่ำเสมอ</h6>
                                        <p class="text-muted small mb-0">ตรวจสอบและอัปเดต Patch ความปลอดภัยและ Firmware ของบอร์ดหรือเซนเซอร์อยู่เสมอเพื่อปิดช่องโหว่ใหม่ๆ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 📝 Quiz & Action Box -->
                    <section class="mt-5 position-relative" style="z-index: 1;">
                        <div class="card border-0 rounded-4 text-white shadow-lg overflow-hidden" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);">
                            <div class="card-body p-4 p-md-5 text-center">
                                <h3 class="fw-bold mb-3">🎉 เรียนรู้บทที่ 4 ครบถ้วนแล้ว!</h3>
                                <p class="mb-4 text-white-50 small lh-lg px-md-5">
                                    พร้อมทดสอบความรู้เกี่ยวกับความมั่นคงปลอดภัยและการปกป้องข้อมูลในระบบ IoT หรือยัง? คลิกทำแบบทดสอบกันเลย!
                                </p>
                                
                                <a href="https://docs.google.com/forms/d/e/1FAIpQLSe_eCQ0kk47HTv4hTPpvLOD_etLPn9xK0pwOH4zAXgRSyK5xA/viewform?usp=publish-editor" 
                                   target="_blank" 
                                   class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary btn-playful pulse-btn">
                                   📝 ทำแบบทดสอบบทที่ 4
                                </a>
                            </div>
                        </div>
                    </section>

                    <!-- Navigation Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-5 position-relative" style="z-index: 1;">
                        <a href="lesson3.php" class="btn btn-outline-secondary rounded-pill px-4 btn-playful">
                            <i class="bi bi-arrow-left me-1"></i> ย้อนกลับบทที่ 3
                        </a>
                        <a href="lesson5.php" class="btn btn-primary rounded-pill px-4 btn-playful">
                            บทเรียนถัดไป (บทที่ 5) <i class="bi bi-arrow-right ms-1"></i>
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
