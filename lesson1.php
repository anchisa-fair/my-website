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
    <title>บทที่ 1 - ความรู้เบื้องต้นเกี่ยวกับ IoT 🤖✨</title>
    
    <!-- Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Google Fonts: 'Mitr' & 'Kanit' -->
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300;400;500;600&family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-soft: #eef2ff;
            --accent-pink: #ec4899;
            --accent-yellow: #f59e0b;
            --accent-green: #10b981;
            --accent-cyan: #06b6d4;
            --bg-light: #f8fafc;
        }

        body { 
            font-family: 'Mitr', 'Kanit', sans-serif; 
            background: radial-gradient(circle at 10% 20%, rgba(224, 231, 255, 0.6) 0%, rgba(243, 232, 255, 0.5) 90%), 
                        linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            background-attachment: fixed;
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* 🟢 1. Top Banner ด้านบนสุดแบบบทที่ 3 */
        .top-banner-container {
            width: 100%;
            overflow: hidden;
            background-color: #0f172a;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }
        .top-banner-img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            object-position: center;
            display: block;
        }
        @media (max-width: 768px) {
            .top-banner-img {
                height: 160px;
            }
        }

        /* 🟢 2. Scroll Reading Progress Bar */
        #progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, #4f46e5, #ec4899, #06b6d4);
            width: 0%;
            z-index: 9999;
            transition: width 0.1s ease-out;
            box-shadow: 0 0 10px rgba(236, 72, 153, 0.5);
        }

        /* Navbar ดีไซน์มินิมอล มีสไตล์ */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 2px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        }

        /* การ์ดเนื้อหาหลักแบบ Glass & Soft Shadow */
        .main-card {
            background: #ffffff;
            border: 2px solid #f1f5f9;
            border-radius: 28px;
            box-shadow: 0 15px 35px rgba(79, 70, 229, 0.06);
            position: relative;
            overflow: hidden;
        }

        /* Floating Blob Animation ลอยดุ๊กดิ๊ก */
        .floating-blob {
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            filter: blur(50px);
            z-index: 0;
            opacity: 0.45;
            animation: floatAnim 6s ease-in-out infinite alternate;
        }
        .blob-1 { background: #818cf8; top: -30px; right: -30px; }
        .blob-2 { background: #f472b6; bottom: 100px; left: -30px; animation-delay: -3s; }

        @keyframes floatAnim {
            0% { transform: translateY(0px) scale(1); }
            100% { transform: translateY(-25px) scale(1.08); }
        }

        /* การ์ดคุณลักษณะเด่น (Fun Features) */
        .feature-card {
            border: none;
            border-radius: 20px;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.03);
            position: relative;
        }
        .feature-card:hover {
            transform: translateY(-10px) rotate(1deg);
            box-shadow: 0 20px 30px rgba(79, 70, 229, 0.12);
        }

        /* การ์ดประวัติความเป็นมา */
        .history-card {
            border-radius: 20px;
            padding: 24px;
            transition: all 0.3s ease;
            position: relative;
            background: #ffffff;
        }
        .history-card:hover {
            transform: scale(1.025);
            box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        }
        .history-card-yellow {
            border: 2px dashed #f59e0b;
            background: #fffbe6;
        }
        .history-card-green {
            border: 2px dashed #10b981;
            background: #ecfdf5;
        }

        /* การ์ด Edge AI */
        .edge-ai-card {
            background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
            border: 2px solid #c7d2fe;
            border-radius: 24px;
            position: relative;
            overflow: hidden;
        }

        /* Interactive Simulator Box (ชุดทดลอง IoT) */
        .sim-box {
            background: #ffffff;
            border: 2px solid #cbd5e1;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.04);
        }
        .led-indicator {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: inline-block;
            background-color: #cbd5e1;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        .led-active {
            background-color: #10b981;
            box-shadow: 0 0 15px #10b981, inset 0 1px 2px #ffffff;
        }

        /* สไตล์ Accordion */
        .accordion-button:not(.collapsed) {
            background-color: var(--primary-soft);
            color: var(--primary-color);
            box-shadow: none;
        }
        .accordion-item {
            border-radius: 16px !important;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            margin-bottom: 12px;
            transition: all 0.2s ease;
        }
        .accordion-item:hover {
            border-color: #c7d2fe;
        }
        .accordion-button {
            border-radius: 16px !important;
            font-weight: 500;
        }

        /* สไตล์ Callout สดใส */
        .info-callout {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-left: 6px solid var(--accent-cyan);
            border-radius: 16px;
            padding: 20px;
        }

        /* ปุ่มกดสไตล์ป๊อปอัพ */
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

        /* Pulse Animation สำหรับปุ่มทำแบบทดสอบ */
        .pulse-btn {
            animation: pulseGlow 2s infinite;
        }
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(255, 255, 255, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); }
        }

        /* Badge น่ารักๆ */
        .badge-pill-custom {
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        /* Flow Step Box */
        .flow-step {
            background: #ffffff;
            border-radius: 16px;
            padding: 12px 18px;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(0,0,0,0.04);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        .flow-step:hover {
            transform: translateY(-4px);
            border-color: #818cf8;
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.1);
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
            background: #4f46e5;
            color: #fff;
            border: none;
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
            z-index: 99;
            transition: all 0.3s ease;
        }
        #btn-back-to-top:hover {
            transform: scale(1.15) translateY(-3px);
            background: #4338ca;
        }
    </style>
</head>
<body>

    <!-- 🟢 Progress Bar แสดงการอ่าน -->
    <div id="progress-bar"></div>

    <!-- 🟢 1. Header Banner -->
    <div class="top-banner-container">
        <img src="img/banner.png" alt="Internet of Things Banner" class="top-banner-img">
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center gap-2" href="home.php">
                <span class="fs-4">🌐</span>
                <span style="letter-spacing: -0.5px;">IoT Learning Hub</span>
            </a>
            
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <!-- ปุ่มดาวน์โหลดใบงาน -->
                <a href="assets/docs/worksheet_lesson1.pdf" download class="btn btn-outline-success btn-sm rounded-pill px-3 btn-playful">
                    <i class="bi bi-file-earmark-arrow-down-fill me-1"></i> ดาวน์โหลดใบงาน
                </a>

                <a href="home.php" class="btn btn-outline-primary btn-sm rounded-pill px-3 btn-playful">
                    <i class="bi bi-grid-fill me-1"></i> หน้ารวมบทเรียน
                </a>
                
                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill d-none d-md-inline-block">
                    👋 สวัสดี, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                </span>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container mt-4 mb-5 flex-grow-1 position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb bg-transparent p-0 small">
                        <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none text-primary"><i class="bi bi-house-door-fill me-1"></i>หน้าหลัก</a></li>
                        <li class="breadcrumb-item active" aria-current="page">บทที่ 1: ความรู้เบื้องต้นเกี่ยวกับ IoT</li>
                    </ol>
                </nav>

                <!-- Main Content Card -->
                <div class="main-card p-4 p-md-5 position-relative">
                    <div class="floating-blob blob-1"></div>
                    <div class="floating-blob blob-2"></div>

                    <!-- 🟢 2. Header Section (การ์ดหัวข้อสไตล์บทที่ 3) -->
                    <div class="p-4 p-md-5 rounded-4 text-white mb-4 position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%); box-shadow: 0 10px 25px rgba(30, 27, 75, 0.25); z-index: 1;">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                            <span class="badge bg-primary badge-pill-custom">
                                📖 บทเรียนที่ 1
                            </span>
                            <span class="badge badge-pill-custom" style="background: linear-gradient(135deg, #8b5cf6, #ec4899);">
                                🚀 Basics & Fundamentals
                            </span>
                        </div>
                        <h1 class="fw-bold display-6 mb-3 text-white">
                            ความรู้เบื้องต้นเกี่ยวกับ IoT (Internet of Things) 🌟
                        </h1>
                        <p class="text-white-50 fs-6 mb-0 lh-lg">
                            มาทำความเข้าใจโลกของอุปกรณ์อัจฉริยะแบบสนุกๆ สื่อสารกันได้โดยไม่ต้องง้อคนสั่ง!
                        </p>
                    </div>

                    <!-- Topic 1: IoT คืออะไร -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                            <span class="fs-3">💡</span> Internet of Things (IoT) คืออะไรกันนะ?
                        </h3>
                        
                        <p class="lh-lg fs-6 text-secondary">
                            <strong class="text-dark">Internet of Things (IoT)</strong> หรือ <em>"อินเทอร์เน็ตของสรรพสิ่ง"</em> คือ เครือข่ายของอุปกรณ์ วัตถุ หรือเครื่องใช้ไฟฟ้าต่างๆ ที่ถูกฝังเซนเซอร์ ซอฟต์แวร์ และเทคโนโลยีการเชื่อมต่อเอาไว้ เพื่อให้พวกมันสามารถ <strong>ดักจับ แลกเปลี่ยน และประมวลผลข้อมูลร่วมกันผ่านอินเทอร์เน็ตได้โดยอัตโนมัติ</strong> เปลี่ยนวัตถุธรรมดาในชีวิตประจำวัน ให้กลายเป็น <span class="badge bg-indigo text-primary bg-opacity-10 px-2 py-1 rounded">"อุปกรณ์อัจฉริยะ" (Smart Devices)</span> นั่นเอง!
                        </p>

                        <!-- Video Player Section -->
                        <div class="card border-0 rounded-4 overflow-hidden my-4 shadow-sm position-relative">
                            <div class="ratio ratio-16x9">
                                <iframe 
                                    src="https://www.youtube.com/embed/Od562cHJXEA" 
                                    title="ความรู้เบื้องต้นเกี่ยวกับ IoT (Internet of Things)" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>

                        <!-- Info Callout -->
                        <div class="info-callout my-4">
                            <h6 class="fw-bold text-primary mb-2 d-flex align-items-center gap-2">
                                <i class="bi bi-stars text-warning fs-5"></i> ลองจินตนาการในชีวิตประจำวันดูสิ!
                            </h6>
                            <p class="mb-0 text-secondary small lh-lg">
                                🏠 สั่งเปิดแอร์ล่วงหน้าผ่านมือถือก่อนถึงบ้าน <br>
                                🪴 ระบบรดน้ำต้นไม้อัตโนมัติเมื่อเซ็นเซอร์ฟ้องว่าดินแห้งเกินไป <br>
                                ⌚ Smartwatch ตรวจจับการเต้นของหัวใจ แล้วส่งข้อมูลสุขภาพขึ้น Cloud ทันที!
                            </p>
                        </div>
                    </section>

                    <!-- Feature Cards 3 คุณลักษณะเด่น -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h4 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                            ✨ 3 จุดเด่นสุดเจ๋งของ IoT
                        </h4>
                        
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="card h-100 feature-card p-4 border-start border-4 border-primary">
                                    <div class="fs-1 text-primary mb-2">⚡</div>
                                    <h5 class="fw-bold text-dark">Automation</h5>
                                    <p class="text-muted small mb-0">ทำงานอัตโนมัติตามเงื่อนไขที่ตั้งไว้ ลดภาระและลดข้อผิดพลาดจากมนุษย์</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100 feature-card p-4 border-start border-4 border-success">
                                    <div class="fs-1 text-success mb-2">📊</div>
                                    <h5 class="fw-bold text-dark">Real-Time Data</h5>
                                    <p class="text-muted small mb-0">รับ-ส่งและวิเคราะห์ข้อมูลทันทีทันใด ตัดสินใจแก้ไขปัญหาได้ทันท่วงที</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100 feature-card p-4 border-start border-4 border-warning">
                                    <div class="fs-1 text-warning mb-2">🔗</div>
                                    <h5 class="fw-bold text-dark">Interconnectivity</h5>
                                    <p class="text-muted small mb-0">เชื่อมอุปกรณ์ต่างชนิด ต่างแบรนด์ ให้คุยกันรู้เรื่องผ่านโปรโตคอลมาตรฐาน</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Topic 2: ประวัติความเป็นมาของ IoT -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-primary mb-4 d-flex align-items-center gap-2">
                            📜 ประวัติความเป็นมาของ IoT
                        </h3>

                        <div class="row g-4">
                            <!-- History Item 1 -->
                            <div class="col-12">
                                <div class="history-card history-card-yellow">
                                    <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill mb-2">
                                        📅 ปี ค.ศ. 1999 • จุดเริ่มต้นคำศัพท์
                                    </span>
                                    <h5 class="fw-bold text-dark mt-1 mb-2">Kevin Ashton บัญญัติคำว่า "Internet of Things"</h5>
                                    <p class="text-secondary mb-0 small">
                                        เควิน แอชตัน (Kevin Ashton) นำเสนอเทคโนโลยี RFID เพื่อติดตามสินค้าในห่วงโซ่อุปทาน ถือเป็นการเปิดฉากแนวคิด IoT อย่างเป็นทางการ
                                    </p>
                                </div>
                            </div>

                            <!-- History Item 2 -->
                            <div class="col-12">
                                <div class="history-card history-card-green">
                                    <span class="badge bg-success text-white fw-bold px-3 py-2 rounded-pill mb-2">
                                        🚀 ปี ค.ศ. 2010 • ยุคการยอมรับอย่างแพร่หลาย
                                    </span>
                                    <h5 class="fw-bold text-dark mt-1 mb-2">การเติบโตอย่างก้าวกระโดดทั่วโลก</h5>
                                    <p class="text-secondary mb-0 small">
                                        เป็นจุดที่จำนวนอุปกรณ์ที่เชื่อมต่ออินเทอร์เน็ต (Connected Devices) เริ่มมีมากกว่าจำนวนประชากรมนุษย์บนโลกเป็นครั้งแรก!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Topic 3: องค์ประกอบของ IoT (Accordion Style) -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                            🧩 4 องค์ประกอบสำคัญของระบบ IoT
                        </h3>
                        <p class="text-muted mb-4">ระบบ IoT ที่สมบูรณ์จะทำงานประสานกัน 4 ส่วน ดังนี้ (คลิกเพื่อดูรายละเอียด):</p>

                        <div class="accordion" id="iotAccordion">
                            
                            <!-- 1. Hardware -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#col1" aria-expanded="true">
                                        <i class="bi bi-cpu-fill text-primary me-2 fs-5"></i> 1. อุปกรณ์และเซนเซอร์ (Hardware & Sensors)
                                    </button>
                                </h2>
                                <div id="col1" class="accordion-collapse collapse show" data-bs-parent="#iotAccordion">
                                    <div class="accordion-body text-secondary">
                                        <p>จุดเริ่มต้นการรับรู้ข้อมูลกายภาพและแปลงเป็นสัญญาณไฟฟ้า รวมถึงการตอบสนองเชิงกล</p>
                                        <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                            <li class="p-2 bg-light rounded-3">🔹 <strong>เซนเซอร์ (Sensors):</strong> ตรวจวัดค่า เช่น อุณหภูมิ (DHT11), แสง (LDR), การเคลื่อนไหว (PIR)</li>
                                            <li class="p-2 bg-light rounded-3">🔹 <strong>ตัวกระทำ (Actuators):</strong> เปลี่ยนไฟฟ้าเป็นพลังงานกล เช่น เซอร์โวมอเตอร์ หรือ รีเลย์ (Relay)</li>
                                            <li class="p-2 bg-light rounded-3">🔹 <strong>ไมโครคอนโทรลเลอร์ (Microcontrollers):</strong> สมองประมวลผล เช่น ESP32, Arduino, Raspberry Pi</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Connectivity -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#col2">
                                        <i class="bi bi-wifi text-info me-2 fs-5"></i> 2. การเชื่อมต่อสื่อสาร (Connectivity & Protocols)
                                    </button>
                                </h2>
                                <div id="col2" class="accordion-collapse collapse" data-bs-parent="#iotAccordion">
                                    <div class="accordion-body text-secondary">
                                        <p>ตัวกลางส่งผ่านข้อมูลจากอุปกรณ์ไปเซิร์ฟเวอร์หรือ Cloud</p>
                                        <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                            <li class="p-2 bg-light rounded-3">📡 <strong>เครือข่ายไร้สาย:</strong> Wi-Fi, Bluetooth/BLE, Zigbee, LoRaWAN, 4G/5G</li>
                                            <li class="p-2 bg-light rounded-3">🔄 <strong>IoT Protocols:</strong> MQTT (เบาสุดๆ ยอดนิยม), HTTP/REST API</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- 3. Cloud Processing -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#col3">
                                        <i class="bi bi-cloud-upload-fill text-warning me-2 fs-5"></i> 3. การประมวลผลข้อมูล (Data Processing)
                                    </button>
                                </h2>
                                <div id="col3" class="accordion-collapse collapse" data-bs-parent="#iotAccordion">
                                    <div class="accordion-body text-secondary">
                                        <p>วิเคราะห์ข้อมูลดิบเพื่อนำไปประมวลผลและตัดสินใจ</p>
                                        <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                            <li class="p-2 bg-light rounded-3">☁️ <strong>Cloud Computing:</strong> ประมวลผลบนคลาวด์ เช่น Blynk, NETPIE, AWS IoT, Firebase</li>
                                            <li class="p-2 bg-light rounded-3">⚡ <strong>Edge Computing:</strong> ประมวลผลที่ตัวบอร์ดอุปกรณ์ทันทีเพื่อลดความล่าช้า (Latency)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- 4. UI -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#col4">
                                        <i class="bi bi-phone-fill text-success me-2 fs-5"></i> 4. ส่วนติดต่อผู้ใช้งาน (User Interface & Action)
                                    </button>
                                </h2>
                                <div id="col4" class="accordion-collapse collapse" data-bs-parent="#iotAccordion">
                                    <div class="accordion-body text-secondary">
                                        <p>ส่วนที่แสดงผลลัพธ์ให้มนุษย์ดู หรือรับคำสั่งจากผู้ใช้</p>
                                        <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                            <li class="p-2 bg-light rounded-3">📱 <strong>Dashboards & Mobile Apps:</strong> แสดงผลกราฟ สถานะอุปกรณ์</li>
                                            <li class="p-2 bg-light rounded-3">🔔 <strong>Notification:</strong> แจ้งเตือนเมื่อเกิดเหตุการณ์สำคัญ เช่น LINE Notify</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>

                    <!-- Topic 4: ตารางเปรียบเทียบบอร์ด -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                            ⚖️ เปรียบเทียบบอร์ดไมโครคอนโทรลเลอร์ยอดนิยม
                        </h3>
                        <p class="text-muted small mb-3">เลือกบอร์ดให้เหมาะกับลักษณะโปรเจกต์ของคุณ:</p>

                        <div class="table-responsive shadow-sm rounded-4">
                            <table class="table table-hover align-middle mb-0 text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="py-3 text-start ps-3">คุณสมบัติ / อุปกรณ์</th>
                                        <th class="py-3">Arduino Uno</th>
                                        <th class="py-3 bg-indigo text-white fw-bold" style="background-color: #4f46e5;">ESP32 Family ⭐</th>
                                        <th class="py-3">Raspberry Pi 4</th>
                                    </tr>
                                </thead>
                                <tbody class="small">
                                    <tr>
                                        <td class="fw-bold text-start ps-3 bg-light">การเชื่อมต่อไร้สาย</td>
                                        <td class="text-muted">ไม่มี (ต้องต่อโมดูลเพิ่ม)</td>
                                        <td class="text-success fw-bold bg-success bg-opacity-10">มี Wi-Fi & Bluetooth ในตัว</td>
                                        <td>Wi-Fi, Bluetooth, Ethernet</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-3 bg-light">การประมวลผล</td>
                                        <td>8-bit (พื้นฐาน)</td>
                                        <td class="fw-bold text-primary bg-success bg-opacity-10">32-bit Dual Core (แรงปานกลาง)</td>
                                        <td>64-bit Quad Core (เทียบเท่า PC)</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-3 bg-light">งานที่เหมาะสม</td>
                                        <td>ฝึกคุมเซนเซอร์/มอเตอร์เบื้องต้น</td>
                                        <td class="text-primary fw-bold bg-success bg-opacity-10">Smart Home, IoT Cloud, ส่ง LINE</td>
                                        <td>Edge AI, Video Stream, Server</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <!-- Topic 5: Edge AI Section -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <div class="edge-ai-card p-4 p-md-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="fs-1">🤖</div>
                                <div>
                                    <h4 class="fw-bold text-dark mb-1">เทรนด์น่าจับตา: Edge AI & ระบบจดจำใบหน้า</h4>
                                    <span class="badge bg-indigo text-primary bg-opacity-25 rounded-pill px-3">นวัตกรรมล้ำสมัย</span>
                                </div>
                            </div>
                            <p class="text-secondary small lh-lg">
                                การรวมพลังระหว่าง <strong>AI + IoT</strong> ช่วยให้อุปกรณ์สามารถประมวลผลความฉลาดได้ทันทีที่ตัวบอร์ด เช่น บอร์ด <strong>ESP32-CAM</strong> ที่ใช้สแกนใบหน้า (Face Recognition) เช็คชื่อเข้าเรียน แล้วส่งแจ้งเตือนเข้า <strong>LINE Notify</strong> ได้ทันทีแบบ Real-time!
                            </p>
                            
                            <!-- Flow Step -->
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-3">
                                <div class="flow-step text-center flex-fill">📸 กล้องถ่ายใบหน้า</div>
                                <div class="text-muted d-none d-md-block">➔</div>
                                <div class="flow-step text-center flex-fill">🧠 บอร์ดวิเคราะห์ AI</div>
                                <div class="text-muted d-none d-md-block">➔</div>
                                <div class="flow-step text-center flex-fill">🌐 ส่งข้อมูลผ่าน Wi-Fi</div>
                                <div class="text-muted d-none d-md-block">➔</div>
                                <div class="flow-step text-center flex-fill">💬 แจ้งเตือนเข้า LINE</div>
                            </div>
                        </div>
                    </section>

                    <!-- Interactive IoT Simulator Zone -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h4 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            🎮 ลองสั่งงาน IoT จำลอง (Interactive Lab)
                        </h4>
                        <div class="sim-box">
                            <div class="row align-items-center g-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <span id="led" class="led-indicator"></span>
                                        <div>
                                            <h6 class="mb-0 fw-bold" id="led-status-text">สถานะอุปกรณ์: ปิดอยู่ (OFF)</h6>
                                            <small class="text-muted">บอร์ด ESP32 กำลังรอรับคำสั่งผ่านระบบ Cloud...</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <button id="btn-toggle-led" class="btn btn-outline-primary rounded-pill btn-sm px-3 me-2">
                                        <i class="bi bi-power me-1"></i> สลับสวิตช์ไฟ
                                    </button>
                                    <button id="btn-send-line" class="btn btn-success rounded-pill btn-sm px-3">
                                        <i class="bi bi-line me-1"></i> จำลองส่ง LINE Notify
                                    </button>
                                </div>
                            </div>
                            <!-- Alert Notification Simulator -->
                            <div id="line-alert" class="alert alert-success mt-3 mb-0 d-none animate__animated animate__fadeIn" role="alert">
                                🔔 <strong>LINE Notify:</strong> [ESP32-CAM] ตรวจพบการสแกนใบหน้าสำเร็จ! ยินดีต้อนรับคุณ <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </div>
                        </div>
                    </section>

                    <!-- Quiz & Summary Box -->
                    <section class="mt-5 position-relative" style="z-index: 1;">
                        <div class="card border-0 rounded-4 text-white shadow-lg overflow-hidden" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
                            <div class="card-body p-4 p-md-5 text-center">
                                <h3 class="fw-bold mb-3">💡 สรุปสาระสำคัญท้ายบท</h3>
                                <p class="mb-4 text-white-50 small lh-lg px-md-5">
                                    IoT คือสถาปัตยกรรมที่รวม Hardware, Network, Cloud และ UI เข้าด้วยกัน หากเราเข้าใจหลักการทำงานแล้ว เราจะสามารถต่อยอดสร้างสรรค์โปรเจกต์ Smart Home หรือนวัตกรรมใหม่ๆ ในชีวิตประจำวันได้อย่างไม่มีขีดจำกัด!
                                </p>
                                
                                <a href="https://docs.google.com/forms/d/e/1FAIpQLSf_ZW8e4KXOQOVjKzg60MaZP-mSmsFavcgT8JawUwCX1fsDPQ/viewform" target="_blank" class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary btn-playful pulse-btn">
                                    📝 ทำแบบทดสอบวัดความรู้ บทที่ 1
                                </a>
                            </div>
                        </div>
                    </section>

                    <!-- Navigation Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-5 position-relative" style="z-index: 1;">
                        <a href="home.php" class="btn btn-outline-secondary rounded-pill px-4 btn-playful">
                            <i class="bi bi-arrow-left me-1"></i> หน้ารวมบทเรียน
                        </a>
                        <a href="lesson2.php" class="btn btn-primary rounded-pill px-4 btn-playful">
                            ไปบทที่ 2: อุปกรณ์และฮาร์ดแวร์ <i class="bi bi-arrow-right ms-1"></i>
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

    <!-- ดึง Footer Component จากไฟล์ footer.php -->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
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

        // 3. IoT Simulator Toggle LED
        let isLedOn = false;
        document.getElementById("btn-toggle-led").addEventListener("click", function() {
            let led = document.getElementById("led");
            let text = document.getElementById("led-status-text");
            isLedOn = !isLedOn;

            if(isLedOn) {
                led.classList.add("led-active");
                text.innerText = "สถานะอุปกรณ์: เปิดใช้งานแล้ว (ON 💡)";
                text.classList.add("text-success");
            } else {
                led.classList.remove("led-active");
                text.innerText = "สถานะอุปกรณ์: ปิดอยู่ (OFF)";
                text.classList.remove("text-success");
            }
        });

        // 4. IoT Simulator LINE Notification
        document.getElementById("btn-send-line").addEventListener("click", function() {
            let alertBox = document.getElementById("line-alert");
            alertBox.classList.remove("d-none");
            setTimeout(function() {
                alertBox.classList.add("d-none");
            }, 4000);
        });
    </script>
</body>
</html>
