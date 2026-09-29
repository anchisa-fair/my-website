<!-- ==================== FOOTER COMPONENT ==================== -->
<style>
    /* Footer Style & Theme Setup */
    .footer-custom {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: #94a3b8;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        position: relative;
        z-index: 10;
    }

    /* Quick Links Hover Animation */
    .footer-link {
        color: #94a3b8;
        transition: all 0.25s ease;
        display: inline-block;
    }

    .footer-link:hover {
        color: #818cf8 !important;
        transform: translateX(5px);
    }

    .footer-link i {
        font-size: 0.75rem;
        transition: transform 0.25s ease;
    }

    .footer-link:hover i {
        transform: translateX(2px);
    }

    /* Social Icons Styling */
    .social-icon {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
        color: #cbd5e1;
        text-decoration: none;
        font-size: 1.1rem;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .social-icon:hover {
        background: #4f46e5;
        color: #ffffff;
        transform: translateY(-4px) scale(1.08);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
        border-color: #6366f1;
    }

    /* Facebook Hover Specific */
    .social-icon.fb-icon:hover {
        background: #1877f2;
        border-color: #1877f2;
        box-shadow: 0 8px 20px rgba(24, 119, 242, 0.4);
    }

    /* YouTube Hover Specific */
    .social-icon.yt-icon:hover {
        background: #ff0000;
        border-color: #ff0000;
        box-shadow: 0 8px 20px rgba(255, 0, 0, 0.4);
    }

    /* Highlight Badges & Icons */
    .text-accent-primary {
        color: #818cf8 !important;
    }
</style>

<footer class="footer-custom pt-5 pb-4 mt-auto">
    <div class="container">
        <div class="row g-4 mb-4">
            
            <!-- Column 1: เกี่ยวกับระบบ -->
            <div class="col-lg-4 col-md-6">
                <h5 class="fw-bold text-white mb-3 d-flex align-items-center gap-2">
                    <span class="p-2 bg-primary bg-opacity-20 rounded-3 text-accent-primary d-inline-flex align-items-center justify-content-center">
                        <i class="bi bi-cpu fs-5"></i>
                    </span>
                    IoT Learning Platform
                </h5>
                <p class="small text-secondary lh-lg mb-0">
                    ระบบคลังความรู้ออนไลน์ รายวิชา อินเทอร์เน็ตของสรรพสิ่ง (Internet of Things) มุ่งเน้นการส่งเสริมทักษะด้านเทคโนโลยีสมองกลฝังตัวและระบบเครือข่ายไร้สาย เพื่อการประยุกต์ใช้งานจริงในยุคดิจิทัล
                </p>
            </div>

            <!-- Column 2: ลิงก์ด่วน -->
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold text-white mb-3">ลิงก์ด่วน</h5>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-2">
                        <a href="contact.php" class="footer-link text-decoration-none">
                            <i class="bi bi-chevron-right me-1 text-accent-primary"></i>ติดต่อเรา
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="login.php" class="footer-link text-decoration-none">
                            <i class="bi bi-chevron-right me-1 text-accent-primary"></i>เข้าสู่ระบบ
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="register.php" class="footer-link text-decoration-none">
                            <i class="bi bi-chevron-right me-1 text-accent-primary"></i>สมัครสมาชิก
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: การติดต่อ & โซเชียลมีเดีย -->
            <div class="col-lg-5 col-md-12">
                <h5 class="fw-bold text-white mb-3">การติดต่อ & โซเชียลมีเดีย</h5>
                <ul class="list-unstyled small text-secondary mb-3 lh-lg">
                    <li class="mb-2 d-flex align-items-start gap-2">
                        <i class="bi bi-geo-alt-fill text-accent-primary mt-1"></i>
                        <span>แผนกวิชาเทคโนโลยีธุรกิจดิจิทัล / วิทยาลัยการอาชีพขาณุวรลักษบุรี</span>
                    </li>
                    <li class="mb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-envelope-fill text-accent-primary"></i>
                        <span>ckhanupublic.re@ovec.moe.go.th</span>
                    </li>
                    <li class="mb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-telephone-fill text-accent-primary"></i>
                        <span>055-XXX-XXX</span>
                    </li>
                </ul>
                
                <!-- Social Icons -->
                <div class="d-flex gap-2 pt-1">
                    <a href="https://www.facebook.com/share/1Rtf3gauqj/?mibextid=wwXIfr" target="_blank" class="social-icon fb-icon" title="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="https://youtube.com/@khanuchannel?si=wigcEjTBzo0VfkwS" target="_blank" class="social-icon yt-icon" title="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="http://www.khanu.ac.th" target="_blank" class="social-icon" title="Website">
                        <i class="bi bi-globe"></i>
                    </a>
                </div>
            </div>

        </div>

        <!-- Divider Line -->
        <hr class="border-secondary opacity-25 my-4">

        <!-- Bottom Copyright Section -->
        <div class="row align-items-center small text-secondary">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                © 2026 <span class="text-white fw-medium">IoT Course Online</span>. All Rights Reserved.
            </div>
            <div class="col-md-6 text-center text-md-end">
                <span class="badge bg-white bg-opacity-10 text-secondary fw-normal px-3 py-2 rounded-pill">
                    🎓 ออกแบบเพื่อการศึกษาเทคโนโลยีและนวัตกรรมดิจิทัล
                </span>
            </div>
        </div>
    </div>
</footer>
