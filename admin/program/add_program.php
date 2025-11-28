<?php
session_start();

// ดึงข้อมูลโปรโมชั่นที่ใช้งานได้
$db = new Database('u507667907_Vnyce');
$db->Table = "V_promotions";
$db->Where = "WHERE promo_status = 'active' AND promo_start <= CURDATE() AND promo_end >= CURDATE()";
$activePromotions = $db->Select();

$programTypes = [
    ['id' => 1, 'name' => 'โปรแกรมดูแลผิวหน้า'],
    ['id' => 2, 'name' => 'โปรแกรมดูแลผิวกาย'],
    ['id' => 3, 'name' => 'โปรแกรมลดน้ำหนัก'],
    ['id' => 4, 'name' => 'โปรแกรมนวด/สปา'],
    ['id' => 5, 'name' => 'โปรแกรมอื่นๆ'],
];
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มโปรแกรมใหม่ - V'NYCE</title>
    <link rel="icon" href="img/V'NYCE.jpg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .form-section {
            background: var(--bg-card);
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(186, 154, 139, 0.1);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .section-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(186, 154, 139, 0.2);
        }

        .section-header h2 {
            font-size: 1.125rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .section-icon {
            width: 2rem;
            height: 2rem;
            background: var(--primary);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            color: white;
        }

        .section-body {
            padding: 1.5rem;
        }

        .form-grid {
            display: grid;
            gap: 1.5rem;
        }

        .form-grid-2 {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
        }

        .required {
            color: #ef4444;
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid rgba(186, 154, 139, 0.2);
            border-radius: 0.5rem;
            font-family: 'Prompt', sans-serif;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(186, 154, 139, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .help-text {
            color: #8B7968;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .image-upload {
            position: relative;
            border: 2px dashed rgba(186, 154, 139, 0.2);
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .image-upload:hover {
            border-color: var(--primary);
            background: rgba(186, 154, 139, 0.02);
        }

        .image-upload input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .image-preview {
            max-width: 300px;
            margin: 1rem auto;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .image-preview img {
            width: 100%;
            height: auto;
        }

        .btn {
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 0.5rem;
            font-family: 'Prompt', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(186, 154, 139, 0.3);
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* Promotion Section Styles */
        .promo-toggle {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            background: rgba(186, 154, 139, 0.05);
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .promo-toggle:hover {
            background: rgba(186, 154, 139, 0.1);
        }

        .toggle-switch {
            position: relative;
            width: 50px;
            height: 26px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.3s;
            border-radius: 34px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.3s;
            border-radius: 50%;
        }

        .toggle-switch input:checked+.toggle-slider {
            background-color: var(--primary);
        }

        .toggle-switch input:checked+.toggle-slider:before {
            transform: translateX(24px);
        }

        .promo-select-area {
            display: none;
            margin-top: 1rem;
            padding: 1rem;
            background: white;
            border-radius: 0.5rem;
            border: 1px solid rgba(186, 154, 139, 0.2);
        }

        .promo-select-area.active {
            display: block;
        }

        .price-display {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
            padding: 1rem;
            background: rgba(186, 154, 139, 0.05);
            border-radius: 0.5rem;
        }

        .price-item {
            text-align: center;
        }

        .price-label {
            font-size: 0.75rem;
            color: #8B7968;
            margin-bottom: 0.25rem;
        }

        .price-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .price-value.discounted {
            color: #ef4444;
        }

        .price-value.original {
            text-decoration: line-through;
            opacity: 0.5;
        }

        .discount-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: #ef4444;
            color: white;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>เพิ่มโปรแกรมใหม่</h1>
            <p>กรอกข้อมูลโปรแกรมที่ต้องการเพิ่มเข้าสู่ระบบ</p>
        </div>

        <input type="hidden" id="user_add" value="<?= $_SESSION['v_id'] ?? '' ?>">

        <!-- 1. ข้อมูลพื้นฐาน -->
        <div class="form-section">
            <div class="section-header">
                <h2>
                    <div class="section-icon"><i class="fas fa-info-circle"></i></div>
                    ข้อมูลพื้นฐาน
                </h2>
            </div>
            <div class="section-body">
                <div class="form-grid">
                    <div>
                        <label class="form-label">ชื่อโปรแกรม <span class="required">*</span></label>
                        <input type="text" id="prog_name" class="form-input" required placeholder="ระบุชื่อโปรแกรม">
                    </div>
                    <div>
                        <label class="form-label">รายละเอียด</label>
                        <textarea id="prog_detail" class="form-textarea" placeholder="อธิบายรายละเอียดของโปรแกรม"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. ราคาและคะแนน -->
        <div class="form-section">
            <div class="section-header">
                <h2>
                    <div class="section-icon"><i class="fas fa-tags"></i></div>
                    ราคาและคะแนน
                </h2>
            </div>
            <div class="section-body">
                <div class="form-grid form-grid-2">
                    <div>
                        <label class="form-label">ราคา (บาท) <span class="required">*</span></label>
                        <input type="number" id="prog_price" class="form-input" min="0" step="0.01" placeholder="0" required oninput="calculateDiscount()">
                    </div>
                    <div>
                        <label class="form-label">จำนวนรอบ <span class="required">*</span></label>
                        <input type="number" id="prog_rounds" class="form-input" min="1" placeholder="1" required>
                        <span class="help-text">จำนวนครั้งที่ใช้โปรแกรมได้</span>
                    </div>
                    <div>
                        <label class="form-label">คะแนน <span class="required">*</span></label>
                        <input type="number" id="prog_point" class="form-input" min="0" placeholder="0" required>
                        <span class="help-text">คะแนนที่ลูกค้าจะได้รับ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2.5 โปรโมชั่น (ใหม่) -->
        <div class="form-section">
            <div class="section-header">
                <h2>
                    <div class="section-icon"><i class="fas fa-percent"></i></div>
                    โปรโมชั่น (ถ้ามี)
                </h2>
            </div>
            <div class="section-body">
                <label class="promo-toggle">
                    <div class="toggle-switch">
                        <input type="checkbox" id="enablePromo" onchange="togglePromotion()">
                        <span class="toggle-slider"></span>
                    </div>
                    <div>
                        <div style="font-weight: 600;">เปิดใช้โปรโมชั่น</div>
                        <div style="font-size: 0.75rem; color: #8B7968;">เลือกโปรโมชั่นที่ต้องการใช้กับโปรแกรมนี้</div>
                    </div>
                </label>

                <div id="promoSelectArea" class="promo-select-area">
                    <label class="form-label">เลือกโปรโมชั่น</label>
                    <select id="prog_promo_id" class="form-select" onchange="calculateDiscount()">
                        <option value="">-- ไม่ใช้โปรโมชั่น --</option>
                        <?php foreach ($activePromotions as $promo): ?>
                            <option value="<?= $promo['promo_id'] ?>" data-type="<?= $promo['promo_type'] ?>" data-discount="<?= $promo['promo_discount'] ?>" data-price="<?= $promo['promo_price'] ?>">
                                <?= htmlspecialchars($promo['promo_name']) ?>
                                <?php
                                if ($promo['promo_type'] == 'percent') {
                                    echo " (ลด {$promo['promo_discount']}%)";
                                } elseif ($promo['promo_type'] == 'fixed') {
                                    echo " (ลด ฿" . number_format($promo['promo_discount']) . ")";
                                } else {
                                    echo " (ราคาพิเศษ ฿" . number_format($promo['promo_price']) . ")";
                                }
                                ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <div id="priceDisplay" class="price-display" style="display: none;">
                        <div class="price-item">
                            <div class="price-label">ราคาปกติ</div>
                            <div class="price-value original" id="originalPrice">฿0</div>
                        </div>
                        <div class="price-item">
                            <div class="price-label">ราคาหลังหักส่วนลด</div>
                            <div class="price-value discounted" id="discountedPrice">฿0</div>
                            <div class="discount-badge" id="discountBadge"></div>
                        </div>
                        <div class="price-item">
                            <div class="price-label">ส่วนลด</div>
                            <div class="price-value" id="savedAmount" style="color: #10b981;">฿0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. ระยะเวลา -->
        <div class="form-section">
            <div class="section-header">
                <h2>
                    <div class="section-icon"><i class="fas fa-calendar"></i></div>
                    ระยะเวลา
                </h2>
            </div>
            <div class="section-body">
                <div class="form-grid form-grid-2">
                    <div>
                        <label class="form-label">วันที่เริ่มต้น <span class="required">*</span></label>
                        <input type="date" id="prog_date_start" class="form-input" required>
                    </div>
                    <div>
                        <label class="form-label">วันที่สิ้นสุด <span class="required">*</span></label>
                        <input type="date" id="prog_date_end" class="form-input" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. ประเภทโปรแกรม -->
        <div class="form-section">
            <div class="section-header">
                <h2>
                    <div class="section-icon"><i class="fas fa-list"></i></div>
                    ประเภทโปรแกรม
                </h2>
            </div>
            <div class="section-body">
                <label class="form-label">เลือกประเภท <span class="required">*</span></label>
                <select id="prog_type" class="form-select" required>
                    <option value="">-- เลือกประเภทโปรแกรม --</option>
                    <?php foreach ($programTypes as $type): ?>
                        <option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- 5. รูปภาพ -->
        <div class="form-section">
            <div class="section-header">
                <h2>
                    <div class="section-icon"><i class="fas fa-image"></i></div>
                    รูปภาพโปรแกรม
                </h2>
            </div>
            <div class="section-body">
                <div class="image-upload">
                    <input type="file" id="prog_img" accept="image/*" required>
                    <div id="uploadPlaceholder">
                        <div style="width: 3rem; height: 3rem; background: #F6E4D2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <i class="fas fa-cloud-upload-alt" style="font-size: 1.5rem; color: var(--primary);"></i>
                        </div>
                        <p style="font-weight: 500; margin-bottom: 0.25rem;">คลิกเพื่อเลือกรูปภาพ</p>
                        <p class="help-text">รองรับ JPG, PNG ขนาดไม่เกิน 5MB</p>
                    </div>
                    <div id="imagePreview" class="image-preview" style="display: none;"></div>
                </div>
            </div>
        </div>

        <!-- ปุ่มจัดการ -->
        <div class="form-section">
            <div class="section-body">
                <div class="button-group">
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">
                        <i class="fas fa-undo"></i> รีเซ็ต
                    </button>
                    <button type="button" class="btn btn-primary" onclick="add_programs()">
                        <i class="fas fa-save"></i> บันทึกโปรแกรม
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePromotion() {
            const enabled = document.getElementById('enablePromo').checked;
            const selectArea = document.getElementById('promoSelectArea');
            selectArea.classList.toggle('active', enabled);
            if (!enabled) {
                document.getElementById('prog_promo_id').value = '';
                document.getElementById('priceDisplay').style.display = 'none';
            }
        }

        function calculateDiscount() {
            const price = parseFloat(document.getElementById('prog_price').value) || 0;
            const promoSelect = document.getElementById('prog_promo_id');
            const selectedOption = promoSelect.options[promoSelect.selectedIndex];

            if (!selectedOption.value || price === 0) {
                document.getElementById('priceDisplay').style.display = 'none';
                return;
            }

            const type = selectedOption.dataset.type;
            const discount = parseFloat(selectedOption.dataset.discount) || 0;
            const specialPrice = parseFloat(selectedOption.dataset.price) || 0;

            let finalPrice = price;
            let savedAmount = 0;
            let discountText = '';

            if (type === 'percent') {
                savedAmount = price * (discount / 100);
                finalPrice = price - savedAmount;
                discountText = `-${discount}%`;
            } else if (type === 'fixed') {
                savedAmount = discount;
                finalPrice = Math.max(0, price - discount);
                discountText = `-฿${discount.toFixed(0)}`;
            } else if (type === 'special') {
                finalPrice = specialPrice;
                savedAmount = price - specialPrice;
                discountText = 'ราคาพิเศษ';
            }

            document.getElementById('originalPrice').textContent = '฿' + price.toLocaleString('th-TH', {
                minimumFractionDigits: 2
            });
            document.getElementById('discountedPrice').textContent = '฿' + finalPrice.toLocaleString('th-TH', {
                minimumFractionDigits: 2
            });
            document.getElementById('savedAmount').textContent = '฿' + savedAmount.toLocaleString('th-TH', {
                minimumFractionDigits: 2
            });
            document.getElementById('discountBadge').textContent = discountText;
            document.getElementById('priceDisplay').style.display = 'grid';
        }

        // Preview image
        document.getElementById('prog_img').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'ไฟล์ใหญ่เกินไป',
                        text: 'กรุณาเลือกไฟล์ขนาดไม่เกิน 5MB',
                        confirmButtonColor: '#BA9A8B'
                    });
                    e.target.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('uploadPlaceholder').style.display = 'none';
                    const preview = document.getElementById('imagePreview');
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        function resetForm() {
            if (confirm('ต้องการรีเซ็ตฟอร์มใช่หรือไม่?')) {
                location.reload();
            }
        }

        function add_programs() {
            const formData = new FormData();
            formData.append("status", 'add_program');
            formData.append("prog_name", document.getElementById('prog_name').value);
            formData.append("prog_detail", document.getElementById('prog_detail').value);
            formData.append("prog_price", document.getElementById('prog_price').value);
            formData.append("prog_rounds", document.getElementById('prog_rounds').value);
            formData.append("prog_point", document.getElementById('prog_point').value);
            formData.append("prog_date_start", document.getElementById('prog_date_start').value);
            formData.append("prog_date_end", document.getElementById('prog_date_end').value);
            formData.append("prog_type", document.getElementById('prog_type').value);
            formData.append("prog_img", document.getElementById('prog_img').files[0]);
            formData.append("prog_userAdd", document.getElementById('user_add').value);

            // เพิ่ม promotion
            if (document.getElementById('enablePromo').checked) {
                formData.append("prog_promo_id", document.getElementById('prog_promo_id').value);
            }

            $.ajax({
                type: "POST",
                url: "../config/ctrl_Programs.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกสำเร็จ!',
                            confirmButtonColor: '#BA9A8B'
                        }).then(() => {
                            window.location.href = 'A_main.php?page=prog';
                        });
                    } else {
                        console.log(data);
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: data,
                            confirmButtonColor: '#BA9A8B'
                        });
                    }
                }
            });
        }
    </script>
</body>

</html>