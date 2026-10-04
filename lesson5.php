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
    <title>บทที่ 5 - องค์ประกอบเชิงลึกของระบบ IoT 🧩 | IoT Learning Hub</title>
    
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
            --accent-orange: #f97316;
            --accent-pink: #ec4899;
            --bg-light: #f8fafc;
        }

        body { 
            font-family: 'Mitr', 'Kanit', sans-serif; 
            background: radial-gradient(circle at 15% 15%, rgba(59, 130, 246, 0.08) 0%, transparent 40%),
                        radial-gradient(circle at 85% 75%, rgba(139, 92, 246, 0.12) 0%, transparent 45%),
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

        /* 🔵 Reading Progress Bar */
        #progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, #2563eb, #06b6d4, #10b981, #f59e0b, #ec4899);
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
            filter: blur(75px);
            z-index: 0;
            opacity: 0.35;
            animation: floatAnim 10s ease-in-out infinite alternate;
        }
        .blob-1 { background: #93c5fd; top: -60px; right: -50px; }
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
            background: radial-gradient(circle at 80% 20%, rgba(6, 182, 212, 0.25) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Interactive Element Cards */
        .element-card {
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.03);
            overflow: hidden;
        }
        .element-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 20px 35px rgba(37, 99, 235, 0.12);
            border-color: #93c5fd;
        }

        /* Learning Objectives Box */
        .obj-box {
            background: linear-gradient(135deg, #eff6ff 0%, #e0f2fe 100%);
            border: 2px dashed #93c5fd;
            border-radius: 24px;
            padding: 1.8rem;
        }

        /* Badges & Pills */
        .badge-pill-custom {
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
        }

        /* Architecture Layer Card */
        .arch-layer-card {
            border-radius: 20px;
            padding: 24px;
            background: #ffffff;
            border: 2px solid #f1f5f9;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0,0,0,0.04);
        }
        .arch-layer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(37, 99, 235, 0.1);
        }

        /* Pipeline Box */
        .pipeline-card {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            border-radius: 24px;
            padding: 2rem;
            color: white;
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }

        .pipeline-step {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            padding: 14px 10px;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .pipeline-step:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: scale(1.03);
        }

        /* Code Pills */
        code {
            color: #d97706;
            background-color: #fef3c7;
            padding: 0.25rem 0.5rem;
            border-radius: 8px;
            font-size: 0.88em;
            font-family: monospace;
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

    <!-- 🔵 Scroll Reading Progress Bar -->
    <div id="progress-bar"></div>

    <!-- 🖼️ Top Main Banner -->
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
                    👋 สวัสดี, <strong><?php echo htmlspecialchars($_SESSION['username'] ?? 'นักเรียน IoT'); ?></strong>
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
                        <li class="breadcrumb-item active" aria-current="page">บทที่ 5: องค์ประกอบเชิงลึกของระบบ IoT</li>
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
                            <span class="badge bg-primary text-white badge-pill-custom">
                                📖 บทเรียนที่ 5
                            </span>
                            <span class="badge text-white badge-pill-custom" style="background-color: var(--accent-cyan);">
                                🧩 Architecture & Data Pipeline
                            </span>
                        </div>
                        <h1 class="fw-bold text-white display-6 mb-2">
                            องค์ประกอบเชิงลึกของระบบ IoT ⚙️
                        </h1>
                        <p class="text-light opacity-75 fs-6 mb-0 lh-lg">
                            เจาะลึกสถาปัตยกรรมระบบแบบ 4 ชั้น (4-Layer Architecture) กลไกฮาร์ดแวร์และการแปลงสัญญาณ ADC เทคโนโลยี Edge AI โปรโตคอลการสื่อสารระดับเครือข่าย และท่อส่งข้อมูล (Data Pipeline) แบบครบวงจร
                        </p>
                    </div>

                    <!-- 🎥 Video Section -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <div class="card border-0 rounded-4 overflow-hidden shadow-sm">
                            <div class="card-header bg-white border-bottom p-3 d-flex align-items-center gap-3">
                                <div class="bg-primary text-white rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="bi bi-play-fill fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-0">วิดีโอการเรียนรู้บทที่ 5 🎬</h5>
                                    <small class="text-muted">เจาะลึกโครงสร้างระบบ IoT และการเดินทางของข้อมูลตั้งแต่ฮาร์ดแวร์ถึงคลาวด์</small>
                                </div>
                            </div>
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/6mBO2vqLv38" title="IoT Architecture & Deep Dive Video" allowfullscreen></iframe>
                            </div>
                        </div>
                    </section>

                    <!-- 🎯 Learning Objectives Box -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <div class="obj-box">
                            <h5 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                                <span class="fs-4">🎯</span> วัตถุประสงค์การเรียนรู้เชิงวิชาการ
                            </h5>
                            <ul class="mb-0 small lh-lg text-secondary">
                                <li>วิเคราะห์และจำแนกสถาปัตยกรรมระบบอินเทอร์เน็ตของสรรพสิ่ง (IoT Architecture) ออกเป็น 4 ชั้นหลักได้อย่างถูกต้อง</li>
                                <li>เข้าใจหลักการทำงานของฮาร์ดแวร์ฝั่ง Perception Layer รวมถึงกระบวนการแปลงสัญญาณแอนาลอกเป็นดิจิทัลด้วย ADC และการควบคุมผ่าน Actuator</li>
                                <li>เปรียบเทียบข้อดี-ข้อจำกัดของโปรโตคอลการสื่อสาร (MQTT, HTTP, CoAP) และเทคโนโลยีเครือข่ายไร้สาย (Wi-Fi, BLE, LoRaWAN, NB-IoT)</li>
                                <li>ประยุกต์ใช้แนวคิด Edge AI ร่วมกับระบบคลาวด์และ Web Application เพื่อสร้างท่อส่งข้อมูล (Data Pipeline) และการแจ้งเตือนอัตโนมัติ</li>
                            </ul>
                        </div>
                    </section>

                    <!-- 🏗️ Section 5.1: IoT Architecture -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <span class="fs-3">🏗️</span> 5.1 โครงสร้างสถาปัตยกรรมระบบ IoT (IoT Architecture)
                        </h3>
                        <p class="text-muted small lh-lg mb-4">
                            ระบบ Internet of Things (IoT) ไม่ใช่เพียงแค่อุปกรณ์เดี่ยวๆ ที่เชื่อมต่ออินเทอร์เน็ต แต่เป็นสถาปัตยกรรมระบบแบบกระจาย (Distributed Heterogeneous System) ที่ผสมผสานสหวิทยาการ ทั้งวิศวกรรมฮาร์ดแวร์ เครือข่ายโทรคมนาคม วิทยาศาสตร์ข้อมูล และการพัฒนาซอฟต์แวร์ เพื่อให้ระบบมีความเสถียร (Reliability) สามารถขยายขนาดได้ (Scalability) และมีความปลอดภัยสูง โดยโครงสร้างมาตรฐานนิยมแบ่งออกเป็น 4 ชั้นหลัก ดังนี้:
                        </p>

                        <!-- 4-Layer Architectural Breakdown Cards -->
                        <div class="row g-3">
                            <div class="col-md-6 col-lg-3">
                                <div class="arch-layer-card h-100 border-start border-primary border-4">
                                    <div class="fs-2 text-primary mb-2">👁️</div>
                                    <h6 class="fw-bold text-primary mb-1">1. Perception Layer</h6>
                                    <small class="text-muted d-block mb-2">ชั้นรับรู้และรับข้อมูล</small>
                                    <p class="text-secondary small mb-0">ประกอบด้วยเซนเซอร์ ทรานส์ดิวเซอร์ วงจร ADC และบอร์ดไมโครคอนโทรลเลอร์ (เช่น ESP32) ทำหน้าที่เก็บข้อมูลทางกายภาพ</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="arch-layer-card h-100 border-start border-success border-4">
                                    <div class="fs-2 text-success mb-2">📡</div>
                                    <h6 class="fw-bold text-success mb-1">2. Network Layer</h6>
                                    <small class="text-muted d-block mb-2">ชั้นการสื่อสารเครือข่าย</small>
                                    <p class="text-secondary small mb-0">ช่องทางการส่งผ่านข้อมูลไร้สาย เช่น Wi-Fi, BLE, LoRaWAN, 5G และ Network Gateway ส่งต่อไปยังระบบคลาวด์</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="arch-layer-card h-100 border-start border-warning border-4">
                                    <div class="fs-2 text-warning mb-2">⚙️</div>
                                    <h6 class="fw-bold text-warning-emphasis mb-1">3. Middleware / Processing</h6>
                                    <small class="text-muted d-block mb-2">ชั้นประมวลผลข้อมูล</small>
                                    <p class="text-secondary small mb-0">พื้นที่ประมวลผลข้อมูลทั้ง Edge AI, Cloud Computing, ระบบฐานข้อมูล (MySQL/Firebase) และการวิเคราะห์ข้อมูลเชิงลึก</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="arch-layer-card h-100 border-start border-danger border-4">
                                    <div class="fs-2 text-danger mb-2">📱</div>
                                    <h6 class="fw-bold text-danger mb-1">4. Application Layer</h6>
                                    <small class="text-muted d-block mb-2">ชั้นการประยุกต์ใช้งาน</small>
                                    <p class="text-secondary small mb-0">ส่วนติดต่อผู้ใช้งาน (Dashboard), แอปพลิเคชันบนมือถือ, การควบคุม Actuators และระบบแจ้งเตือนภัยผ่าน LINE API</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 🔬 Section 5.2: Deep Dive into 4 Core Components -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                            <span class="fs-3">🔬</span> 5.2 เจาะลึกองค์ประกอบหลัก 4 ส่วนของระบบ IoT
                        </h3>

                        <div class="row g-4">
                            <!-- Core Component 1 -->
                            <div class="col-md-6">
                                <div class="element-card h-100 p-4 d-flex flex-column">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="bg-primary text-white rounded-4 p-3 d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                                            <i class="bi bi-cpu-fill fs-3"></i>
                                        </div>
                                        <div>
                                            <span class="badge bg-primary text-white rounded-pill px-3 py-1">ส่วนที่ 1</span>
                                            <h5 class="fw-bold text-dark mb-0 mt-1">Smart Devices & Edge Hardware</h5>
                                        </div>
                                    </div>
                                    <p class="text-muted small mb-3">อุปกรณ์อัจฉริยะที่ทำหน้าที่เชื่อมต่อกับสภาพแวดล้อมทางกายภาพโดยตรง มีองค์ประกอบย่อยดังนี้:</p>
                                    
                                    <ul class="list-unstyled small text-secondary mb-0 flex-grow-1">
                                        <li class="mb-2">
                                            <strong>🌡️ Transducers & Sensors:</strong> อุปกรณ์แปลงปริมาณทางกายภาพ (เช่น อุณหภูมิ ความชื้น แสง แรงกด) ให้เป็นสัญญาณไฟฟ้า เช่น เซนเซอร์ <code>DHT22</code> วัดค่าความชื้นและอุณหภูมิ โดยอาศัยวงจร <strong>ADC (Analog-to-Digital Converter)</strong> แปลงสัญญาณต่อเนื่องให้เป็นรหัสตัวเลขดิจิทัลที่ไมโครคอนโทรลเลอร์เข้าใจได้
                                        </li>
                                        <li class="mb-2">
                                            <strong>⚡ Actuators:</strong> อุปกรณ์แปลงสัญญาณไฟฟ้ากลับเป็นพลังงานเชิงกลหรือความร้อน เช่น <strong>Relay Module</strong> ทำหน้าที่เป็นสวิตช์อิเล็กทรอนิกส์ควบคุมเครื่องใช้ไฟฟ้ากระแสสลับ (AC 220V) หรือ <strong>Servo Motor</strong> สำหรับขับเคลื่อนกลไก
                                        </li>
                                        <li>
                                            <strong>💻 Microcontroller Unit (MCU):</strong> หน่วยประมวลผลกลาง เช่น บอร์ด <strong>ESP32</strong> มีคุณสมบัติเด่นคือหน่วยประมวลผลแบบ Dual-Core, มี Wi-Fi และ Bluetooth ในตัว รองรับการประมวลผลร่วมกับโมดูลกล้อง (ESP32-CAM)
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Core Component 2 -->
                            <div class="col-md-6">
                                <div class="element-card h-100 p-4 d-flex flex-column">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="bg-success text-white rounded-4 p-3 d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                                            <i class="bi bi-diagram-3-fill fs-3"></i>
                                        </div>
                                        <div>
                                            <span class="badge bg-success text-white rounded-pill px-3 py-1">ส่วนที่ 2</span>
                                            <h5 class="fw-bold text-dark mb-0 mt-1">Connectivity & Protocols</h5>
                                        </div>
                                    </div>
                                    <p class="text-muted small mb-3">กลไกการรับส่งข้อมูลผ่านเครือข่าย ซึ่งต้องอาศัยทั้งระดับชั้นกายภาพและโปรโตคอลการสื่อสาร:</p>
                                    
                                    <div class="bg-light p-3 rounded-3 mb-2 border">
                                        <h6 class="fw-bold text-dark small mb-1">📶 Network Layer Technologies</h6>
                                        <ul class="mb-0 small text-secondary ps-3">
                                            <li><b>Wi-Fi (802.11 b/g/n/ac):</b> ส่งข้อมูลความเร็วสูง เหมาะกับงานสตรีมมิ่งภาพและวิดีโอ</li>
                                            <li><b>Bluetooth LE (BLE):</b> อัตราการกินไฟต่ำมาก เหมาะกับอุปกรณ์สวมใส่ (Wearables)</li>
                                            <li><b>LoRaWAN / NB-IoT:</b> เครือข่ายระยะไกล (LPWAN) ครอบคลุมพื้นที่กว้าง เหมาะกับงานเกษตรอัจฉริยะ</li>
                                        </ul>
                                    </div>

                                    <div class="bg-light p-3 rounded-3 border">
                                        <h6 class="fw-bold text-dark small mb-1">✉️ Application Messaging Protocols</h6>
                                        <ul class="mb-0 small text-secondary ps-3">
                                            <li><b>MQTT:</b> โปรโตคอลแบบ Publish/Subscribe ที่มีน้ำหนักเบา เหมาะกับอุปกรณ์ทรัพยากรน้อย</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Core Component 3 -->
                            <div class="col-md-6">
                                <div class="element-card h-100 p-4 d-flex flex-column">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="bg-warning text-dark rounded-4 p-3 d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                                            <i class="bi bi-cloud-haze2-fill fs-3"></i>
                                        </div>
                                        <div>
                                            <span class="badge bg-warning text-dark rounded-pill px-3 py-1">ส่วนที่ 3</span>
                                            <h5 class="fw-bold text-dark mb-0 mt-1">Data Processing: Edge & Cloud</h5>
                                        </div>
                                    </div>
                                    <p class="text-muted small mb-3">การบริหารจัดการและวิเคราะห์ข้อมูลในระบบ IoT สมัยใหม่มักใช้งานร่วมกันแบบไฮบริด:</p>
                                    
                                    <ul class="list-unstyled small text-secondary mb-0 flex-grow-1">
                                        <li class="mb-3">
                                            <strong>🧠 Edge Computing & Edge AI:</strong> การประมวลผลข้อมูลณ จุดเกิดเหตุบนตัวอุปกรณ์ (เช่น การใช้ ESP32-CAM รันโมเดลตรวจจับใบหน้าหรือวัตถุเบื้องต้น) ช่วยลดความหน่วง (Low Latency) และเพิ่มความปลอดภัยของข้อมูลส่วนบุคคล
                                        </li>
                                        <li>
                                            <strong>☁️ Cloud Computing & Big Data:</strong> ศูนย์กลางจัดเก็บและประมวลผลข้อมูลขนาดใหญ่ เช่น ระบบฐานข้อมูลคลาวด์ (Firebase Realtime Database, AWS IoT Core หรือ MySQL) เพื่อทำหน้าที่วิเคราะห์เชิงลึกและเก็บบันทึกประวัติย้อนหลัง
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Core Component 4 -->
                            <div class="col-md-6">
                                <div class="element-card h-100 p-4 d-flex flex-column">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="bg-danger text-white rounded-4 p-3 d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                                            <i class="bi bi-display-fill fs-3"></i>
                                        </div>
                                        <div>
                                            <span class="badge bg-danger text-white rounded-pill px-3 py-1">ส่วนที่ 4</span>
                                            <h5 class="fw-bold text-dark mb-0 mt-1">UI & Application Integration</h5>
                                        </div>
                                    </div>
                                    <p class="text-muted small mb-3">การนำเสนอผลลัพธ์และการเชื่อมโยงระบบเข้ากับแพลตฟอร์มภายนอกเพื่อให้เกิดประโยชน์สูงสุด:</p>
                                    
                                    <ul class="list-unstyled small text-secondary mb-0 flex-grow-1">
                                        <li class="mb-3">
                                            <strong>📊 Web & Mobile Dashboards:</strong> พัฒนาส่วนแสดงผลด้วย HTML5, Bootstrap และ JavaScript (เช่น Chart.js) เพื่อแสดงกราฟสถานะเซนเซอร์แบบเรียลไทม์
                                        </li>
                                        <li>
                                            <strong>💬 Notification API Services:</strong> การเชื่อมต่อ Webhook เข้ากับแพลตฟอร์มการสื่อสาร เช่น <strong>LINE Notify API</strong> เพื่อส่งข้อความแจ้งเตือนเหตุการณ์ฉุกเฉินหรือภาพถ่ายจากกล้องตรงสู่สมาร์ทโฟนของผู้ใช้งานทันที
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 💻 Section 5.3: โค้ดตัวอย่างและการเชื่อมต่อระบบ IoT (Sample Code & API Integration) -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <span class="fs-3">💻</span> 5.3 ตัวอย่างการเขียนโปรแกรมและการเชื่อมต่อระบบ (Code & Implementation)
                        </h3>
                        <p class="text-muted small lh-lg mb-4">
                            เพื่อให้เห็นภาพการทำงานจริงของ Data Pipeline ในบทที่ 5 นี้ ขอยกตัวอย่างโครงสร้างโค้ดอย่างง่ายสำหรับบอร์ด <code>ESP32</code> ที่ทำหน้าที่อ่านค่าจากเซนเซอร์ และส่งข้อมูลผ่านโปรโตคอล HTTP/MQTT ไปยังเซิร์ฟเวอร์ พร้อมจำลองการแจ้งเตือนผ่าน LINE Notify API
                        </p>

                        <!-- Code Tabs / Cards -->
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="card border-0 shadow-sm rounded-4 h-100">
                                    <div class="card-header bg-dark text-white py-3 px-4 d-flex justify-content-between align-items-center rounded-top-4">
                                        <span class="small font-monospace"><i class="bi bi-file-earmark-code text-warning me-2"></i>esp32_sensor_sender.ino</span>
                                        <span class="badge bg-primary">ESP32 Firmware</span>
                                    </div>
                                    <div class="card-body bg-light rounded-bottom-4 p-3">
                                        <pre class="small text-dark mb-0" style="overflow-x: auto;"><code class="bg-transparent text-dark p-0">#include &lt;WiFi.h&gt;
#include &lt;HTTPClient.h&gt;

const char* ssid = "YOUR_WIFI_SSID";
const char* password = "YOUR_WIFI_PASSWORD";
const char* serverUrl = "https://yourdomain.com/api/save_sensor.php";

void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print(".");
  }
  Serial.println("\nWiFi Connected!");
}

void loop() {
  // จำลองการอ่านค่าจาก Sensor (Perception Layer)
  float temperature = random(20, 40) + 0.5;
  
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(serverUrl);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    
    String httpRequestData = "temp=" + String(temperature);
    int httpResponseCode = http.POST(httpRequestData);
    
    if (httpResponseCode > 0) {
      Serial.println("Data sent successfully: " + String(httpResponseCode));
    } else {
      Serial.println("Error on sending: " + String(httpResponseCode));
    }
    http.end();
  }
  delay(10000); // ส่งข้อมูลทุกๆ 10 วินาที
}</code></pre>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card border-0 shadow-sm rounded-4 h-100">
                                    <div class="card-header bg-dark text-white py-3 px-4 d-flex justify-content-between align-items-center rounded-top-4">
                                        <span class="small font-monospace"><i class="bi bi-file-earmark-code text-success me-2"></i>save_sensor.php</span>
                                        <span class="badge bg-success">Backend Server</span>
                                    </div>
                                    <div class="card-body bg-light rounded-bottom-4 p-3">
                                        <pre class="small text-dark mb-0" style="overflow-x: auto;"><code class="bg-transparent text-dark p-0">&lt;?php
// รับค่าอุณหภูมิที่ส่งมาจาก ESP32 ผ่าน POST Method
if (isset($_POST['temp'])) {
    $temperature = htmlspecialchars($_POST['temp']);
    
    // เชื่อมต่อฐานข้อมูล (Database Layer)
    include 'db_connect.php';
    
    $sql = "INSERT INTO sensor_logs (temperature, recorded_at) VALUES ('$temperature', NOW())";
    if ($conn->query($sql) === TRUE) {
        // เงื่อนไขแจ้งเตือนฉุกเฉินผ่าน LINE Notify API
        if ($temperature > 35.0) {
            sendLineNotify("⚠️ แจ้งเตือน! อุณหภูมิสูงเกินกำหนด: " . $temperature . " °C");
        }
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "&lt;br&gt;" . $conn->error;
    }
}

function sendLineNotify($message) {
    $token = "YOUR_LINE_NOTIFY_TOKEN";
    $queryData = array('message' => $message);
    $queryData = http_build_query($queryData);
    
    $headerOptions = array(
        'http' => array(
            'method' => 'POST',
            'header' => "Authorization: Bearer " . $token . "\r\n" .
                        "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => $queryData
        )
    );
    $context = stream_context_create($headerOptions);
    @file_get_contents("https://notify-api.line.me/api/notify", false, $context);
}
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 🛡️ Section 5.4: ความปลอดภัยและความท้าทายในระบบ IoT -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <span class="fs-3">🛡️</span> 5.4 ความปลอดภัยและความท้าทายในระบบ IoT (IoT Security & Challenges)
                        </h3>
                        <p class="text-muted small lh-lg mb-4">
                            เนื่องจากระบบ IoT มีการเชื่อมโยงข้อมูลจากโลกกายภาพสู่อินเทอร์เน็ต ความปลอดภัยจึงเป็นหัวใจสำคัญที่นักพัฒนาต้องคำนึงถึง เพื่อป้องกันการโจมตีทางไซเบอร์และความเสียหายที่อาจเกิดขึ้น:
                        </p>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="p-4 rounded-4 bg-white border shadow-sm h-100">
                                    <div class="fs-3 text-danger mb-2">🔒</div>
                                    <h6 class="fw-bold text-dark mb-1">1. Device Authentication</h6>
                                    <p class="text-secondary small mb-0">อุปกรณ์ทุกตัวที่เชื่อมต่อเข้าสู่ระบบเครือข่ายต้องผ่านการยืนยันตัวตนอย่างแน่นหนา (เช่น ใช้ Token หรือ TLS/SSL Certificate) เพื่อป้องกันอุปกรณ์ปลอมแปลงเข้ามาส่งข้อมูลขยะ</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-4 rounded-4 bg-white border shadow-sm h-100">
                                    <div class="fs-3 text-warning mb-2">📦</div>
                                    <h6 class="fw-bold text-dark mb-1">2. Data Encryption</h6>
                                    <p class="text-secondary small mb-0">ข้อมูลที่รับส่งระหว่างบอร์ดไมโครคอนโทรลเลอร์กับเซิร์ฟเวอร์คลาวด์ควรได้รับการเข้ารหัส (เช่น ผ่านโปรโตคอล HTTPS หรือ MQTTS) เพื่อป้องกันการดักฟังข้อมูลกลางทาง (Man-in-the-Middle Attack)</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-4 rounded-4 bg-white border shadow-sm h-100">
                                    <div class="fs-3 text-success mb-2">⚡</div>
                                    <h6 class="fw-bold text-dark mb-1">3. Power & Resource Limits</h6>
                                    <p class="text-secondary small mb-0">ข้อจำกัดด้านพลังงานและหน่วยความจำของฮาร์ดแวร์ริมขอบ (Edge Hardware) ทำให้การออกแบบระบบความปลอดภัยต้องมีน้ำหนักเบาและไม่กินทรัพยากรสูงจนเกินไป</p>
                                </div>
                            </div>
                        </div>
                    </section>


                    <!-- ⚡ Data Flow Pipeline Interactive Box -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <div class="pipeline-card">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="fs-2">⚡</span>
                                <div>
                                    <h4 class="fw-bold text-warning mb-0">กระบวนการไหลของข้อมูล (IoT Data Flow Pipeline)</h4>
                                    <small class="text-white-50">แสดงลำดับขั้นตอนการเดินทางของข้อมูลตั้งแต่จุดกำเนิดทางกายภาพจนถึงหน้าจอผู้ใช้</small>
                                </div>
                            </div>

                            <div class="row g-3 text-center small mt-2">
                                <div class="col-6 col-md-3">
                                    <div class="pipeline-step">
                                        <div class="fs-4 text-cyan mb-1" style="color: var(--accent-cyan);">🌡️ 1. Sensing</div>
                                        <div class="fw-bold">Sensor (Analog)</div>
                                        <small class="text-white-50 fs-xs">วัดค่าทางกายภาพ</small>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="pipeline-step">
                                        <div class="fs-4 text-warning mb-1">💻 2. Digitalization</div>
                                        <div class="fw-bold">ADC / MCU</div>
                                        <small class="text-white-50 fs-xs">แปลงเป็นสัญญาณดิจิทัล</small>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="pipeline-step">
                                        <div class="fs-4 text-purple mb-1" style="color: var(--accent-purple);">🧠 3. Edge AI</div>
                                        <div class="fw-bold">Edge Processing</div>
                                        <small class="text-white-50 fs-xs">คัดกรองข้อมูลเบื้องต้น</small>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="pipeline-step">
                                        <div class="fs-4 text-success mb-1">📡 4. Transport</div>
                                        <div class="fw-bold">MQTT / HTTP</div>
                                        <small class="text-white-50 fs-xs">ส่งผ่านเครือข่ายอินเทอร์เน็ต</small>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="pipeline-step">
                                        <div class="fs-4 text-info mb-1">☁️ 5. Cloud Storage</div>
                                        <div class="fw-bold">Database Server</div>
                                        <small class="text-white-50 fs-xs">จัดเก็บบน MySQL/Firebase</small>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="pipeline-step">
                                        <div class="fs-4 text-pink mb-1" style="color: var(--accent-pink);">💬 6. API Trigger</div>
                                        <div class="fw-bold">LINE Notify API</div>
                                        <small class="text-white-50 fs-xs">ส่งแจ้งเตือนเข้ามือถือ</small>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="pipeline-step">
                                        <div class="fs-4 text-danger mb-1">📱 7. Visualization</div>
                                        <div class="fw-bold">End User Dashboard</div>
                                        <small class="text-white-50 fs-xs">แสดงผลผ่าน Web / App</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 📊 Comparison Table Section -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                            <span class="fs-3">📊</span> เปรียบเทียบเทคโนโลยีเครือข่ายสื่อสารในระบบ IoT
                        </h3>
                        
                        <div class="table-custom-wrapper shadow-sm">
                            <table class="table table-hover align-middle mb-0 text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="py-3 text-start ps-4">เทคโนโลยี 📡</th>
                                        <th class="py-3">ระยะทางการส่ง</th>
                                        <th class="py-3">Bandwidth</th>
                                        <th class="py-3">การบริโภคพลังงาน</th>
                                        <th class="py-3 text-start">ตัวอย่างงานที่เหมาะสม 💡</th>
                                    </tr>
                                </thead>
                                <tbody class="small">
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-primary">Wi-Fi (IEEE 802.11)</td>
                                        <td>30 - 100 เมตร</td>
                                        <td>สูงมาก (ถึง 600 Mbps)</td>
                                        <td><span class="badge bg-danger">สูง</span></td>
                                        <td class="text-start">กล้อง ESP32-CAM, ระบบ Smart Home ภายในอาคาร</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-primary">Bluetooth LE (BLE)</td>
                                        <td>10 - 50 เมตร</td>
                                        <td>ปานกลาง (1-2 Mbps)</td>
                                        <td><span class="badge bg-success">ต่ำมาก</span></td>
                                        <td class="text-start">อุปกรณ์สุขภาพ Wearables, Beacons ตรวจระยะประชิด</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-primary">LoRaWAN</td>
                                        <td>5 - 15 กิโลเมตร</td>
                                        <td>ต่ำ (0.3-50 kbps)</td>
                                        <td><span class="badge bg-success">ต่ำมาก (แบต 5-10 ปี)</span></td>
                                        <td class="text-start">สมาร์ทฟาร์มมิ่ง เกษตรกรรมแม่นยำ มิเตอร์น้ำอัจฉริยะ</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-primary">NB-IoT (Cellular)</td>
                                        <td>10 - 20 กิโลเมตร</td>
                                        <td>ปานกลาง (ถึง 250 kbps)</td>
                                        <td><span class="badge bg-success">ต่ำ</span></td>
                                        <td class="text-start">ระบบติดตามพัสดุ Logistics, Smart City ในเมืองใหญ่</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <!-- 📝 Quiz & Action Box -->
                    <section class="mt-5 position-relative" style="z-index: 1;">
                        <div class="card border-0 rounded-4 text-white shadow-lg overflow-hidden" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);">
                            <div class="card-body p-4 p-md-5 text-center">
                                <h3 class="fw-bold mb-3">🎉 เรียนรู้บทที่ 5 ครบถ้วนแล้ว!</h3>
                                <p class="mb-4 text-white-50 small lh-lg px-md-5">
                                    พร้อมทดสอบความรู้ความเข้าใจเกี่ยวกับองค์ประกอบเชิงลึกและสถาปัตยกรรมระบบ IoT หรือยัง? คลิกทำแบบทดสอบกันเลย!
                                </p>
                                
                                <a href="https://docs.google.com/forms/d/e/1FAIpQLSe_eCQ0kk47HTv4hTPpvLOD_etLPn9xK0pwOH4zAXgRSyK5xA/viewform?usp=publish-editor" 
                                   target="_blank" 
                                   class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary btn-playful pulse-btn">
                                   📝 ทำแบบทดสอบบทที่ 5
                                </a>
                            </div>
                        </div>
                    </section>

                    <!-- Navigation Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-5 position-relative" style="z-index: 1;">
                        <a href="lesson4.php" class="btn btn-outline-secondary rounded-pill px-4 btn-playful">
                            <i class="bi bi-arrow-left me-1"></i> ย้อนกลับบทที่ 4
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

    <!-- 🦶 Footer Component -->
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
