<?php

/**
 * Appointment Modal Component
 * ฟอร์มนัดหมายบริการ
 */
?>

<style>
    /* ==================== MODAL OVERLAY ==================== */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(74, 52, 40, 0.7);
        backdrop-filter: blur(8px);
        z-index: 10000;
        align-items: center;
        justify-content: center;
        padding: 20px;
        animation: fadeIn 0.3s ease;
        overflow-y: auto;
    }

    .modal.active {
        display: flex;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* ==================== MODAL CONTENT ==================== */
    .modal-content {
        background: white;
        border-radius: 24px;
        width: 100%;
        max-width: 680px;
        max-height: 90vh;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(74, 52, 40, 0.25);
        animation: slideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        position: relative;
    }

    @keyframes slideUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* ==================== MODAL HEADER ==================== */
    .modal-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        padding: 32px;
        position: relative;
        overflow: hidden;
    }

    .modal-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .modal-header-content {
        position: relative;
        z-index: 1;
    }

    .modal-title {
        color: white;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .modal-title i {
        font-size: 32px;
    }

    .modal-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 15px;
        font-weight: 400;
    }

    .close-modal {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        z-index: 2;
    }

    .close-modal:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg) scale(1.1);
    }

    /* ==================== MODAL BODY ==================== */
    .modal-body {
        padding: 32px;
        overflow-y: auto;
        max-height: calc(90vh - 180px);
    }

    /* Custom Scrollbar */
    .modal-body::-webkit-scrollbar {
        width: 8px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: var(--bg-accent);
        border-radius: 10px;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: var(--primary-light);
        border-radius: 10px;
        transition: background 0.3s ease;
    }

    .modal-body::-webkit-scrollbar-thumb:hover {
        background: var(--primary);
    }

    /* Firefox Scrollbar */
    .modal-body {
        scrollbar-width: thin;
        scrollbar-color: var(--primary-light) var(--bg-accent);
    }

    /* ==================== FORM SECTIONS ==================== */
    .form-section {
        margin-bottom: 32px;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title i {
        color: var(--primary);
        font-size: 20px;
    }

    /* ==================== FORM GROUPS ==================== */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .required {
        color: var(--error);
        margin-left: 4px;
    }

    /* ==================== INPUTS ==================== */
    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        font-size: 15px;
        font-family: 'Prompt', sans-serif;
        color: var(--text-dark);
        background: white;
        transition: all 0.3s ease;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(186, 154, 139, 0.1);
        transform: translateY(-2px);
    }

    .form-input::placeholder {
        color: var(--text-muted);
    }

    .form-textarea {
        min-height: 100px;
        resize: vertical;
    }

    /* Input with Icon */
    .input-group {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 18px;
        pointer-events: none;
        transition: color 0.3s ease;
    }

    .input-group .form-input,
    .input-group .form-select {
        padding-left: 48px;
    }

    .input-group .form-input:focus~.input-icon,
    .input-group .form-select:focus~.input-icon {
        color: var(--primary);
    }

    /* ==================== GRID LAYOUT ==================== */
    .form-grid {
        display: grid;
        gap: 20px;
    }

    .form-grid-2 {
        grid-template-columns: repeat(2, 1fr);
    }

    /* ==================== INFO BOX ==================== */
    .info-box {
        background: linear-gradient(135deg, var(--bg-accent) 0%, #fff 100%);
        border-left: 4px solid var(--primary);
        padding: 16px;
        border-radius: 12px;
        margin-bottom: 24px;
        display: flex;
        gap: 12px;
        align-items: start;
    }

    .info-box i {
        color: var(--primary);
        font-size: 24px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .info-box-content p {
        color: var(--text-dark);
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 8px;
    }

    .info-box-content p:last-child {
        margin-bottom: 0;
    }

    /* ==================== CHECKBOX ==================== */
    .checkbox-wrapper {
        display: flex;
        align-items: start;
        gap: 12px;
        cursor: pointer;
    }

    .checkbox-wrapper input[type="checkbox"] {
        width: 20px;
        height: 20px;
        border: 2px solid var(--border-color);
        border-radius: 6px;
        cursor: pointer;
        flex-shrink: 0;
        margin-top: 2px;
        transition: all 0.3s ease;
    }

    .checkbox-wrapper input[type="checkbox"]:checked {
        background: var(--primary);
        border-color: var(--primary);
    }

    .checkbox-wrapper label {
        font-size: 14px;
        color: var(--text-dark);
        cursor: pointer;
        margin: 0;
    }

    /* ==================== MODAL FOOTER ==================== */
    .modal-footer {
        padding: 24px 32px;
        border-top: 1px solid var(--border-color);
        background: var(--bg-accent);
        display: flex;
        gap: 12px;
    }

    /* ==================== BUTTONS ==================== */
    .btn {
        padding: 14px 28px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        font-family: 'Prompt', sans-serif;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }

    .btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        flex: 1;
        box-shadow: 0 4px 12px rgba(186, 154, 139, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(186, 154, 139, 0.4);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .btn-secondary {
        background: white;
        color: var(--text-dark);
        border: 2px solid var(--border-color);
    }

    .btn-secondary:hover {
        background: var(--bg-accent);
        border-color: var(--primary);
    }

    /* ==================== CONTACT INFO ==================== */
    .contact-info {
        text-align: center;
        padding: 20px;
        background: linear-gradient(135deg, var(--bg-accent) 0%, white 100%);
        border-radius: 12px;
        margin-top: 24px;
    }

    .contact-info p {
        color: var(--text-muted);
        font-size: 14px;
        margin-bottom: 12px;
    }

    .contact-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .contact-link:hover {
        color: var(--primary-dark);
        transform: scale(1.05);
    }

    .contact-link i {
        font-size: 20px;
    }

    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 768px) {
        .modal {
            padding: 10px;
            align-items: flex-start;
        }

        .modal-content {
            border-radius: 20px;
            max-height: calc(100vh - 20px);
        }

        .modal-header {
            padding: 24px;
        }

        .modal-title {
            font-size: 24px;
        }

        .modal-title i {
            font-size: 28px;
        }

        .modal-body {
            padding: 24px;
            max-height: calc(100vh - 200px);
        }

        .form-grid-2 {
            grid-template-columns: 1fr;
        }

        .modal-footer {
            padding: 20px 24px;
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }

        .section-title {
            font-size: 16px;
        }
    }

    /* ==================== DEMO BUTTON ==================== */
    .demo-btn {
        padding: 16px 32px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(186, 154, 139, 0.3);
        transition: all 0.3s ease;
    }

    .demo-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(186, 154, 139, 0.4);
    }

    /* ==================== ACCESSIBILITY ==================== */
    .modal:focus-visible {
        outline: none;
    }

    .btn:focus-visible,
    .form-input:focus-visible,
    .form-select:focus-visible,
    .form-textarea:focus-visible {
        outline: 3px solid var(--primary);
        outline-offset: 2px;
    }
</style>
<div class="modal" id="appointmentModal" role="dialog" aria-labelledby="modalTitle" aria-modal="true">
    <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
            <button class="close-modal" id="closeModal" aria-label="ปิดหน้าต่าง" onclick="closeAppointmentModalEnhanced()">
                <i class="fas fa-times"></i>
            </button>
            <div class="modal-header-content">
                <h2 id="modalTitle">สมัครสมาชิก V'nyce Clinic</h2>
                <p style="color: var(--text-muted); margin-bottom: 20px;">กรอกข้อมูลเพื่อเริ่มต้นใช้บริการ รับสิทธิพิเศษและโปรโมชั่นสุดคุ้ม</p>
            </div>
        </div>

        <!-- Body with Scrollbar -->
        <div class="modal-body">
            <div id="appointmentForm">
                <!-- Info Box -->
                <!-- <div class="info-box">
                    <i class="fas fa-info-circle"></i>
                    <div class="info-box-content">
                        <p><strong>ขั้นตอนการนัดหมาย:</strong></p>
                        <p>1. กรอกข้อมูลให้ครบถ้วน</p>
                        <p>2. เราจะโทรกลับเพื่อยืนยันนัดหมายภายใน 24 ชั่วโมง</p>
                        <p>3. เตรียมตัวมาใช้บริการตามวันและเวลาที่นัดหมาย</p>
                    </div>
                </div> -->

                <!-- Section 1: ข้อมูลส่วนตัว -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-user"></i>
                        ข้อมูลส่วนตัว
                    </h3>

                    <div class="form-group">
                        <label for="regPrefix">คำนำหน้า <span class="required" style="color: red;">*</span></label>
                        <div class="input-group">
                            <select id="regPrefix" name="regPrefix" class="form-select" required aria-required="true">
                                <option value="">เลือกคำนำหน้า</option>
                                <option value="01">นาย</option>
                                <option value="02">นาง</option>
                                <option value="03">นางสาว</option>
                            </select>
                            <i class="input-icon fas fa-user"></i>
                        </div>
                    </div>
                    <div class="form-grid form-grid-2">
                        <div class="form-group">
                            <label for="regFirstName">ชื่อ <span class="required" style="color: red;">*</span></label>
                            <div class="input-group">
                                <input type="text" id="regFirstName" name="regFirstName" class="form-input" required
                                    placeholder="กรอกชื่อ"
                                    aria-required="true">
                                <i class="input-icon fas fa-user"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="regLastName">นามสกุล <span class="required" style="color: red;">*</span></label>
                            <div class="input-group">
                                <input type="text" id="regLastName" name="regLastName" class="form-input" required
                                    placeholder="กรอกนามสกุล"
                                    aria-required="true">
                                <i class="input-icon fas fa-user"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-grid form-grid-2">
                        <div class="form-group">
                            <label for="regPhone">เบอร์โทรศัพท์ <span class="required" style="color: red;">*</span></label>
                            <div class="input-group">
                                <input type="tel"
                                    id="regPhone"
                                    name="regPhone"
                                    class="form-input"
                                    placeholder="0XX-XXX-XXXX"
                                    pattern="[0-9]{10}"
                                    required
                                    aria-required="true">
                                <i class="input-icon fas fa-phone"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="regEmail">อีเมล</label>
                            <div class="input-group">
                                <input type="email"
                                    id="regEmail"
                                    name="regEmail"
                                    class="form-input"
                                    placeholder="example@email.com">
                                <i class="input-icon fas fa-envelope"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="regBirthDate">วันเกิด <span style="color: red;" class="required">*</span></label>
                        <div class="input-group">
                            <input type="date"
                                id="regBirthDate"
                                name="regBirthDate"
                                class="form-input"
                                required
                                aria-required="true">
                            <i class="input-icon fas fa-calendar"></i>
                        </div>
                    </div>
                </div>

                <!-- Section 4: ยินยอม -->
                <div class="form-section">
                    <div class="form-group">
                        <div class="checkbox-wrapper">
                            <input type="checkbox"
                                name="consent"
                                id="consent"
                                required
                                aria-required="true">
                            <label for="consent">
                                ฉันยินยอมให้เก็บข้อมูลส่วนบุคคลเพื่อการติดต่อและให้บริการ <span class="required">*</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="contact-info">
                    <p>ติดต่อเราโดยตรง:</p>
                    <a href="tel:0938955999" class="contact-link">
                        <i class="fas fa-phone"></i>
                        093-895-5999
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeAppointmentModalEnhanced()">
                <i class="fas fa-times"></i>
                ยกเลิก
            </button>
            <button type="submit" class="btn btn-primary" onclick="submitAppointmentForm()">
                <i class="fas fa-check"></i>
                สมัครสมาชิก
            </button>
        </div>
    </div>
</div>

<script>
    // Set minimum date to today
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');
        if (dateInput) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.setAttribute('min', today);
        }

        // Close modal when clicking outside
        const appointmentModal = document.getElementById('appointmentModal');
        if (appointmentModal) {
            appointmentModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeAppointmentModalEnhanced();
                }
            });
        }

        // Close with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('appointmentModal');
                if (modal && modal.classList.contains('active')) {
                    closeAppointmentModalEnhanced();
                }
            }
        });
    });

    // Open Modal
    function openAppointmentModalEnhanced() {
        const modal = document.getElementById('appointmentModal');
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    // Close Modal
    function closeAppointmentModalEnhanced() {
        const modal = document.getElementById('appointmentModal');
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }

    // Submit Form
    function submitAppointmentForm() {
        var prefix = document.getElementById('regPrefix').value;
        var firstName = document.getElementById('regFirstName').value;
        var lastName = document.getElementById('regLastName').value;
        var phone = document.getElementById('regPhone').value;
        var birthDate = document.getElementById('regBirthDate').value;
        var email = document.getElementById('regEmail').value;

        if (phone === "" || phone.length !== 10) {
            Swal.fire({
                icon: 'error',
                title: 'กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง',
                timer: 3000,
                timerProgressBar: true
            });
        } else {
            var formData = new FormData();
            formData.append("prefix", prefix);
            formData.append("firstName", firstName);
            formData.append("lastName", lastName);
            formData.append("phone", phone);
            formData.append("birthDate", birthDate);
            formData.append("email", email);

            $.ajax({
                type: 'POST',
                url: 'config/ctrl_register.php',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'สมัครสมาชิกสำเร็จ',
                            text: 'กรุณาลงชื่อเข้าใช้',
                            timer: 3000,
                            timerProgressBar: true
                        });
                        setTimeout(() => {
                            showLogin();
                            document.getElementById('tel').value = response.tel;
                        }, 2000);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: response.message,
                            timer: 3000,
                            timerProgressBar: true
                        });
                        btn.disabled = false;
                        btn.textContent = 'สมัครสมาชิก';
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์a',
                        timer: 3000,
                        timerProgressBar: true
                    });
                    btn.disabled = false;
                    btn.textContent = 'สมัครสมาชิก';
                }
            });
        }
        // const form = document.getElementById('appointmentForm');
        // if (form && form.checkValidity()) {
        //     alert('✅ ส่งคำนัดหมายสำเร็จ!\n\nเราจะติดต่อกลับภายใน 24 ชั่วโมง\nหรือโทรเลย: 093-895-5999');
        //     closeAppointmentModalEnhanced();
        //     form.reset();
        // } else if (form) {
        //     form.reportValidity();
        // }
    }
</script>