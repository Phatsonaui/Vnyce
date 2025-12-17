<?php

/**
 * Header Component - Navigation และ Mobile Menu
 */
?>
<header>
    <div class="container header-container">
        <a href="#home" class="logo" aria-label="V'nyce Clinic หน้าหลัก">
            <div class="logo-icon">
                <img src="/img/V'NYCE.jpg" alt="V'NYCE Clinic Logo" width="40" height="40">
            </div>
            <div class="logo-text">V'<span>nyce</span></div>
        </a>

        <nav aria-label="เมนูหลัก">
            <ul>
                <li><a href="#home">หน้าหลัก</a></li>
                <li><a href="#about">เกี่ยวกับเรา</a></li>
                <li><a href="#services">บริการ</a></li>
                <li><a href="#pricing">ราคา</a></li>
                <li><a href="#promotions">โปรโมชั่น</a></li>
                <li><a href="#testimonials">รีวิว</a></li>
                <li><a href="#contact">ติดต่อเรา</a></li>
            </ul>
        </nav>

        <button class="cta-button" id="appointmentBtn" aria-label="สมัครสมาชิก">สมัครสมาชิก</button>

        <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="เปิดเมนู" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu" role="navigation" aria-label="เมนูมือถือ">
        <ul>
            <li><a href="#home">หน้าหลัก</a></li>
            <li><a href="#about">เกี่ยวกับเรา</a></li>
            <li><a href="#services">บริการ</a></li>
            <li><a href="#pricing">ราคา</a></li>
            <li><a href="#promotions">โปรโมชั่น</a></li>
            <li><a href="#testimonials">รีวิว</a></li>
            <li><a href="#contact">ติดต่อเรา</a></li>
            <li><a href="#" id="mobileAppointmentBtn">สมัครสมาชิก</a></li>
        </ul>
    </div>
</header>