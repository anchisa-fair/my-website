<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บทที่ 2 - สถาปัตยกรรมและโปรโตคอลในระบบ IoT 🚀</title>
    
    <!-- Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
            --accent-purple: #8b5cf6;
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

        /* 🖼️ Top Main Banner Style (สไตล์แบบบทที่ 3) */
        .top-banner-wrapper {
            background-color: #0b1329;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
        .header-banner-img {
            max-height: 260px;
            object-fit: cover;
            object-position: center;
        }

        /* 🟢 1. Scroll Reading Progress Bar */
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
            z-index: 1000;
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

        /* 🟢 2. Floating Blob Animation */
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

        /* Feature Cards */
        .fun-card {
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.03);
            position: relative;
        }
        .fun-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 30px rgba(79, 70, 229, 0.1);
        }

        /* Badge Pills */
        .badge-pill-custom {
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        /* Table Styling */
        .table-custom-wrapper {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        /* Code Box */
        .code-box {
            background-color: #1e1e2e;
            color: #a6adc8;
            border-radius: 14px;
            font-family: monospace;
            padding: 1rem;
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

        /* Pulse Animation สำหรับปุ่มแบบทดสอบ */
        .pulse-btn {
            animation: pulseGlow 2s infinite;
        }
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.6); }
            70% { box-shadow: 0 0 0 15px rgba(79, 70, 229, 0); }
            100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); }
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

    <!-- 🖼️ Top Main Banner (อยู่ด้านบน Navbar แบบบทที่ 3) -->
    <div class="top-banner-wrapper position-relative z-1 text-center">
        <a href="home.php">
            <img src="img/banner.png" alt="Internet of Things (IoT) Course & Principles" class="img-fluid w-100 header-banner-img">
        </a>
    </div>

    <!-- 🌐 Top Navbar (รูปแบบเดียวกับบทที่ 1 และ 3) -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center gap-2" href="home.php">
                <span class="fs-4">🌐</span>
                <span style="letter-spacing: -0.5px;">IoT Learning Hub</span>
            </a>
            
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <!-- ปุ่มดาวน์โหลดใบงาน -->
                <a href="assets/docs/worksheet_lesson2.pdf" download class="btn btn-outline-success btn-sm rounded-pill px-3 btn-playful">
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

    <!-- 📦 Main Container -->
    <div class="container mt-4 mb-5 flex-grow-1 position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb bg-transparent p-0 small">
                        <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none text-primary"><i class="bi bi-house-door-fill me-1"></i>หน้าหลัก</a></li>
                        <li class="breadcrumb-item active" aria-current="page">บทที่ 2: สถาปัตยกรรมและโปรโตคอลในระบบ IoT</li>
                    </ol>
                </nav>

                <!-- Main Content Card -->
                <div class="main-card p-4 p-md-5 position-relative">
                    <div class="floating-blob blob-1"></div>
                    <div class="floating-blob blob-2"></div>

                    <!-- Header Section -->
                    <div class="border-bottom pb-4 mb-4 position-relative" style="z-index: 1;">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                            <span class="badge bg-primary badge-pill-custom">
                                📖 บทเรียนที่ 2
                            </span>
                            <span class="badge bg-purple text-white badge-pill-custom" style="background-color: var(--accent-purple);">
                                📡 Architecture & Protocols
                            </span>
                        </div>
                        <h1 class="fw-bold text-dark display-6 mb-2">
                            สถาปัตยกรรมและโปรโตคอล IoT 🚀
                        </h1>
                        <p class="text-muted fs-6 mb-0">
                            ไขปริศนาโครงสร้างเบื้องหลังและภาษาการสื่อสารที่ช่วยให้อุปกรณ์เชื่อมต่อกันได้อย่างมีประสิทธิภาพ!
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
                                    <h5 class="fw-bold text-dark mb-0">วิดีโอการเรียนรู้บทที่ 2 🎬</h5>
                                    <small class="text-muted">ทำความเข้าใจ Architecture & Protocols แบบเข้าใจง่าย</small>
                                </div>
                            </div>
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/G2KjpICYwQ8?si=_gEcHZvXhk9z92q9" title="IoT Architecture Video" allowfullscreen></iframe>
                            </div>
                        </div>
                    </section>

                    <!-- 🏗️ 1. IoT Architecture Section -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                            <span class="fs-3">🏗️</span> 1. สถาปัตยกรรมระบบ IoT (IoT Architecture)
                        </h3>
                        <p class="text-muted mb-4 fs-6">
                            การแบ่งชั้นการทำงาน (Layers) ช่วยให้ผู้พัฒนาออกแบบระบบได้ง่ายขึ้น เหมือนกับการวางโครงสร้างบ้าน!
                        </p>

                        <div class="row g-4">
                            <!-- 3-Layer Card -->
                            <div class="col-lg-6">
                                <div class="fun-card p-4 h-100 border-start border-4 border-info">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="fw-bold text-info mb-0"><i class="bi bi-layers-fill me-2"></i>แบบ 3 ชั้น (Basic 3-Layer)</h5>
                                        <span class="badge bg-info bg-opacity-10 text-info badge-pill-custom">สำหรับระบบทั่วไป</span>
                                    </div>
                                    <p class="text-muted small">โครงสร้างพื้นฐานเรียบง่าย เรียงลำดับจากบนลงล่าง:</p>

                                    <div class="d-flex flex-column gap-3">
                                        <div class="p-3 rounded-4 bg-light border-start border-4 border-primary">
                                            <span class="badge bg-primary mb-1">ชั้นที่ 3</span>
                                            <strong class="d-block text-dark">Application Layer (ชั้นประยุกต์)</strong>
                                            <small class="text-muted">หน้า UI แดชบอร์ดหรือแอปพลิเคชันมือถือที่ผู้ใช้กดสั่งงาน</small>
                                        </div>
                                        <div class="p-3 rounded-4 bg-light border-start border-4 border-success">
                                            <span class="badge bg-success mb-1">ชั้นที่ 2</span>
                                            <strong class="d-block text-dark">Network Layer (ชั้นเครือข่าย)</strong>
                                            <small class="text-muted">ทางเดินข้อมูล เช่น Wi-Fi, 4G/5G, Internet Gateway</small>
                                        </div>
                                        <div class="p-3 rounded-4 bg-light border-start border-4 border-warning">
                                            <span class="badge bg-warning text-dark mb-1">ชั้นที่ 1</span>
                                            <strong class="d-block text-dark">Perception Layer (ชั้นรับรู้)</strong>
                                            <small class="text-muted">ฮาร์ดแวร์ด่านหน้า เช่น เซนเซอร์วัดอุณหภูมิ, ปุ่มกด, กล้อง</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 5-Layer Card -->
                            <div class="col-lg-6">
                                <div class="fun-card p-4 h-100 border-start border-4 border-purple" style="border-color: var(--accent-purple) !important;">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="fw-bold mb-0" style="color: var(--accent-purple);"><i class="bi bi-diagram-3-fill me-2"></i>แบบ 5 ชั้น (Advanced 5-Layer)</h5>
                                        <span class="badge text-white badge-pill-custom" style="background-color: var(--accent-purple);">ระดับองค์กร / Cloud</span>
                                    </div>
                                    <p class="text-muted small">เพิ่มระดับการวิเคราะห์ข้อมูลและวางแผนธุรกิจ:</p>

                                    <div class="d-flex flex-column gap-2">
                                        <div class="p-2 px-3 rounded-3 bg-light d-flex align-items-center gap-3">
                                            <span class="badge rounded-circle p-2 text-white" style="background-color: #4a148c;">5</span>
                                            <div><strong class="small text-dark">Business Layer:</strong> <span class="text-muted small">วิเคราะห์ข้อมูลเชิงธุรกิจ</span></div>
                                        </div>
                                        <div class="p-2 px-3 rounded-3 bg-light d-flex align-items-center gap-3">
                                            <span class="badge rounded-circle p-2 text-white" style="background-color: #6a1b9a;">4</span>
                                            <div><strong class="small text-dark">Application Layer:</strong> <span class="text-muted small">ระบบแสดงผลเฉพาะทาง</span></div>
                                        </div>
                                        <div class="p-2 px-3 rounded-3 bg-light d-flex align-items-center gap-3">
                                            <span class="badge rounded-circle p-2 text-white" style="background-color: #8e24aa;">3</span>
                                            <div><strong class="small text-dark">Processing Layer:</strong> <span class="text-muted small">Cloud, Big Data & Edge AI</span></div>
                                        </div>
                                        <div class="p-2 px-3 rounded-3 bg-light d-flex align-items-center gap-3">
                                            <span class="badge rounded-circle p-2 text-white" style="background-color: #ab47bc;">2</span>
                                            <div><strong class="small text-dark">Transport Layer:</strong> <span class="text-muted small">ส่งข้อมูลด้วย MQTT, CoAP, HTTP</span></div>
                                        </div>
                                        <div class="p-2 px-3 rounded-3 bg-light d-flex align-items-center gap-3">
                                            <span class="badge rounded-circle p-2 text-dark" style="background-color: #ce93d8;">1</span>
                                            <div><strong class="small text-dark">Perception Layer:</strong> <span class="text-muted small">Edge Devices / Sensors</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 🔄 2. Data Protocols Comparison -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                            <span class="fs-3">🔄</span> 2. เปรียบเทียบโปรโตคอลการรับส่งข้อมูล (IoT Protocols)
                        </h3>
                        
                        <div class="table-custom-wrapper shadow-sm mb-4">
                            <table class="table table-hover align-middle mb-0 text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="py-3 text-start ps-3">คุณสมบัติ ⚙️</th>
                                        <th class="py-3 text-primary"><i class="bi bi-lightning-charge-fill me-1"></i> MQTT</th>
                                        <th class="py-3 text-success"><i class="bi bi-globe me-1"></i> HTTP / REST API</th>
                                    </tr>
                                </thead>
                                <tbody class="small">
                                    <tr>
                                        <td class="fw-bold text-start ps-3 bg-light">รูปแบบการทำงาน</td>
                                        <td><span class="badge bg-primary bg-opacity-10 text-primary">Publish / Subscribe</span></td>
                                        <td><span class="badge bg-success bg-opacity-10 text-success">Request / Response</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-3 bg-light">ขนาด Header ข้อมูล</td>
                                        <td class="text-primary fw-bold">⚡ เล็กมากๆ (~2 Bytes)</td>
                                        <td class="text-warning text-dark">📦 ขนาดใหญ่กว่า</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-3 bg-light">การประหยัดพลังงาน</td>
                                        <td><span class="badge bg-success">ประหยัดแบตเตอรี่สูงมาก 🔋</span></td>
                                        <td><span class="badge bg-secondary">ใช้พลังงานปานกลาง-สูง 🪫</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-3 bg-light">ตัวอย่างการนำไปใช้</td>
                                        <td>ส่งค่าเซนเซอร์รวดเร็ว, Smart Home, ESP32</td>
                                        <td>ส่งรูปภาพขนาดใหญ่, Webhooks, LINE API</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- MQTT Topic Box -->
                        <div class="fun-card p-4 bg-dark text-white border-0">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <h5 class="fw-bold text-warning mb-2"><i class="bi bi-code-slash me-2"></i>เกร็ดความรู้: MQTT Topic & JSON Format 💡</h5>
                                    <p class="small text-light opacity-75 mb-3">
                                        โปรโตคอล MQTT ส่งข้อมูลผ่านสิ่งที่เรียกว่า <strong>"Topic"</strong> และนิยมห่อข้อมูลด้วย <strong>JSON</strong> ที่เบาและอ่านง่าย!
                                    </p>
                                    <div class="code-box small mb-2">
                                        <span class="text-info">// ตัวอย่าง Topic:</span> home/bedroom/dht11<br>
                                        <span class="text-info">// ตัวอย่าง Payload (JSON):</span><br>
                                        { <span class="text-warning">"temp"</span>: 28.5, <span class="text-warning">"humidity"</span>: 65.0 }
                                    </div>
                                </div>
                                <div class="col-md-5 text-center mt-3 mt-md-0">
                                    <div class="p-3 bg-secondary bg-opacity-25 rounded-4 border border-secondary">
                                        <i class="bi bi-diagram-3 fa-2x text-info mb-2"></i>
                                        <h6 class="fw-bold text-white mb-1">Publisher ➔ Broker ➔ Subscriber</h6>
                                        <small class="text-light opacity-75 d-block">เซนเซอร์ส่งค่าเข้า Broker ใครเปิดฟัง Topic ไหน ก็จะได้รับข้อมูลทันที!</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 📡 3. Wireless Networks -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                            <span class="fs-3">📡</span> 3. เครือข่ายไร้สายสำหรับ IoT (Wireless Networks)
                        </h3>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="fun-card p-4 h-100 border-start border-4 border-success">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <span class="fs-2 text-success"><i class="bi bi-wifi"></i></span>
                                        <div>
                                            <h5 class="fw-bold mb-0">ระยะใกล้ (Short-Range)</h5>
                                            <small class="text-muted">เหมาะในบ้าน อาคาร ระยะไม่เกิน 100 เมตร</small>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled space-y-2 mb-0 small">
                                        <li class="mb-2"><strong class="text-success"><i class="bi bi-check-circle-fill me-1"></i> Wi-Fi:</strong> ความเร็วสูง แต็กินไฟเยอะ</li>
                                        <li class="mb-2"><strong class="text-success"><i class="bi bi-check-circle-fill me-1"></i> Bluetooth / BLE:</strong> กินไฟต่ำมาก เหมาะกับอุปกรณ์สวมใส่</li>
                                        <li><strong class="text-success"><i class="bi bi-check-circle-fill me-1"></i> Zigbee:</strong> ต่อกันเป็น Mesh Network เชื่อมหลอดไฟ/สวิตช์</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fun-card p-4 h-100 border-start border-4 border-warning">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <span class="fs-2 text-warning"><i class="bi bi-broadcast"></i></span>
                                        <div>
                                            <h5 class="fw-bold mb-0">ระยะไกล (Long-Range LPWAN)</h5>
                                            <small class="text-muted">ครอบคลุมระดับอำเภอ/เมือง (หลายกิโลเมตร)</small>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled space-y-2 mb-0 small">
                                        <li class="mb-2"><strong class="text-warning text-dark"><i class="bi bi-check-circle-fill me-1"></i> LoRaWAN:</strong> ส่งข้อมูลไกลข้ามเขา ใช้พลังงานต่ำมาก</li>
                                        <li class="mb-2"><strong class="text-warning text-dark"><i class="bi bi-check-circle-fill me-1"></i> NB-IoT:</strong> ส่งผ่านเสาสัญญาณค่ายมือถือ ครอบคลุมทั่วประเทศ</li>
                                        <li><strong class="text-warning text-dark"><i class="bi bi-check-circle-fill me-1"></i> 4G / 5G:</strong> ส่งคลิปวิดีโอ/รูปภาพความเร็วสูง</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 🔒 4. IoT Security & CoAP -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                            <span class="fs-3">🛡️</span> 4. ความปลอดภัย & โปรโตคอล CoAP
                        </h3>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="fun-card p-4 h-100">
                                    <h5 class="fw-bold text-primary mb-3"><i class="bi bi-shield-lock-fill me-2"></i> CoAP Protocol</h5>
                                    <p class="text-muted small mb-3">
                                        <strong>Constrained Application Protocol (CoAP)</strong> ออกแบบมาสำหรับไมโครคอนโทรลเลอร์ขนาดเล็กมากๆ ทำงานบน UDP เพื่อประหยัดพลังงาน
                                    </p>
                                    <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-3 small">✨ จุดเด่น: สื่อสารกับ HTTP Web Server ได้ง่าย</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fun-card p-4 h-100">
                                    <h5 class="fw-bold text-danger mb-3"><i class="bi bi-key-fill me-2"></i> IoT Security Essentials</h5>
                                    <ul class="list-group list-group-flush small">
                                        <li class="list-group-item bg-transparent px-0"><strong class="text-dark">🔒 Encryption:</strong> เข้ารหัสข้อมูลระหว่างรับส่ง (SSL/TLS)</li>
                                        <li class="list-group-item bg-transparent px-0"><strong class="text-dark">🔑 Authentication:</strong> ยืนยันตัวตนด้วย Token / Secret Key</li>
                                        <li class="list-group-item bg-transparent px-0"><strong class="text-dark">🔄 OTA Updates:</strong> อัปเดตเฟิร์มแวร์เพื่อปิดช่องโหว่</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 💡 Case Studies -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <div class="fun-card p-4 p-md-5 text-white" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
                            <h4 class="fw-bold text-warning mb-4"><i class="bi bi-lightbulb-fill me-2"></i> ตัวอย่างกรณีศึกษาการเลือกใช้งาน (Case Studies)</h4>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="p-3 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-10">
                                        <h6 class="fw-bold text-info">🏡 Smart Home ควบคุมไฟผ่านบอร์ด ESP32</h6>
                                        <p class="small text-light opacity-75 mb-0">
                                            <strong>ควรเลือกใช้:</strong> <span class="badge bg-primary">Wi-Fi</span> + <span class="badge bg-success">MQTT</span><br>
                                            ต้องการการรับส่งคำสั่งสั้นๆ ที่รวดเร็ว เรียลไทม์
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-10">
                                        <h6 class="fw-bold text-pink" style="color: var(--accent-pink);">📸 ระบบ Edge AI สแกนใบหน้าเข้าเรียน</h6>
                                        <p class="small text-light opacity-75 mb-0">
                                            <strong>ควรเลือกใช้:</strong> <span class="badge bg-primary">Wi-Fi/4G</span> + <span class="badge bg-warning text-dark">HTTP REST API</span><br>
                                            ต้องการส่งรูปภาพขนาดใหญ่และแจ้งเตือนผ่าน LINE Notify
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 📝 Quiz & Summary Box -->
                    <section class="mt-5 position-relative" style="z-index: 1;">
                        <div class="card border-0 rounded-4 text-white shadow-lg overflow-hidden" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
                            <div class="card-body p-4 p-md-5 text-center">
                                <h3 class="fw-bold mb-3">🎉 เรียนรู้เนื้อหาบทนี้เรียบร้อยแล้วหรือยัง?</h3>
                                <p class="mb-4 text-white-50 small lh-lg px-md-5">
                                    การเลือกสถาปัตยกรรมและโปรโตคอลที่เหมาะสมจะช่วยให้ระบบ IoT ของคุณทำงานได้อย่างเสถียรและประหยัดพลังงานมากที่สุด!
                                </p>
                                
                                <a href="https://docs.google.com/forms/d/e/1FAIpQLScoOgV2SLMrkakptt6XYHXzffs3P8uOtkPpwnXTDIgOhns0Rg/viewform?usp=publish-editor" 
                                   target="_blank" 
                                   class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary btn-playful pulse-btn">
                                   ✍️ ทำแบบทดสอบวัดความรู้ บทที่ 2
                                </a>
                            </div>
                        </div>
                    </section>

                    <!-- Navigation Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-5 position-relative" style="z-index: 1;">
                        <a href="lesson1.php" class="btn btn-outline-secondary rounded-pill px-4 btn-playful">
                            <i class="bi bi-arrow-left me-1"></i> ย้อนกลับบทที่ 1
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
    </script>
</body>
</html>
