<?php

/**
 * gallery Section - แสดงแพ็คเกจราคาทั้งหมดของคลินิก
 */
?>
<style>
    .gallery {
        background: var(--bg-body);
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .gallery-item {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        height: 250px;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    .gallery-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 20px;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
        color: white;
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        transform: translateY(0);
    }
</style>
<section class="section gallery" id="gallery">
    <div class="container">
        <div class="section-header">
            <h2>แกลเลอรี่ผลงาน</h2>
            <p>ผลลัพธ์ที่ได้จากบริการของเรา</p>
        </div>

        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="/img/gallery1.jpg" alt="ผลงาน 1" onerror="this.src='https://images.unsplash.com/photo-1599351431202-1e0f0137899a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=688&q=80'">
                <div class="gallery-overlay">
                    <h3>รักษาสิว</h3>
                    <p>ก่อนและหลังการรักษา 3 สัปดาห์</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="/img/gallery2.jpg" alt="ผลงาน 2" onerror="this.src='https://images.unsplash.com/photo-1559056199-641a0ac8b55e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80'">
                <div class="gallery-overlay">
                    <h3>ผิวขาวกระจ่างใส</h3>
                    <p>หลังฉีดวิตามิน 5 ครั้ง</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="/img/gallery3.jpg" alt="ผลงาน 3" onerror="this.src='https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80'">
                <div class="gallery-overlay">
                    <h3>ลดเลือนริ้วรอย</h3>
                    <p>ผลลัพธ์หลังการรักษา 2 เดือน</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="/img/gallery4.jpg" alt="ผลงาน 4" onerror="this.src='https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80'">
                <div class="gallery-overlay">
                    <h3>กำจัดขน</h3>
                    <p>ผลลัพธ์หลังทำเลเซอร์ 3 ครั้ง</p>
                </div>
            </div>
        </div>
    </div>
</section>