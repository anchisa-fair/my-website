<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
// include 'db_connect.php'; 
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

        .top-banner-wrapper {
            background-color: #0b1329;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
        .header-banner-img {
            max-height: 260px;
            object-fit: cover;
            object-position: center;
        }

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

        .navbar-custom {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 2px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            z-index: 1000;
        }

        .main-card {
            background: #ffffff;
            border: 2px solid #f1f5f9;
            border-radius: 28px;
            box-shadow: 0 15px 35px rgba(79, 70, 229, 0.06);
            position: relative;
            overflow: hidden;
        }

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

        .badge-pill-custom {
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table-custom-wrapper {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .code-box {
            background-color: #1e1e2e;
            color: #a6adc8;
            border-radius: 14px;
            font-family: monospace;
            padding: 1.2rem;
            line-height: 1.5;
            overflow-x: auto;
        }

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

        .pulse-btn {
            animation: pulseGlow 2s infinite;
        }
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.6); }
            70% { box-shadow: 0 0 0 15px rgba(79, 70, 229, 0); }
            100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); }
        }

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

        .accordion-button:not(.collapsed) {
            background-color: var(--primary-soft);
            color: var(--primary-color);
            font-weight: 600;
        }
        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0,0,0,.125);
        }
    </style>
</head>
<body>

    <div id="progress-bar"></div>

    <div class="top-banner-wrapper position-relative z-1 text-center">
        <a href="home.php">
            <img src="img/banner.png" alt="Internet of Things (IoT) Course & Principles" class="img-fluid w-100 header-banner-img">
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
                        <li class="breadcrumb-item active" aria-current="page">บทที่ 2: สถาปัตยกรรมและโปรโตคอลในระบบ IoT</li>
                    </ol>
                </nav>

                <div class="main-card p-4 p-md-5 position-relative">
                    <div class="floating-blob blob-1"></div>
                    <div class="floating-blob blob-2"></div>

                    <div class="border-bottom pb-4 mb-4 position-relative" style="z-index: 1;">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                            <span class="badge bg-primary badge-pill-custom">
                                📖 บทเรียนที่ 2
                            </span>
                            <span class="badge bg-purple text-white badge-pill-custom" style="background-color: var(--accent-purple);">
                                📡 Architecture & Protocols
                            </span>
                        </div>
                        <h1 class="fw-bold text-dark display-5 mb-3">
                            สถาปัตยกรรมและโปรโตคอล IoT 🚀
                        </h1>
                        <p class="text-muted fs-5 mb-0 lh-base">
                            เจาะลึกโครงสร้างพื้นฐานระดับองค์กร การเลือกใช้เครือข่ายให้เหมาะสมกับฮาร์ดแวร์ และการสื่อสารข้อมูลเบื้องหลังที่เชื่อมโยงอุปกรณ์อัจฉริยะเข้ากับโลกธุรกิจดิจิทัล
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
                                <!-- เปลี่ยน URL วิดีโอได้ที่นี่ -->
                                <iframe src="https://www.youtube.com/embed/G2KjpICYwQ8?si=_gEcHZvXhk9z92q9" title="IoT Architecture Video" allowfullscreen></iframe>
                            </div>
                        </div>
                    </section>

                    <!-- 🏗️ 1. IoT Architecture Section -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                            <span class="fs-3">🏗️️</span> 1. เจาะลึกสถาปัตยกรรมระบบ IoT (IoT Architecture)
                        </h3>
                        <p class="text-muted mb-4 fs-6">
                            สถาปัตยกรรม IoT คือกรอบแนวคิดในการจัดระเบียบการทำงานของระบบ ตั้งแต่การรับค่าจากเซนเซอร์ไปจนถึงการวิเคราะห์ข้อมูลเพื่อประกอบการตัดสินใจ การแบ่งชั้น (Layers) ช่วยให้นักพัฒนาแยกแยะและแก้ไขปัญหาได้ตรงจุด
                        </p>

                        <div class="row g-4 mb-4">
                            <!-- 3-Layer Card -->
                            <div class="col-lg-6">
                                <div class="fun-card p-4 h-100 border-start border-4 border-info">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="fw-bold text-info mb-0"><i class="bi bi-layers-fill me-2"></i>สถาปัตยกรรม 3 ชั้น</h5>
                                        <span class="badge bg-info bg-opacity-10 text-info badge-pill-custom">พื้นฐาน (Basic)</span>
                                    </div>
                                    <p class="text-muted small">โครงสร้างดั้งเดิมที่ใช้ในโปรเจกต์ขนาดเล็กหรือระบบที่ไม่ซับซ้อน ประกอบด้วย:</p>

                                    <div class="d-flex flex-column gap-3">
                                        <div class="p-3 rounded-4 bg-light border-start border-4 border-primary">
                                            <span class="badge bg-primary mb-1">Layer 3: Application</span>
                                            <strong class="d-block text-dark">ชั้นประยุกต์ใช้งาน</strong>
                                            <small class="text-muted">แอปพลิเคชันหรือแดชบอร์ดที่ผู้ใช้มองเห็น เช่น แอปพลิเคชันควบคุมไฟในบ้านบนสมาร์ทโฟน</small>
                                        </div>
                                        <div class="p-3 rounded-4 bg-light border-start border-4 border-success">
                                            <span class="badge bg-success mb-1">Layer 2: Network</span>
                                            <strong class="d-block text-dark">ชั้นเครือข่าย</strong>
                                            <small class="text-muted">ทำหน้าที่ส่งผ่านข้อมูลที่เก็บได้ไปยังเซิร์ฟเวอร์ โดยอาศัยเทคโนโลยีอย่าง Wi-Fi, 4G, 5G</small>
                                        </div>
                                        <div class="p-3 rounded-4 bg-light border-start border-4 border-warning">
                                            <span class="badge bg-warning text-dark mb-1">Layer 1: Perception</span>
                                            <strong class="d-block text-dark">ชั้นรับรู้ (ฮาร์ดแวร์)</strong>
                                            <small class="text-muted">ด่านหน้าสุดของระบบ คือตัวเซนเซอร์ (เช่น DHT11) หรือตัวสั่งการ (Actuator) ที่สัมผัสกับโลกกายภาพ</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 5-Layer Card -->
                            <div class="col-lg-6">
                                <div class="fun-card p-4 h-100 border-start border-4 border-purple" style="border-color: var(--accent-purple) !important;">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="fw-bold mb-0" style="color: var(--accent-purple);"><i class="bi bi-diagram-3-fill me-2"></i>สถาปัตยกรรม 5 ชั้น</h5>
                                        <span class="badge text-white badge-pill-custom" style="background-color: var(--accent-purple);">ระดับองค์กร (Advanced)</span>
                                    </div>
                                    <p class="text-muted small">โครงสร้างที่ขยายต่อยอดเพื่อรองรับ Big Data และการประมวลผลขั้นสูงในธุรกิจเชิงพาณิชย์:</p>

                                    <div class="d-flex flex-column gap-2">
                                        <div class="p-2 px-3 rounded-3 bg-light d-flex align-items-center gap-3">
                                            <span class="badge rounded-circle p-2 text-white" style="background-color: #4a148c;">5</span>
                                            <div><strong class="small text-dark">Business Layer:</strong> <span class="text-muted small">ชั้นการจัดการธุรกิจ นำข้อมูลมาวิเคราะห์เพื่อสร้าง Business Model หรือกราฟคาดการณ์</span></div>
                                        </div>
                                        <div class="p-2 px-3 rounded-3 bg-light d-flex align-items-center gap-3">
                                            <span class="badge rounded-circle p-2 text-white" style="background-color: #6a1b9a;">4</span>
                                            <div><strong class="small text-dark">Application Layer:</strong> <span class="text-muted small">ระบบแสดงผลและการแจ้งเตือนเฉพาะทาง</span></div>
                                        </div>
                                        <div class="p-2 px-3 rounded-3 bg-light d-flex align-items-center gap-3">
                                            <span class="badge rounded-circle p-2 text-white" style="background-color: #8e24aa;">3</span>
                                            <div><strong class="small text-dark">Processing Layer:</strong> <span class="text-muted small">เซิร์ฟเวอร์คลาวด์ ฐานข้อมูล และเทคโนโลยี AI สำหรับประมวลผล</span></div>
                                        </div>
                                        <div class="p-2 px-3 rounded-3 bg-light d-flex align-items-center gap-3">
                                            <span class="badge rounded-circle p-2 text-white" style="background-color: #ab47bc;">2</span>
                                            <div><strong class="small text-dark">Transport Layer:</strong> <span class="text-muted small">การเลือกใช้โปรโตคอลการขนส่ง (MQTT, HTTP, CoAP)</span></div>
                                        </div>
                                        <div class="p-2 px-3 rounded-3 bg-light d-flex align-items-center gap-3">
                                            <span class="badge rounded-circle p-2 text-dark" style="background-color: #ce93d8;">1</span>
                                            <div><strong class="small text-dark">Perception Layer:</strong> <span class="text-muted small">อุปกรณ์ Edge Devices เช่น บอร์ดไมโครคอนโทรลเลอร์ต่างๆ</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edge Computing Alert -->
                        <div class="alert border-primary border-start border-4 bg-primary bg-opacity-10 p-4 rounded-3">
                            <h5 class="fw-bold text-primary mb-2"><i class="bi bi-cpu-fill me-2"></i>ความรู้เพิ่มเติม: การประมวลผลที่ขอบข่าย (Edge Computing)</h5>
                            <p class="mb-0 small text-dark">
                                ในยุคปัจจุบัน ข้อมูลบางอย่างไม่จำเป็นต้องส่งขึ้น Cloud เสมอไป การใช้เทคโนโลยี <strong>Edge AI</strong> คือการฝัง AI ลงไปประมวลผลที่ฮาร์ดแวร์โดยตรง เช่น <strong>การใช้บอร์ด ESP32-CAM ประมวลผลจดจำใบหน้า (Face Recognition)</strong> ที่ตัวบอร์ดเองเลย เพื่อลดความหน่วง (Latency) และประหยัดแบนด์วิดท์เครือข่าย ส่งเพียงผลลัพธ์ว่า "ใครเข้าประตู" ไปยังเซิร์ฟเวอร์เท่านั้น!
                            </p>
                        </div>
                    </section>

                    <!-- 🔄 2. Data Protocols Comparison -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                            <span class="fs-3">🔄</span> 2. โปรโตคอลการสื่อสาร (IoT Protocols)
                        </h3>
                        <p class="text-muted mb-4 fs-6">
                            โปรโตคอลคือ "ภาษาและกฎเกณฑ์" ที่อุปกรณ์ใช้คุยกัน การเลือกโปรโตคอลผิดอาจทำให้ระบบอืด หรือแบตเตอรี่ของอุปกรณ์หมดไวเกินความจำเป็น
                        </p>
                        
                        <div class="table-custom-wrapper shadow-sm mb-4 overflow-x-auto">
                            <table class="table table-hover align-middle mb-0 text-center" style="min-width: 600px;">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="py-3 text-start ps-3" style="width: 20%;">คุณสมบัติ</th>
                                        <th class="py-3 text-primary" style="width: 25%;"><i class="bi bi-lightning-charge-fill me-1"></i> MQTT</th>
                                        <th class="py-3 text-success" style="width: 25%;"><i class="bi bi-globe me-1"></i> HTTP / REST API</th>
                                        <th class="py-3 text-danger" style="width: 25%;"><i class="bi bi-arrow-left-right me-1"></i> WebSockets</th>
                                    </tr>
                                </thead>
                                <tbody class="small">
                                    <tr>
                                        <td class="fw-bold text-start ps-3 bg-light">สถาปัตยกรรมการส่ง</td>
                                        <td>Publish / Subscribe (มี Broker ตรงกลาง)</td>
                                        <td>Request / Response (Client ร้องขอ, Server ตอบกลับ)</td>
                                        <td>Full-Duplex (เปิดช่องทางการเชื่อมต่อค้างไว้ตลอด)</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-3 bg-light">Overhead (ขนาดส่วนหัวข้อมูล)</td>
                                        <td class="text-primary fw-bold">⚡ เล็กมาก (เพียง 2 Bytes)</td>
                                        <td class="text-warning text-dark">📦 ใหญ่ (มี Header จำนวนมาก)</td>
                                        <td class="text-success">ปานกลาง</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-3 bg-light">การประหยัดพลังงาน</td>
                                        <td><span class="badge bg-success">ประหยัดแบตเตอรี่สูงมาก 🔋</span></td>
                                        <td><span class="badge bg-secondary">ใช้พลังงานปานกลาง-สูง 🪫</span></td>
                                        <td><span class="badge bg-secondary">กินไฟเพราะต้องต่อค้างไว้ 🪫</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-start ps-3 bg-light">การนำไปใช้งานที่เหมาะสม</td>
                                        <td>เซนเซอร์บ้านอัจฉริยะ, ส่งค่าอุณหภูมิ, ควบคุม Relay</td>
                                        <td>ส่งรูปภาพขนาดใหญ่, ทำ Webhooks เชื่อมต่อกับ LINE API</td>
                                        <td>การแสดงผลกราฟแดชบอร์ดแบบ Real-time บนหน้าเว็บ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
              
                    <!-- 📡 3. Wireless Networks -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                            <span class="fs-3">📡</span> 3. เทคโนโลยีเครือข่ายไร้สาย (Wireless Networks)
                        </h3>
                        <p class="text-muted mb-4 fs-6">พิจารณาจากการใช้งานจริงระหว่าง "ระยะทางที่ต้องการส่ง" กับ "ปริมาณข้อมูลที่ต้องการส่ง" (Bandwidth vs Range)</p>
                        
                        <div class="accordion" id="networkAccordion">
                            <!-- Short Range -->
                            <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button bg-white text-dark fw-bold" type="button" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                        <i class="bi bi-wifi text-primary me-2"></i> เครือข่ายระยะใกล้ (Short-Range & PAN/LAN)
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#networkAccordion">
                                    <div class="accordion-body bg-light text-muted small">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <strong class="text-dark d-block mb-1">Wi-Fi (802.11)</strong>
                                                รองรับความเร็วสูง ส่งวิดีโอหรือรูปภาพได้สบาย เหมาะสำหรับโมดูลพ่วงต่ออินเทอร์เน็ตที่เสียบปลั๊กไฟทิ้งไว้ตลอด (เช่น หลอดไฟอัจฉริยะ, กล้องวงจรปิด) ข้อเสียคือใช้พลังงานเยอะมาก
                                            </div>
                                            <div class="col-md-4">
                                                <strong class="text-dark d-block mb-1">Bluetooth / BLE</strong>
                                                Bluetooth Low Energy (BLE) ถูกออกแบบมาให้กินไฟต่ำเป็นพิเศษ ทำงานผ่านแบตเตอรี่กระดุมได้เป็นปีๆ เหมาะกับ Smart Watch, อุปกรณ์การแพทย์สวมใส่ หรือการเชื่อมต่อกับมือถือระยะประชิด
                                            </div>
                                            <div class="col-md-4">
                                                <strong class="text-dark d-block mb-1">Zigbee / Z-Wave</strong>
                                                มีความสามารถในการทำ <strong>Mesh Topology</strong> คืออุปกรณ์แต่ละตัวสามารถทำหน้าที่เป็นทวนสัญญาณส่งต่อให้กันเป็นทอดๆ ได้ นิยมใช้เชื่อมต่อเซนเซอร์ประตู สวิตช์ไฟ ในระบบ Home Automation ครบวงจร
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Long Range -->
                            <div class="accordion-item border-0 shadow-sm rounded-4 overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-white text-dark fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                        <i class="bi bi-broadcast-pin text-warning me-2"></i> เครือข่ายระยะไกล (LPWAN & Cellular)
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#networkAccordion">
                                    <div class="accordion-body bg-light text-muted small">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <strong class="text-dark d-block mb-1">LoRa / LoRaWAN</strong>
                                                เทคโนโลยีคลื่นวิทยุ ส่งผ่านสิ่งกีดขวางหรือป่าเขาได้ดีเยี่ยม ส่งข้อมูลได้ไกล 5-15 กิโลเมตร โดยใช้พลังงานน้อยมาก เหมาะสำหรับเซนเซอร์การเกษตร สมาร์ทฟาร์ม หรือการวัดระดับน้ำ
                                            </div>
                                            <div class="col-md-4">
                                                <strong class="text-dark d-block mb-1">NB-IoT (Narrowband IoT)</strong>
                                                ทำงานบนคลื่นความถี่มือถือที่ค่ายบริการ (AIS, True, Dtac) ติดตั้งไว้แล้ว มีความเสถียรและทะลุทะลวงอาคารได้ดี เหมาะสำหรับระบบมิเตอร์น้ำ/ไฟอัจฉริยะระดับเมือง หรือ Smart City
                                            </div>
                                            <div class="col-md-4">
                                                <strong class="text-dark d-block mb-1">4G LTE / 5G</strong>
                                                แบนด์วิดท์มหาศาล ความหน่วงต่ำมาก เหมาะกับการใช้งานที่ต้องสตรีมมิ่งข้อมูลจำนวนมหาศาลตลอดเวลา เช่น รถยนต์ไร้คนขับ (Autonomous Vehicles) หรือระบบวิเคราะห์วิดีโอ AI ระยะไกล
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 🔒 4. IoT Security -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <h3 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                            <span class="fs-3">🛡️</span> 4. ความปลอดภัยของระบบ (IoT Security Concepts)
                        </h3>
                        <div class="row g-4">
                            <div class="col-md-5">
                                <div class="fun-card p-4 h-100 bg-white border-top border-4 border-danger">
                                    <h5 class="fw-bold text-danger mb-3"><i class="bi bi-shield-x me-2"></i>ช่องโหว่ยอดฮิต</h5>
                                    <ul class="list-unstyled small text-muted space-y-2 mb-0">
                                        <li class="mb-2"><i class="bi bi-x-circle text-danger me-1"></i> การตั้งรหัสผ่าน Default (เช่น admin/admin) บนตัวฮาร์ดแวร์</li>
                                        <li class="mb-2"><i class="bi bi-x-circle text-danger me-1"></i> การส่งข้อมูลแบบ Plain Text ไม่เข้ารหัส ทำให้อาจถูกดักจับข้อมูลกลางทางได้ (Man-in-the-Middle)</li>
                                        <li><i class="bi bi-x-circle text-danger me-1"></i> ไม่อัปเดตเฟิร์มแวร์ ทำให้แฮกเกอร์โจมตีผ่านช่องโหว่เก่าๆ ได้</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="fun-card p-4 h-100 border-0" style="background-color: #f1f5f9;">
                                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-check-shield-fill text-success me-2"></i>หลักการ CIA Triad ใน IoT</h5>
                                    <div class="row g-3 small">
                                        <div class="col-sm-4">
                                            <div class="p-3 bg-white rounded-3 shadow-sm h-100">
                                                <strong class="text-primary d-block mb-1">C: Confidentiality</strong>
                                                <span class="text-muted">ความลับของข้อมูล: ปกป้องโดยการใช้ <strong>Encryption (TLS/SSL)</strong> หรือ MQTTS เมื่อสื่อสาร</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-3 bg-white rounded-3 shadow-sm h-100">
                                                <strong class="text-success d-block mb-1">I: Integrity</strong>
                                                <span class="text-muted">ความถูกต้อง: ตรวจสอบว่าข้อมูลไม่ถูกแก้ไขกลางทางด้วย <strong>Checksum / Hashing</strong></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-3 bg-white rounded-3 shadow-sm h-100">
                                                <strong class="text-warning text-dark d-block mb-1">A: Availability</strong>
                                                <span class="text-muted">ความพร้อมใช้งาน: ระบบต้องไม่ล่ม จัดทำระบบเซิร์ฟเวอร์สำรอง และป้องกันการโจมตีแบบ DDoS</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 p-2 bg-white rounded-3 border-start border-3 border-primary small">
                                        💡 <strong>การจัดการสิทธิ์ (Authentication):</strong> ในการเรียกใช้ API บริการภายนอก ควรใช้ <strong>Token/Bearer Keys</strong> แทนรหัสผ่านจริงเสมอ (เช่น การออก Line Notify Token สำหรับส่งข้อความแจ้งเตือน)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 💼 5. IoT & Digital Business -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <div class="p-4 p-md-5 rounded-4 shadow-sm" style="background-color: var(--primary-soft); border: 1px solid #c7d2fe;">
                            <h4 class="fw-bold text-primary mb-3"><i class="bi bi-bar-chart-steps me-2"></i> 5. โครงสร้าง IoT กับการต่อยอดธุรกิจดิจิทัล (IoT in Digital Business)</h4>
                            <p class="text-muted fs-6 mb-4">
                                สถาปัตยกรรม IoT ไม่ใช่แค่เรื่องของสายไฟและเซนเซอร์ แต่เป็น "ขุมทรัพย์ข้อมูล" ที่สามารถเปลี่ยนโมเดลธุรกิจ (Business Model Canvas) แบบดั้งเดิม ให้กลายเป็นธุรกิจดิจิทัลที่สร้างรายได้มหาศาล:
                            </p>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="bg-white p-4 rounded-3 h-100 shadow-sm border-0">
                                        <div class="d-flex align-items-center gap-3 mb-2">
                                            <div class="bg-info bg-opacity-10 text-info p-2 rounded-circle fs-5"><i class="bi bi-graph-up-arrow"></i></div>
                                            <h6 class="fw-bold mb-0">1. Data Monetization (การสร้างมูลค่าจากข้อมูล)</h6>
                                        </div>
                                        <p class="small text-muted mb-0 ps-5">
                                            ข้อมูลที่เก็บจาก Perception Layer สามารถนำมาวิเคราะห์พฤติกรรมผู้บริโภค เช่น ข้อมูลการใช้ไฟฟ้า หรืออุณหภูมิในบ้าน เพื่อเสนอขายสินค้าหรือบริการที่ตรงใจลูกค้าในเวลาที่ถูกต้อง (Personalized Marketing)
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-white p-4 rounded-3 h-100 shadow-sm border-0">
                                        <div class="d-flex align-items-center gap-3 mb-2">
                                            <div class="bg-success bg-opacity-10 text-success p-2 rounded-circle fs-5"><i class="bi bi-arrow-repeat"></i></div>
                                            <h6 class="fw-bold mb-0">2. Everything-as-a-Service (XaaS)</h6>
                                        </div>
                                        <p class="small text-muted mb-0 ps-5">
                                            เปลี่ยนจากการขายขาดฮาร์ดแวร์ เป็นการให้บริการแบบสมัครสมาชิก (Subscription Model) เช่น ให้บริการ "ระบบรักษาความปลอดภัยอัจฉริยะ" จ่ายรายเดือน แลกกับการอัปเดตซอฟต์แวร์และดูแลเซิร์ฟเวอร์
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 💡 Case Studies -->
                    <section class="mb-5 position-relative" style="z-index: 1;">
                        <div class="fun-card p-4 p-md-5 text-white" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
                            <h4 class="fw-bold text-warning mb-4"><i class="bi bi-lightbulb-fill me-2"></i> สรุปกรณีศึกษาและการเลือกใช้งานจริง (Real-world Scenarios)</h4>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="p-4 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-10 h-100">
                                        <h6 class="fw-bold text-info"><i class="bi bi-house-gear-fill me-2"></i> โปรเจกต์ Smart Home ควบคุมอัตโนมัติ</h6>
                                        <hr class="border-secondary my-2">
                                        <p class="small text-light opacity-75 mb-2">
                                            <strong>สถาปัตยกรรม:</strong> 3-Layer Basic<br>
                                            <strong>เครือข่าย & ฮาร์ดแวร์:</strong> บอร์ดไมโครคอนโทรลเลอร์ (เช่น NodeMCU/ESP32) เชื่อมต่อเครือข่าย <span class="badge bg-primary">Wi-Fi บ้าน</span><br>
                                            <strong>โปรโตคอลการสื่อสาร:</strong> <span class="badge bg-success">MQTT</span><br>
                                        </p>
                                        <p class="small text-white-50 mb-0">
                                            <em>เหตุผล:</em> ต้องการการตอบสนองคำสั่งเปิด-ปิดไฟแบบทันทีทันใด (Low Latency) และข้อมูลเซนเซอร์อุณหภูมิ/ความชื้นมีขนาดเล็ก ไม่จำเป็นต้องใช้แบนด์วิดท์สูง
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-4 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-10 h-100">
                                        <h6 class="fw-bold text-pink" style="color: var(--accent-pink);"><i class="bi bi-person-bounding-box me-2"></i> ระบบ Edge AI วิเคราะห์ใบหน้าเพื่อเข้างาน</h6>
                                        <hr class="border-secondary my-2">
                                        <p class="small text-light opacity-75 mb-2">
                                            <strong>สถาปัตยกรรม:</strong> 5-Layer พร้อม Edge Computing<br>
                                            <strong>เครือข่าย & ฮาร์ดแวร์:</strong> กล้องวงจรปิด/บอร์ดประมวลผลภาพ (เช่น ESP32-CAM) เชื่อมต่อ <span class="badge bg-primary">Wi-Fi / 4G</span><br>
                                            <strong>โปรโตคอลการสื่อสาร:</strong> <span class="badge bg-warning text-dark">HTTP REST API</span><br>
                                        </p>
                                        <p class="small text-white-50 mb-0">
                                            <em>เหตุผล:</em> ประมวลผลภาพที่ตัวขอบข่าย (Edge) จากนั้นส่งข้อมูลขนาดใหญ่หรือไฟล์ภาพถ่าย รวมถึงทำ Webhook ร่วมกับ Token เพื่อแจ้งเตือนรายงานผลผ่านแอปพลิเคชันภายนอกได้อย่างแม่นยำ
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
                                    การออกแบบโครงสร้างที่ดี และการเลือกโปรโตคอล/เครือข่ายที่ตอบโจทย์ตั้งแต่เริ่มต้น จะช่วยลดปัญหาในการขยายระบบ (Scalability) ลดต้นทุน และสามารถนำข้อมูลไปต่อยอดทางธุรกิจได้อย่างมีประสิทธิภาพสูงสุด!
                                </p>
                                
                                <a href="https://docs.google.com/forms/d/e/1FAIpQLScoOgV2SLMrkakptt6XYHXzffs3P8uOtkPpwnXTDIgOhns0Rg/viewform?usp=publish-editor" 
                                   target="_blank" 
                                   class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary btn-playful pulse-btn shadow">
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
