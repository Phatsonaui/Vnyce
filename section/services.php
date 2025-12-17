<?php

/**
 * Services Section - แสดงบริการทั้งหมดของคลินิก
 */
?>
<style>
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .service-card {
        background: var(--bg-card);
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        animation: fadeInUp 0.8s ease forwards;
        opacity: 0;
    }

    .service-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .service-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .service-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .service-card:nth-child(4) {
        animation-delay: 0.4s;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-md);
    }

    .service-icon {
        width: 70px;
        height: 70px;
        background: var(--bg-accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: var(--primary);
        font-size: 28px;
    }

    .service-card h3 {
        margin-bottom: 15px;
        font-size: 1.5rem;
    }

    .service-card p {
        color: var(--text-muted);
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .services-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="section" id="services">
    <div class="container">
        <div class="section-header">
            <h2>บริการของเรา</h2>
            <p>ออกแบบมาเพื่อตอบโจทย์ทุกความต้องการด้านความงามของคุณ</p>
        </div>

        <div class="services-grid">
            <article class="service-card" itemscope itemtype="https://schema.org/Service">
                <div class="service-icon">
                    <i class="fas fa-spa"></i>
                </div>
                <h3 itemprop="name">ดูแลผิวพรรณ</h3>
                <p itemprop="description">ทรีตเมนต์ฟื้นฟูผิวให้กระจ่างใส ลดเลือนริ้วรอย และรูขุมขน ด้วยเทคโนโลยีล้ำสมัยและสูตรเฉพาะของ V'nyce</p>
                <button class="cta-button service-detail-btn" data-service="skin-care" aria-label="เรียนรู้เพิ่มเติมเกี่ยวกับบริการดูแลผิวพรรณ">เรียนรู้เพิ่มเติม</button>
            </article>

            <article class="service-card" itemscope itemtype="https://schema.org/Service">
                <div class="service-icon">
                    <i class="fas fa-cut"></i>
                </div>
                <h3 itemprop="name">กดลดสิวและรอยสิว</h3>
                <p itemprop="description">เทคโนโลยีรักษาสิวอักเสบ ควบคุมความมัน และลดรอยแดง ด้วยเลเซอร์และสารสกัดจากธรรมชาติ</p>
                <button class="cta-button service-detail-btn" data-service="acne-treatment" aria-label="เรียนรู้เพิ่มเติมเกี่ยวกับบริการลดสิว">เรียนรู้เพิ่มเติม</button>
            </article>

            <article class="service-card" itemscope itemtype="https://schema.org/Service">
                <div class="service-icon">
                    <i class="fas fa-syringe"></i>
                </div>
                <h3 itemprop="name">วิตามินผิวกาย</h3>
                <p itemprop="description">สูตรพิเศษสำหรับผิวขาวกระจ่างใสอย่างปลอดภัยและเห็นผล วิตามินเข้มข้นที่ช่วยฟื้นฟูผิวจากภายใน</p>
                <button class="cta-button service-detail-btn" data-service="whitening" aria-label="เรียนรู้เพิ่มเติมเกี่ยวกับบริการฉีดผิวขาว">เรียนรู้เพิ่มเติม</button>
            </article>

            <article class="service-card" itemscope itemtype="https://schema.org/Service">
                <div class="service-icon">
                    <i class="fa-solid fa-crosshairs"></i>
                </div>
                <h3 itemprop="name">เลเซอร์กำจัดขน</h3>
                <p itemprop="description">เทคโนโลยีล่าสุดสำหรับกำจัดขนถาวร ไม่เจ็บ ไม่เป็นตุ่ม เห็นผลตั้งแต่ครั้งแรกที่ทำ</p>
                <button class="cta-button service-detail-btn" data-service="laser" aria-label="เรียนรู้เพิ่มเติมเกี่ยวกับบริการเลเซอร์กำจัดขน">เรียนรู้เพิ่มเติม</button>
            </article>
        </div>
    </div>
</section>