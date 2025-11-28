<?php

/**
 * About Section - แสดงเกี่ยวกับของคลินิก
 */
?>
<style>
    /* About Section */
    .about {
        background: var(--bg-accent);
    }

    .about-content {
        display: flex;
        align-items: center;
        gap: 60px;
    }

    .about-text {
        flex: 1;
    }

    .about-image {
        flex: 1;
    }

    .about-image img {
        width: 100%;
        border-radius: 20px;
        box-shadow: var(--shadow-lg);
    }
</style>
<section class="section about" id="about">
    <div class="container">
        <div class="section-header">
            <h2>เกี่ยวกับ V'nyce Clinic</h2>
            <p>คลินิกความงามระดับพรีเมียมที่ให้บริการด้วยความเชี่ยวชาญและมาตรฐานสูง</p>
        </div>

        <div class="about-content">
            <div class="about-text">
                <h3>ความงามที่คุณไว้วางใจได้</h3>
                <p>V'nyce Clinic ก่อตั้งขึ้นในปี 2025 ด้วยความมุ่งมั่นที่จะนำเสนอบริการความงามระดับพรีเมียม ด้วยทีมแพทย์และผู้เชี่ยวชาญในวงการความงาม</p>
                <p>เราให้ความสำคัญกับความปลอดภัยและผลลัพธ์ที่ยั่งยืน โดยใช้เทคโนโลยีล่าสุดและผลิตภัณฑ์คุณภาพสูงที่ได้รับการรับรองจากองค์การอาหารและยา (อย.)</p>
                <p>เรามีความภาคภูมิใจที่ได้ช่วยเหลือลูกค้ามากกว่า 5,000 ราย ให้กลับมามีความมั่นใจในตัวเองอีกครั้ง</p>
            </div>
            <div class="about-image">
                <img src="/img/about-image.jpg" alt="เกี่ยวกับ V'nyce Clinic" onerror="this.src='https://images.unsplash.com/photo-1551076805-e1869033e561?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1332&q=80'">
            </div>
        </div>
    </div>
</section>