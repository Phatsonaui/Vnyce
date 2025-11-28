<?php

/**
 * Hero Section - ส่วนแรกของหน้าเว็บ
 * แสดงข้อความหลักและภาพหลักของคลินิก
 */
?>
<style>
    .hero {
        padding: 160px 0 100px;
        background: linear-gradient(135deg, var(--bg-accent) 0%, var(--bg-body) 100%);
        position: relative;
        overflow: hidden;
    }

    .hero-content {
        display: flex;
        align-items: center;
        gap: 60px;
    }

    .hero-text {
        flex: 1;
        animation: fadeInUp 1s ease;
    }

    .hero-text h1 {
        font-size: 3.5rem;
        margin-bottom: 20px;
        color: var(--text-dark);
    }

    .hero-text p {
        font-size: 1.2rem;
        margin-bottom: 30px;
        color: var(--text-muted);
    }

    .hero-image {
        flex: 1;
        position: relative;
        animation: float 6s ease-in-out infinite;
    }

    .hero-image img {
        width: 100%;
        border-radius: 20px;
        box-shadow: var(--shadow-lg);
    }

    @media (max-width: 992px) {
        .hero-content {
            flex-direction: column;
            text-align: center;
        }

        .hero-text {
            animation: none;
        }
    }

    @media (max-width: 768px) {
        .hero {
            padding: 120px 0 60px;
        }

        .hero-text h1 {
            font-size: 2.5rem;
        }

        .hero-text p {
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .hero-text h1 {
            font-size: 2rem;
        }
    }
</style>

<section class="hero" id="home">
    <div class="container hero-content">
        <div class="hero-text">
            <h1>เปล่งประกายความงาม ด้วยเทคโนโลยีระดับโลก</h1>
            <p>V'nyce Clinic ให้บริการดูแลผิวพรรณและความงามครบวงจร ด้วยทีมผู้เชี่ยวชาญและเทคโนโลยีทันสมัยที่ได้รับการรับรองจากมาตรฐานสากล</p>
            <button class="cta-button" id="heroAppointmentBtn">นัดหมายวันนี้</button>
        </div>
        <div class="hero-image">
            <img src="/img/V'NYCE.jpg"
                alt="คลินิกความงาม V'nyce Clinic ฉะเชิงเทรา - รักษาสิว ฉีดผิวขาว เลเซอร์ขน"
                onerror="this.src='https://images.unsplash.com/photo-1559056199-641a0ac8b55e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80'"
                loading="eager">
        </div>
    </div>
</section>