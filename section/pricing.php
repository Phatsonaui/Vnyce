<?php

/**
 * Testimonials Section - แสดงแพ็คเกจราคาทั้งหมดของคลินิก
 */
?>
<style>
    /* Pricing Section */
    .pricing {
        background: var(--bg-body);
    }

    .pricing-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .pricing-card {
        background: var(--bg-card);
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        position: relative;
    }

    .pricing-card.popular {
        transform: scale(1.05);
        border: 2px solid var(--primary);
    }

    .popular-badge {
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--primary);
        color: white;
        padding: 5px 15px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .pricing-card h3 {
        margin-bottom: 15px;
        font-size: 1.5rem;
    }

    .price {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 20px;
    }

    .price span {
        font-size: 1rem;
        color: var(--text-muted);
    }

    .pricing-features {
        list-style: none;
        margin-bottom: 30px;
        text-align: left;
    }

    .pricing-features li {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pricing-features i {
        color: var(--primary);
    }
</style>
<section class="section pricing" id="pricing">
    <div class="container">
        <div class="section-header">
            <h2>แพ็คเกจราคา</h2>
            <p>เลือกแพ็คเกจที่เหมาะกับความต้องการและงบประมาณของคุณ</p>
        </div>

        <div class="pricing-grid">
            <div class="pricing-card">
                <h3>แพ็คเกจพื้นฐาน</h3>
                <div class="price">1,500 <span>บาท/ครั้ง</span></div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> ปรึกษาฟรีกับผู้เชี่ยวชาญ</li>
                    <li><i class="fas fa-check"></i> ทำความสะอาดผิวหน้า</li>
                    <li><i class="fas fa-check"></i> ทรีตเมนต์พื้นฐาน</li>
                    <li><i class="fas fa-times"></i> วิตามินบำรุงผิว</li>
                    <li><i class="fas fa-times"></i> ดูแลหลังการรักษา</li>
                </ul>
                <button class="cta-button" data-service="แพ็คเกจพื้นฐาน">เลือกแพ็คเกจ</button>
            </div>

            <div class="pricing-card popular">
                <div class="popular-badge">แนะนำ</div>
                <h3>แพ็คเกจพรีเมียม</h3>
                <div class="price">3,500 <span>บาท/ครั้ง</span></div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> ปรึกษาฟรีกับผู้เชี่ยวชาญ</li>
                    <li><i class="fas fa-check"></i> ทำความสะอาดผิวหน้าลึก</li>
                    <li><i class="fas fa-check"></i> ทรีตเมนต์พรีเมียม</li>
                    <li><i class="fas fa-check"></i> วิตามินบำรุงผิว</li>
                    <li><i class="fas fa-check"></i> ดูแลหลังการรักษา 1 สัปดาห์</li>
                </ul>
                <button class="cta-button" data-service="แพ็คเกจพรีเมียม">เลือกแพ็คเกจ</button>
            </div>

            <div class="pricing-card">
                <h3>แพ็คเกจวีไอพี</h3>
                <div class="price">5,900 <span>บาท/ครั้ง</span></div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> ปรึกษาฟรีกับแพทย์ผู้เชี่ยวชาญ</li>
                    <li><i class="fas fa-check"></i> ทำความสะอาดผิวหน้าลึกพิเศษ</li>
                    <li><i class="fas fa-check"></i> ทรีตเมนต์วีไอพี</li>
                    <li><i class="fas fa-check"></i> วิตามินบำรุงผิวเกรดพรีเมียม</li>
                    <li><i class="fas fa-check"></i> ดูแลหลังการรักษา 2 สัปดาห์</li>
                </ul>
                <button class="cta-button" data-service="แพ็คเกจวีไอพี">เลือกแพ็คเกจ</button>
            </div>
        </div>
    </div>
</section>