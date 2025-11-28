<?php

/**
 * Testimonials Section - แสดงเสียงตอบรับจากลูกค้าทั้งหมดของคลินิก
 */
?>
<style>
    /* Testimonials */
    .testimonials {
        background: var(--bg-card);
    }

    .testimonial-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .testimonial-card {
        background: var(--bg-body);
        padding: 30px;
        border-radius: 20px;
        position: relative;
    }

    .testimonial-card::before {
        content: '"';
        position: absolute;
        top: 10px;
        left: 20px;
        font-size: 4rem;
        color: var(--primary-light);
        font-family: 'Playfair Display', serif;
        line-height: 1;
    }

    .testimonial-content {
        margin-top: 20px;
        color: var(--text-muted);
        font-style: italic;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 20px;
    }

    .author-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
    }

    .author-info h4 {
        margin-bottom: 5px;
    }

    .author-info p {
        color: var(--text-muted);
        font-size: 0.9rem;
    }
</style>
<section class="section testimonials" id="testimonials">
    <div class="container">
        <div class="section-header">
            <h2>เสียงตอบรับจากลูกค้า</h2>
            <p>ความพึงพอใจของลูกค้าคือแรงผลักดันที่ดีที่สุดของเรา</p>
        </div>

        <div class="testimonial-grid">
            <div class="testimonial-card">
                <div class="testimonial-content">
                    บริการดีมากค่ะ คุณหมอให้คำแนะนำอย่างละเอียด ทำให้ผิวดีขึ้นอย่างเห็นได้ชัด ขอบคุณ V'nyce มากๆ ค่ะ
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">A</div>
                    <div class="author-info">
                        <h4>อัญชลี สมใจ</h4>
                        <p>ลูกค้าประจำ</p>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-content">
                    แรกๆ กลัวมากเลยค่ะ แต่พนักงานดูแลดีมาก บรรยากาศในคลินิกก็สบายใจ ตอนนี้ผิวใสขึ้นมากจนเพื่อนทัก!
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">P</div>
                    <div class="author-info">
                        <h4>ปุณยาพร จันทร์ทอง</h4>
                        <p>ลูกค้าใหม่</p>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-content">
                    ใช้บริการมา 3 ครั้งแล้ว รู้สึกว่าผิวดีขึ้นทุกครั้ง ราคาสมเหตุสมผล คุ้มค่ากับคุณภาพที่ได้รับมากค่ะ
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">S</div>
                    <div class="author-info">
                        <h4>สุมาลี วิเศษ</h4>
                        <p>ลูกค้าประจำ</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>