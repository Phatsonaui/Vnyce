<?php

/**
 * promotions Section - แสดงโปรโมชั่นพิเศษทั้งหมดของคลินิก
 */
?>
<style>
    /* Promotions Section */
    .promotions {
        background: var(--bg-accent);
    }

    .promo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .promo-card {
        background: var(--bg-card);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        position: relative;
        transition: all 0.3s ease;
    }

    .promo-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-lg);
    }

    .hot-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #FF4757;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: 600;
        z-index: 2;
    }

    .promo-image {
        height: 200px;
        overflow: hidden;
    }

    .promo-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .promo-card:hover .promo-image img {
        transform: scale(1.1);
    }

    .promo-content {
        padding: 25px;
    }

    .promo-content h3 {
        margin-bottom: 10px;
    }

    .promo-price {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .old-price {
        text-decoration: line-through;
        color: var(--text-muted);
    }

    .new-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
    }
</style>
<section class="section promotions" id="promotions">
    <div class="container">
        <div class="section-header">
            <h2>โปรโมชั่นพิเศษ</h2>
            <p>แพ็คเกจลดราคาพิเศษสำหรับลูกค้าใหม่และลูกค้าประจำ</p>
        </div>

        <div class="promo-grid">
            <div class="promo-card">
                <div class="hot-badge">HOT</div>
                <div class="promo-image">
                    <img src="/img/promo1.jpg" alt="โปรโมชั่น 1" onerror="this.src='https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80'">
                </div>
                <div class="promo-content">
                    <h3>แพ็คเกจลดสิว</h3>
                    <p>ลดสิวอักเสบและรอยแดงอย่างได้ผล 3 ครั้ง</p>
                    <div class="promo-price">
                        <span class="old-price">4,500 บาท</span>
                        <span class="new-price">3,200 บาท</span>
                    </div>
                    <button class="cta-button" data-service="แพ็คเกจลดสิว">จองตอนนี้</button>
                </div>
            </div>

            <div class="promo-card">
                <div class="hot-badge">HOT</div>
                <div class="promo-image">
                    <img src="/img/promo2.jpg" alt="โปรโมชั่น 2" onerror="this.src='https://images.unsplash.com/photo-1599351431202-1e0f0137899a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=688&q=80'">
                </div>
                <div class="promo-content">
                    <h3>แพ็คเกจผิวขาว</h3>
                    <p>ฉีดวิตามินผิวขาว 5 ครั้ง พร้อมดูแลอย่างใกล้ชิด</p>
                    <div class="promo-price">
                        <span class="old-price">7,500 บาท</span>
                        <span class="new-price">5,900 บาท</span>
                    </div>
                    <button class="cta-button" data-service="แพ็คเกจผิวขาว">จองตอนนี้</button>
                </div>
            </div>

            <div class="promo-card">
                <div class="hot-badge">HOT</div>
                <div class="promo-image">
                    <img src="/img/promo3.jpg" alt="โปรโมชั่น 3" onerror="this.src='https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80'">
                </div>
                <div class="promo-content">
                    <h3>แพ็คเกจเลเซอร์</h3>
                    <p>กำจัดขนถาวร 6 ครั้ง พร้อมดูแลผิวหลังทำ</p>
                    <div class="promo-price">
                        <span class="old-price">12,000 บาท</span>
                        <span class="new-price">9,500 บาท</span>
                    </div>
                    <button class="cta-button" data-service="แพ็คเกจเลเซอร์">จองตอนนี้</button>
                </div>
            </div>
        </div>
    </div>
</section>