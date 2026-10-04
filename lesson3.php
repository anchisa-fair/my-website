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
    <title>บทที่ 3 - ฮาร์ดแวร์ ไมโครคอนโทรลเลอร์ เซ็นเซอร์เชิงลึก และการประยุกต์ใช้งาน IoT 🌟 | IoT Learning Hub</title>
    
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

        .top-banner-wrapper {
            background-color: #0b1329;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
        .header-banner-img {
            max-height: 260px;
            object-fit: cover;
            object-position: center;
        }

        .bg-shape {
            position: fixed;
            border-radius: 50%;
            filter: blur(85px);
            z-index: 0;
            opacity: 0.45;
            pointer-events: none;
            animation: floatBg 12s ease-in-out infinite alternate;
        }
        .bg-shape-1 { width: 420px; height: 420px; background: #3b82f6; top: -100px; left: -100px; }
        .bg-shape-2 { width: 460px; height: 460px; background: #8b5cf6; top: 35%; right: -120px; animation-delay: -4s; }
        .bg-shape-3 { width: 400px; height: 400px; background: #06b6d4; bottom: -100px; left: -80px; animation-delay: -8s; }

        @keyframes floatBg {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(35px, -45px) scale(1.08); }
            100% { transform: translate(-25px, 35px) scale(0.95); }
        }

        #progress-bar {
            position: fixed;
            top: 0; left: 0; height: 4px;
            background: linear-gradient(90deg, #2563eb, #06b6d4, #8b5cf6, #ec4899);
            width: 0%; z-index: 9999;
            transition: width 0.1s ease-out;
            box-shadow: 0 0 12px rgba(37, 99, 235, 0.6);
        }

        .navbar-custom {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(16px);
            border-bottom: 2px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            z-index: 1000;
        }

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

        .cyber-header-box {
            background: var(--cyber-gradient);
            border-radius: 24px;
            color: white;
            padding: 2.5rem 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.22);
        }

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
        .domain-card:hover img { transform: scale(1.06); }

        .badge-pill-custom { padding: 8px 16px; border-radius: 30px; font-size: 0.85rem; }
        .feature-list li { position: relative; padding-left: 24px; margin-bottom: 8px; }
        .feature-list li::before { content: "⚡"; position: absolute; left: 0; top: 0; }
        
        .code-box {
            background-color: #1e1e2e;
            color: #a6adc8;
            border-radius: 14px;
            font-family: monospace;
            padding: 1.2rem;
            line-height: 1.5;
            overflow-x: auto;
            font-size: 0.88rem;
        }

        .table-custom-wrapper { border-radius: 20px; overflow: hidden; border: 1px solid #e2e8f0; }

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

        .pulse-btn { animation: pulseGlow 2s infinite; }
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.6); }
            70% { box-shadow: 0 0 0 16px rgba(37, 99, 235, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0); }
        }

        #btn-back-to-top {
            position: fixed; bottom: 35px; right: 35px; display: none;
            width: 48px; height: 48px; border-radius: 50%;
            background: #2563eb; color: #fff; border: none;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3); z-index: 99;
            transition: all 0.3s ease;
        }
        #btn-back-to-top:hover { transform: scale(1.15) translateY(-3px); background: #1d4ed8; }
    </style>
</head>
<body>

    <div class="bg-shape bg-shape-1"></div>
    <div class="bg-shape bg-shape-2"></div>
    <div class="bg-shape bg-shape-3"></div>

    <div id="progress-bar"></div>

    <div class="top-banner-wrapper position-relative z-1 text-center">
        <a href="home.php">
            <img src="img/banner.png" alt="Internet of Things Course" class="img-fluid w-100 header-banner-img">
        </a>
    </div>

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
                    👋 สวัสดี, <strong><?php echo htmlspecialchars($_SESSION['username'] ?? 'นักศึกษา'); ?></strong>
                </span>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-5 flex-grow-1 position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb bg-transparent p-0 small">
                        <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none text-primary"><i class="bi bi-house-door-fill me-1"></i>หน้าหลัก</a></li>
                        <li class="breadcrumb-item active" aria-current="page">บทที่ 3: ฮาร์ดแวร์ ไมโครคอนโทรลเลอร์ เซ็นเซอร์เชิงลึก และการประยุกต์ใช้งาน</li>
                    </ol>
                </nav>

                <div class="main-card p-4 p-md-5 position-relative">

                    <div class="cyber-header-box mb-4 position-relative" style="z-index: 1;">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                            <span class="badge bg-primary text-white badge-pill-custom">📖 บทเรียนที่ 3</span>
                            <span class="badge text-white badge-pill-custom" style="background-color: var(--accent-purple);">🛠️ Advanced Hardware, Microcontrollers & Applications</span>
                        </div>
                        <h1 class="fw-bold text-white display-6 mb-2">
                            ฮาร์ดแวร์ ไมโครคอนโทรลเลอร์ และการประยุกต์ใช้งาน IoT ⚙️
                        </h1>
                        <p class="text-light opacity-75 fs-6 mb-0 lh-lg">
                            เจาะลึกสเปกไมโครคอนโทรลเลอร์ สถาปัตยกรรมขาพิน (GPIO) บัสสื่อสารข้อมูล เซ็นเซอร์อุตสาหกรรม และการเขียนโปรแกรมควบคุมเชิงลึก
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
                                    <h5 class="fw-bold text-dark mb-0">วิดีโอเจาะลึกฮาร์ดแวร์และเซ็นเซอร์ 🎬</h5>
                                    <small class="text-muted">ศึกษาการทำงานของพินอินเทอร์เฟซและวงจรอิเล็กทรอนิกส์ IoT</small>
                                </div>
                            </div>
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/VOV2j4N_U3o" title="IoT Hardware Video" allowfullscreen></iframe>
                            </div>
                        </div>
                    </section>

                    <!-- 🔬 Section 1: Microcontrollers Comparison -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <span class="fs-3">💻</span> 1. สเปกไมโครคอนโทรลเลอร์ (Microcontroller Boards)
                        </h3>
                        <p class="text-muted mb-4 small">
                            การเลือกใช้ฮาร์ดแวร์ในงาน IoT ต้องพิจารณาหน่วยความจำ (Flash/RAM), ความเร็วซีพียู, พลังงานที่ใช้ และการรองรับการเชื่อมต่อไร้สาย (Wi-Fi/Bluetooth)
                        </p>

                        <div class="table-custom-wrapper shadow-sm mb-4">
                            <table class="table table-hover align-middle mb-0 text-center" style="font-size: 0.88rem;">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="py-3 text-start ps-4">บอร์ดไมโครคอนโทรลเลอร์</th>
                                        <th class="py-3">ชิปประมวลผล (MCU)</th>
                                        <th class="py-3">Clock Speed</th>
                                        <th class="py-3">Flash / RAM</th>
                                        <th class="py-3">การเชื่อมต่อไร้สาย</th>
                                        <th class="py-3 text-start">การใช้งานที่เหมาะสม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-primary">Arduino Uno R3</td>
                                        <td>ATmega328P (8-bit)</td>
                                        <td>16 MHz</td>
                                        <td>32 KB / 2 KB</td>
                                        <td><span class="badge bg-secondary">ไม่มี (ต้องต่อ Wi-Fi Shield)</span></td>
                                        <td class="text-start">งานทดลองพื้นฐาน, ควบคุมมอเตอร์/รีเลย์เดี่ยวๆ</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-primary">ESP8266 (NodeMCU)</td>
                                        <td>Tensilica 32-bit</td>
                                        <td>80 / 160 MHz</td>
                                        <td>4 MB / 80 KB</td>
                                        <td><span class="badge bg-success">Wi-Fi 2.4GHz</span></td>
                                        <td class="text-start">โปรเจกต์ Smart Home ราคาประหยัด, ส่งค่าเซนเซอร์ขึ้น Cloud</td>
                                    </tr>
                                    <tr class="table-light">
                                        <td class="fw-bold text-start ps-4 text-success">ESP32 DevKit V1</td>
                                        <td>Dual-Core Tensilica</td>
                                        <td>160 / 240 MHz</td>
                                        <td>4 MB / 520 KB</td>
                                        <td><span class="badge bg-success">Wi-Fi + BLE 4.2</span></td>
                                        <td class="text-start">งาน IoT ระดับสูง, กล้อง AI (ESP32-CAM), บลูทูธเกตเวย์</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-4 text-primary">Raspberry Pi Pico</td>
                                        <td>RP2040 Dual ARM Cortex-M0+</td>
                                        <td>133 MHz</td>
                                        <td>2 MB / 264 KB</td>
                                        <td><span class="badge bg-secondary">Pico W มี Wi-Fi</span></td>
                                        <td class="text-start">งานที่ต้องการความแม่นยำสูง (PIO), ควบคุมฮาร์ดแวร์เรียลไทม์</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <!-- ⚡ Section 1.1: ESP32 GPIO Deep Dive & Rules -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <div class="p-4 rounded-4 bg-white border shadow-sm">
                            <h4 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                                <span class="fs-4 text-primary">⚡</span> ข้อควรรู้เชิงลึกในการใช้งานขาพิน ESP32 (GPIO Multiplexing & Rules)
                            </h4>
                            <p class="text-muted small mb-3">
                                การต่อวงจรจริงกับ ESP32 วิศวกรและนักพัฒนาจำเป็นต้องระมัดระวังคุณสมบัติพิเศษของขาพินแต่ละกลุ่มเพื่อป้องกันความเสียหาย:
                            </p>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="p-3 rounded-3 bg-light border h-100">
                                        <h6 class="fw-bold text-danger mb-2">🚫 Input-Only Pins (GPIO 34-39)</h6>
                                        <p class="small text-muted mb-0">เป็นขาที่รับสัญญาณเข้าได้อย่างเดียว (ไม่มีตัวต้านทาน Pull-up/Pull-down ภายใน) ห้ามนำไปใช้สั่งงาน Relay หรือ LED ที่ต้องส่งสัญญาณออก (Output)</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 rounded-3 bg-light border h-100">
                                        <h6 class="fw-bold text-warning mb-2">⚠️ Flash Pins (GPIO 6-11)</h6>
                                        <p class="small text-muted mb-0">เชื่อมต่ออยู่กับหน่วยความจำ Flash ภายในชิป ห้ามนำมาใช้งานเด็ดขาด เพราะจะทำให้บอร์ดแครช (Crash) หรือบูตไม่ขึ้นทันที</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 rounded-3 bg-light border h-100">
                                        <h6 class="fw-bold text-success mb-2">💡 Touch & ADC Pins</h6>
                                        <p class="small text-muted mb-0">รองรับระบบสัมผัส Capacitive Touch (GPIO 0, 2, 4, 12-15, 27, 32, 33) และรองรับการแปลงสัญญาณ Analog เป็น Digital (ADC1 แนะนำใช้งานร่วมกับ Wi-Fi)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 🔌 Section 2: Hardware Bus Protocols (I2C, SPI, UART) -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <span class="fs-3">🔌</span> 2. บัสสื่อสารข้อมูลฮาร์ดแวร์ (Communication Interfaces)
                        </h3>
                        <p class="text-muted mb-4 small">
                            การเชื่อมต่อเซนเซอร์และโมดูลเข้ากับไมโครคอนโทรลเลอร์ อาศัยโปรโตคอลระดับฮาร์ดแวร์มาตรฐาน ดังนี้:
                        </p>

                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="p-4 rounded-4 bg-white border h-100 shadow-sm">
                                    <div class="text-primary fs-3 mb-2"><i class="bi bi-diagram-2"></i></div>
                                    <h5 class="fw-bold text-dark">I2C (Inter-Integrated Circuit)</h5>
                                    <p class="small text-muted mb-2">ใช้สายสัญญาณเพียง 2 เส้น ได้แก่ <strong>SDA</strong> (Data) และ <strong>SCL</strong> (Clock) รองรับการต่ออุปกรณ์หลายตัวบนบัสเดียวกันผ่านหมายเลข Address</p>
                                    <span class="badge bg-info bg-opacity-10 text-dark small">เหมาะกับ: จอ OLED, เซนเซอร์ BME280, RTC</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-4 rounded-4 bg-white border h-100 shadow-sm">
                                    <div class="text-success fs-3 mb-2"><i class="bi bi-hdd-network"></i></div>
                                    <h5 class="fw-bold text-dark">SPI (Serial Peripheral Interface)</h5>
                                    <p class="small text-muted mb-2">ใช้สายสัญญาณ 4 เส้น ได้แก่ <strong>MOSI, MISO, SCK, CS</strong> มีความเร็วในการรับส่งข้อมูลสูงมากแบบ Full-Duplex แต่ใช้ขาพินเยอะกว่า</p>
                                    <span class="badge bg-success bg-opacity-10 text-success small">เหมาะกับ: การ์ด SD, โมดูล RFID, หน้าจอ TFT</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-4 rounded-4 bg-white border h-100 shadow-sm">
                                    <div class="text-warning fs-3 mb-2"><i class="bi bi-arrow-left-right"></i></div>
                                    <h5 class="fw-bold text-dark">UART (Serial Communication)</h5>
                                    <p class="small text-muted mb-2">สื่อสารแบบอะซิงโครนัสผ่านขา <strong>TX (Transmit)</strong> และ <strong>RX (Receive)</strong> ใช้รับส่งข้อมูลระหว่างไมโครคอนโทรลเลอร์กับคอมพิวเตอร์หรือโมดูล GPS</p>
                                    <span class="badge bg-warning bg-opacity-10 text-dark small">เหมาะกับ: โมดูล GPS, จอ Serial HMI, Debug Log</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 🔋 Section 2.1: Power Management & Deep Sleep -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <div class="p-4 rounded-4 bg-light border shadow-sm">
                            <h4 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                                <span class="fs-4 text-success">🔋</span> การจัดการพลังงานและระบบประหยัดพลังงาน (Deep Sleep Mode)
                            </h4>
                            <p class="text-muted small mb-3">
                                งาน IoT ที่ติดตั้งตามแปลงเกษตรหรือพื้นที่ห่างไกลมักใช้พลังงานจากแบตเตอรี่หรือแผงโซล่าเซลล์ การเปิด Wi-Fi และซีพียูทำงานตลอดเวลาจะทำให้แบตเตอรี่หมดไว เทคโนโลยี **Deep Sleep Mode** จึงเข้ามามีบทบาทสำคัญ:
                            </p>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <ul class="list-unstyled small text-secondary space-y-2 mb-0">
                                        <li>💤 <strong>หลักการทำงาน:</strong> ปิดการทำงานของ CPU หลัก, Wi-Fi, และ Bluetooth คงเหลือไว้เพียง RTC Timer เพื่อปลุก (Wake up) ระบบตามเวลาที่กำหนด</li>
                                        <li>📉 <strong>อัตราการกินไฟ:</strong> ลดลงจากปกติ (ประมาณ 80-160 mA) เหลือเพียงไม่กี่ไมโครแอมป์ ($\mu A$)</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled small text-secondary space-y-2 mb-0">
                                        <li>⏱️ <strong>การตั้งเวลาปลุก:</strong> ใช้คำสั่ง `esp_sleep_enable_timer_wakeup(TIME_IN_US)`</li>
                                        <li>🔄 <strong>วงจรการทำงาน:</strong> ตื่นขึ้นมา -> อ่านค่าเซนเซอร์ -> ส่งข้อมูลขึ้น Cloud ผ่าน MQTT/HTTP -> เข้าสู่โหมด Deep Sleep วนลูปประหยัดพลังงาน</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 🌡️ Section 3: Advanced Sensors & Actuators -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <span class="fs-3">🌡️</span> 3. เซนเซอร์และแอคทูเอเตอร์ (Sensors & Actuators)
                        </h3>
                        <p class="text-muted mb-4 small">
                            การเลือกเซนเซอร์ให้เหมาะสมกับงานโปรเจกต์ดิจิทัลบิสซิเนสและสมาร์ตฟาร์ม:
                        </p>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 bg-light border h-100">
                                    <h5 class="fw-bold text-primary mb-3"><i class="bi bi-thermometer-sun me-2"></i>กลุ่มเซนเซอร์สิ่งแวดล้อม (Environmental)</h5>
                                    <ul class="list-unstyled small text-secondary space-y-2 mb-0">
                                        <li><strong>DHT11 / DHT22:</strong> วัดอุณหภูมิและความชื้นสัมพัทธ์ (DHT22 แม่นยำสูงกว่า)</li>
                                        <li><strong>BME280:</strong> วัดอุณหภูมิ ความชื้น และความกดอากาศ ผ่านบัส I2C ความแม่นยำสูงระดับอุตสาหกรรม</li>
                                        <li><strong>MQ-135 / MQ-2:</strong> ตรวจวัดคุณภาพอากาศ แก๊สพิษ ควัน และ LPG สำหรับระบบความปลอดภัย</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 bg-light border h-100">
                                    <h5 class="fw-bold text-success mb-3"><i class="bi bi-sliders me-2"></i>กลุ่มเซนเซอร์เกษตรและควบคุม (Agriculture & Actuators)</h5>
                                    <ul class="list-unstyled small text-secondary space-y-2 mb-0">
                                        <li><strong>Capacitive Soil Moisture:</strong> วัดความชื้นในดินแบบไม่เกิดสนิม (ทนทานกว่าแบบแท่งโลหะเปลือย)</li>
                                        <li><strong>HX711 + Load Cell:</strong> เซนเซอร์ชั่งน้ำหนักดิจิทัล ใช้ทำตู้สินค้าอัจฉริยะหรือเครื่องชั่งสมาร์ตฟาร์ม</li>
                                        <li><strong>Relay Module (5V/12V):</strong> สวิตช์อิเล็กทรอนิกส์กำลังสูง สำหรับตัด-ต่อไฟบ้าน 220V ควบคุมปั๊มน้ำหรือหลอดไฟ</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Code Example Box -->
                        <div class="fun-card p-4 bg-dark text-white border-0 rounded-4">
                            <h6 class="fw-bold text-warning mb-2"><i class="bi bi-code-slash me-2"></i>ตัวอย่างโค้ด ESP32 อ่านค่าเซนเซอร์หลายตัว (DHT22 และ LDR แสง) พร้อมระบบเชื่อมต่อ Wi-Fi</h6>
                            <div class="code-box">
<span class="text-purple">#include</span> &lt;<span class="text-success">WiFi.h</span>&gt;<br>
<span class="text-purple">#include</span> &lt;<span class="text-success">DHT.h</span>&gt;<br><br>
<span class="text-cyan">#define</span> DHTPIN <span class="text-warning">4</span>       <span class="text-success">// ขา GPIO 4 ต่อ DHT22</span><br>
<span class="text-cyan">#define</span> DHTTYPE DHT22<br>
<span class="text-cyan">#define</span> LDR_PIN <span class="text-warning">34</span>     <span class="text-success">// ขา GPIO 34 (Analog Input) ต่อ LDR แสง</span><br><br>
DHT dht(DHTPIN, DHTTYPE);<br><br>
<span class="text-success">const char</span>* ssid = <span class="text-cyan">"IoT_Network_Lab"</span>;<br>
<span class="text-success">const char</span>* password = <span class="text-cyan">"123456789"</span>;<br><br>
<span class="text-success">void</span> <span class="text-white">setup</span>() {<br>
&nbsp;&nbsp;Serial.begin(<span class="text-warning">115200</span>);<br>
&nbsp;&nbsp;dht.begin();<br>
&nbsp;&nbsp;pinMode(LDR_PIN, INPUT);<br><br>
&nbsp;&nbsp;WiFi.begin(ssid, password);<br>
&nbsp;&nbsp;Serial.print(<span class="text-cyan">"Connecting to WiFi"</span>);<br>
&nbsp;&nbsp;<span class="text-purple">while</span> (WiFi.status() != WL_CONNECTED) {<br>
&nbsp;&nbsp;&nbsp;&nbsp;delay(<span class="text-warning">500</span>);<br>
&nbsp;&nbsp;&nbsp;&nbsp;Serial.print(<span class="text-cyan">"."</span>);<br>
&nbsp;&nbsp;}<br>
&nbsp;&nbsp;Serial.println(<span class="text-cyan">"\nWiFi Connected!"</span>);<br>
}<br><br>
<span class="text-success">void</span> <span class="text-white">loop</span>() {<br>
&nbsp;&nbsp;<span class="text-success">float</span> h = dht.readHumidity();<br>
&nbsp;&nbsp;<span class="text-success">float</span> t = dht.readTemperature();<br>
&nbsp;&nbsp;<span class="text-success">int</span> ldrValue = analogRead(LDR_PIN);<br><br>
&nbsp;&nbsp;<span class="text-success">if</span> (isnan(h) || isnan(t)) {<br>
&nbsp;&nbsp;&nbsp;&nbsp;Serial.println(<span class="text-cyan">"Error reading DHT sensor!"</span>);<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-purple">return</span>;<br>
&nbsp;&nbsp;}<br><br>
&nbsp;&nbsp;Serial.printf(<span class="text-cyan">"Temp: %.1f C | Humidity: %.1f %% | Light Intensity: %d\n"</span>, t, h, ldrValue);<br>
&nbsp;&nbsp;delay(<span class="text-warning">3000</span>);<br>
}
                            </div>
                        </div>
                    </section>

                    <!-- 🌍 Section 4: IoT Application Domains -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                            <span class="fs-3">🌍</span> 4. โดเมนการประยุกต์ใช้งาน IoT ในภาคธุรกิจและชีวิตจริง
                        </h3>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="domain-card h-100 d-flex flex-column">
                                    <div class="overflow-hidden position-relative">
                                        <img src="https://images.unsplash.com/photo-1558002038-1055907df827?auto=format&fit=crop&w=800&q=80" class="w-100" alt="Smart Home">
                                        <span class="position-absolute top-0 end-0 m-3 badge bg-primary badge-pill-custom">🏠 Smart Home</span>
                                    </div>
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-2">บ้านและอาคารอัจฉริยะ</h5>
                                        <p class="text-muted small mb-3">ควบคุมระบบไฟฟ้า แอร์ และความปลอดภัยผ่านสมาร์ตโฟน ผสานระบบ Edge AI จดจำใบหน้าผู้พักอาศัย</p>
                                        <ul class="list-unstyled small text-secondary mb-0 mt-auto feature-list">
                                            <li>เชื่อมต่อ Zigbee / Wi-Fi Gateway</li>
                                            <li>ระบบแจ้งเตือนแก๊สรั่วและควันไฟอัตโนมัติ</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="domain-card h-100 d-flex flex-column">
                                    <div class="overflow-hidden position-relative">
                                        <img src="https://images.unsplash.com/photo-1586771107445-d3ca888129ff?auto=format&fit=crop&w=800&q=80" class="w-100" alt="Smart Farming">
                                        <span class="position-absolute top-0 end-0 m-3 badge bg-success badge-pill-custom">🌱 Smart Farming</span>
                                    </div>
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-2">การเกษตรแม่นยำสูง (Precision Farming)</h5>
                                        <p class="text-muted small mb-3">ระบบรดน้ำอัตโนมัติอิงค่าความชื้นในดินจริง ลดการใช้น้ำและปุ๋ยผ่านเครือข่าย LoRaWAN ระยะไกล</p>
                                        <ul class="list-unstyled small text-secondary mb-0 mt-auto feature-list">
                                            <li>เซนเซอร์วัดค่าความชื้นและ NPK ในดิน</li>
                                            <li>ควบคุมปั๊มน้ำอัตโนมัติผ่านรีเลย์โมดูล</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 📝 Quiz & Action Box -->
                    <section class="mt-5 position-relative" style="z-index: 1;">
                        <div class="card border-0 rounded-4 text-white shadow-lg overflow-hidden" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);">
                            <div class="card-body p-4 p-md-5 text-center">
                                <h3 class="fw-bold mb-3">🎉 เรียนรู้บทที่ 3 ครบถ้วนและเจาะลึกแล้ว!</h3>
                                <p class="mb-4 text-white-50 small lh-lg px-md-5">
                                    ทดสอบความเข้าใจเกี่ยวกับฮาร์ดแวร์ ไมโครคอนโทรลเลอร์ และการเขียนโปรแกรมเซนเซอร์ เพื่อสะสมคะแนนประจำบทเรียนกันเลยครับ!
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
                        <a href="lesson4.php" class="btn btn-primary rounded-pill px-4 btn-playful">
                            ไปบทที่ 4 <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <button id="btn-back-to-top" title="กลับขึ้นด้านบน">
        <i class="bi bi-arrow-up fs-5"></i>
    </button>

    <?php 
    if (file_exists('footer.php')) {
        include 'footer.php'; 
    } else {
    ?>
    <footer class="bg-dark text-white-50 py-4 border-top border-secondary mt-auto">
        <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center small gap-3">
            <div><a href="home.php" class="text-white text-decoration-none fw-semibold">🌐 IoT Learning Hub</a></div>
            <div>&copy; 2026 IoT E-Learning System. All rights reserved.</div>
        </div>
    </footer>
    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.onscroll = function() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("progress-bar").style.width = scrolled + "%";

            let backToTopBtn = document.getElementById("btn-back-to-top");
            if (winScroll > 300) {
                backToTopBtn.style.display = "block";
            } else {
                backToTopBtn.style.display = "none";
            }
        };

        document.getElementById("btn-back-to-top").addEventListener("click", function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>
