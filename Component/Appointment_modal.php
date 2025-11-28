<?php

/**
 * Appointment Modal Component
 * ฟอร์มนัดหมายบริการ
 */
?>
<div class="modal" id="appointmentModal" role="dialog" aria-labelledby="modalTitle" aria-modal="true">
    <div class="modal-content">
        <button class="close-modal" id="closeModal" aria-label="ปิดหน้าต่าง">&times;</button>
        <h2 id="modalTitle">นัดหมายบริการ</h2>
        <p style="color: var(--text-muted); margin-bottom: 20px;">กรอกข้อมูลเพื่อนัดหมายบริการ เราจะติดต่อกลับภายใน 24 ชั่วโมง</p>

        <form id="appointmentForm" method="POST" action="/process-appointment.php">
            <div class="form-group">
                <label for="name">ชื่อ-นามสกุล <span style="color: red;">*</span></label>
                <input type="text" id="name" name="name" required
                    placeholder="กรอกชื่อ-นามสกุล"
                    aria-required="true">
            </div>

            <div class="form-group">
                <label for="phone">เบอร์โทรศัพท์ <span style="color: red;">*</span></label>
                <input type="tel" id="phone" name="phone" required
                    placeholder="0XX-XXX-XXXX"
                    pattern="[0-9]{10}"
                    aria-required="true">
            </div>

            <div class="form-group">
                <label for="email">อีเมล</label>
                <input type="email" id="email" name="email"
                    placeholder="example@email.com">
            </div>

            <div class="form-group">
                <label for="service">บริการที่สนใจ <span style="color: red;">*</span></label>
                <select id="service" name="service" required aria-required="true">
                    <option value="">เลือกบริการ</option>
                    <option value="skin-care">ดูแลผิวพรรณ</option>
                    <option value="acne-treatment">ลดสิวและรอยสิว</option>
                    <option value="whitening">ฉีดผิวขาว</option>
                    <option value="laser">เลเซอร์กำจัดขน</option>
                    <option value="botox">Botox</option>
                    <option value="filler">Filler</option>
                    <option value="consultation">ปรึกษาฟรี</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date">วันที่ต้องการนัดหมาย <span style="color: red;">*</span></label>
                <input type="date" id="date" name="date" required
                    min="<?php echo date('Y-m-d'); ?>"
                    aria-required="true">
            </div>

            <div class="form-group">
                <label for="time">เวลาที่ต้องการ</label>
                <select id="time" name="time">
                    <option value="">เลือกเวลา (ถ้าต้องการ)</option>
                    <option value="10:00">10:00 น.</option>
                    <option value="11:00">11:00 น.</option>
                    <option value="12:00">12:00 น.</option>
                    <option value="13:00">13:00 น.</option>
                    <option value="14:00">14:00 น.</option>
                    <option value="15:00">15:00 น.</option>
                    <option value="16:00">16:00 น.</option>
                    <option value="17:00">17:00 น.</option>
                    <option value="18:00">18:00 น.</option>
                    <option value="19:00">19:00 น.</option>
                    <option value="20:00">20:00 น.</option>
                </select>
            </div>

            <div class="form-group">
                <label for="message">ข้อความเพิ่มเติม</label>
                <textarea id="message" name="message"
                    placeholder="บอกเราเกี่ยวกับความต้องการของคุณ..."
                    rows="4"></textarea>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="checkbox" name="consent" required aria-required="true">
                    <span style="font-size: 0.9rem;">ฉันยินยอมให้เก็บข้อมูลส่วนบุคคล <span style="color: red;">*</span></span>
                </label>
            </div>

            <button type="submit" class="cta-button" style="width: 100%; margin-top: 10px;">
                <i class="fas fa-calendar-check"></i> ส่งคำนัดหมาย
            </button>

            <p style="text-align: center; margin-top: 15px; font-size: 0.85rem; color: var(--text-muted);">
                หรือโทรเลย: <a href="tel:0938955999" style="color: var(--primary); font-weight: 600;">093-895-5999</a>
            </p>
        </form>
    </div>
</div>

<style>
    /* Additional Modal Styles */
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(186, 154, 139, 0.1);
    }

    .form-group input[type="checkbox"] {
        width: auto;
        cursor: pointer;
    }

    /* Success Message */
    .success-message {
        background: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: none;
    }

    .success-message.show {
        display: block;
    }
</style>