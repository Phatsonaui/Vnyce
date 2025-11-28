<?php

/**
 * FAQ Section - แสดงคำถามที่พบบ่อยทั้งหมดของคลินิก
 */
?>
<style>
    /* FAQ Section */
    .faq {
        background: var(--bg-card);
    }

    .faq-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .faq-item {
        margin-bottom: 15px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .faq-question {
        background: var(--bg-body);
        padding: 20px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 500;
    }

    .faq-answer {
        background: white;
        padding: 0 20px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease, padding 0.3s ease;
    }

    .faq-item.active .faq-answer {
        padding: 20px;
        max-height: 500px;
    }

    .faq-question i {
        transition: transform 0.3s ease;
    }

    .faq-item.active .faq-question i {
        transform: rotate(180deg);
    }

    .read-more {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
</style>
<section class="section faq" id="faq">
    <div class="container">
        <div class="section-header">
            <h2>คำถามที่พบบ่อย</h2>
            <p>ตอบคำถามที่ลูกค้ามักสงสัย</p>
        </div>

        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">
                    <span>การรักษาใช้เวลานานเท่าไหร่?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>ระยะเวลาขึ้นอยู่กับประเภทของการรักษา โดยทั่วไปใช้เวลาระหว่าง 30 นาทีถึง 2 ชั่วโมง สำหรับการปรึกษาเบื้องต้นใช้เวลาประมาณ 15-30 นาที</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>หลังการรักษาต้องพักฟื้นหรือไม่?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>สำหรับบริการส่วนใหญ่ไม่ต้องพักฟื้น สามารถใช้ชีวิตประจำวันได้ทันที ยกเว้นบางบริการที่อาจมีอาการบวมแดงเล็กน้อยซึ่งจะหายไปภายใน 1-2 วัน</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>ต้องมาทำกี่ครั้งถึงจะเห็นผล?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>จำนวนครั้งขึ้นอยู่กับสภาพผิวและบริการที่เลือก โดยทั่วไปจะเห็นผลชัดเจนหลังจากทำครบ 3-5 ครั้ง และแนะนำให้มาบำรุงรักษาทุก 1-2 เดือน</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>มีผลข้างเคียงหรือไม่?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>บริการของเราใช้เทคโนโลยีที่ปลอดภัยและได้รับการรับรอง ผลข้างเคียงมีน้อยมาก อาจมีเพียงอาการบวมแดงชั่วคราวซึ่งจะหายไปภายในไม่กี่ชั่วโมง</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>สามารถนัดหมายล่วงหน้าได้กี่วัน?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>สามารถนัดหมายล่วงหน้าได้สูงสุด 30 วัน เพื่อความมั่นใจในวันและเวลาที่ต้องการ แนะนำให้นัดหมายล่วงหน้าอย่างน้อย 3-5 วัน</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>มีบริการในวันหยุดหรือไม่?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>เรามีบริการในวันจันทร์-ศุกร์: เปิดให้บริการเวลา 16:30-21:00 น. และวันเสาร์-อาทิตย์: เปิดให้บริการเวลา 10:00-21:00 น.</p>
                </div>
            </div>
        </div>
    </div>
</section>