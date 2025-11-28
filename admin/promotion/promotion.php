<?php
// promotions.php
$db = new Database('u507667907_Vnyce');
$db->Table = "V_promotions";
$db->Where = "ORDER BY promo_id DESC";
$promotions = $db->Select();
?>

<script src="https://cdn.tailwindcss.com"></script>
<style>
    .promo-card {
        background: white;
        border-radius: 1rem;
        border: 1px solid rgba(186, 154, 139, 0.2);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .promo-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--primary-dark));
    }

    .promo-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(186, 154, 139, 0.15);
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .badge-percent {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-fixed {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-special {
        background: #fce7f3;
        color: #9f1239;
    }

    .badge-active {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-inactive {
        background: #fee2e2;
        color: #991b1b;
    }

    .badge-expired {
        background: #f3f4f6;
        color: #6b7280;
    }

    .modal {
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .form-section {
        background: rgba(186, 154, 139, 0.05);
        padding: 1.5rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
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

    .promo-type-selector {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .type-option {
        padding: 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.75rem;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
    }

    .type-option:hover {
        border-color: var(--primary-light);
        background: rgba(186, 154, 139, 0.05);
    }

    .type-option.active {
        border-color: var(--primary);
        background: rgba(186, 154, 139, 0.1);
    }

    .type-option input[type="radio"] {
        display: none;
    }
</style>

<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    <i class="bi bi-tag-fill mr-2" style="color: var(--primary);"></i>จัดการโปรโมชั่น
                </h1>
                <p class="text-gray-600 mt-2">สร้างและจัดการโปรโมชั่นสำหรับลูกค้า</p>
            </div>
            <button onclick="openAddModal()" class="px-6 py-3 text-white rounded-lg hover:opacity-90 transition flex items-center gap-2 shadow-lg" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark));">
                <i class="bi bi-plus-lg"></i>
                เพิ่มโปรโมชั่น
            </button>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-xl p-4 mb-6 shadow-sm border border-gray-200">
        <div class="flex flex-wrap gap-4 items-center">
            <div class="flex-1 min-w-[250px]">
                <div class="relative">
                    <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="searchInput" placeholder="ค้นหาโปรโมชั่น..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-offset-0 focus:ring-yellow-600">
                </div>
            </div>
            <select id="filterType" class="px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">ทุกประเภท</option>
                <option value="percent">ลดเปอร์เซ็นต์</option>
                <option value="fixed">ลดเงินสด</option>
                <option value="special">โปรพิเศษ</option>
            </select>
            <select id="filterStatus" class="px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">ทุกสถานะ</option>
                <option value="01">ใช้งาน</option>
                <option value="02">ปิดใช้งาน</option>
            </select>
        </div>
    </div>

    <!-- Promotions Grid -->
    <div id="promotionsList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (empty($promotions)): ?>
            <div class="col-span-full text-center py-12">
                <div class="w-24 h-24 mx-auto mb-4 rounded-full flex items-center justify-center" style="background: rgba(186, 154, 139, 0.1);">
                    <i class="bi bi-tag text-5xl" style="color: var(--primary);"></i>
                </div>
                <p class="text-gray-500 text-lg">ยังไม่มีโปรโมชั่น</p>
                <button onclick="openAddModal()" class="mt-4 px-6 py-2 text-white rounded-lg" style="background: var(--primary);">
                    เพิ่มโปรโมชั่นแรก
                </button>
            </div>
        <?php else: ?>
            <?php foreach ($promotions as $promo):
                // คำนวณสถานะ
                $now = time();
                $start = strtotime($promo['promo_start']);
                $end = strtotime($promo['promo_end']);
                $isActive = ($promo['promo_status'] == 'active');
                $isExpired = ($end < $now);
                $isUpcoming = ($start > $now);

                // กำหนด badge
                if ($isExpired) {
                    $statusBadge = '<span class="badge badge-expired"><i class="bi bi-clock-history"></i> หมดอายุ</span>';
                } elseif ($isUpcoming) {
                    $statusBadge = '<span class="badge badge-inactive"><i class="bi bi-hourglass-split"></i> รอเริ่ม</span>';
                } elseif ($isActive) {
                    $statusBadge = '<span class="badge badge-active"><i class="bi bi-check-circle"></i> ใช้งาน</span>';
                } else {
                    $statusBadge = '<span class="badge badge-inactive"><i class="bi bi-x-circle"></i> ปิดใช้งาน</span>';
                }

                // Type badge
                $typeBadge = '';
                switch ($promo['promo_type']) {
                    case 'percent':
                        $typeBadge = '<span class="badge badge-percent"><i class="bi bi-percent"></i> ลดเปอร์เซ็นต์</span>';
                        $discountText = $promo['promo_discount'] . '%';
                        break;
                    case 'fixed':
                        $typeBadge = '<span class="badge badge-fixed"><i class="bi bi-cash"></i> ลดเงิน</span>';
                        $discountText = '฿' . number_format($promo['promo_discount']);
                        break;
                    case 'special':
                        $typeBadge = '<span class="badge badge-special"><i class="bi bi-star"></i> พิเศษ</span>';
                        $discountText = '฿' . number_format($promo['promo_price']);
                        break;
                }

                // ดึงข้อมูลผู้สร้าง
                $dbUser = new Database('u507667907_Vnyce');
                $dbUser->Table = "V_User";
                $dbUser->Where = "WHERE v_id = '{$promo['promo_userAdd']}'";
                $creator = $dbUser->Select();
                $creatorName = !empty($creator) ? $creator[0]['v_fname'] . ' ' . $creator[0]['v_lname'] : 'ระบบ';
            ?>
                <div class="promo-card" data-type="<?= $promo['promo_type'] ?>" data-status="<?= $promo['promo_status'] ?>" data-name="<?= strtolower($promo['promo_name']) ?>">
                    <div class="p-6">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <?= $typeBadge ?>
                                    <?= $statusBadge ?>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-1"><?= htmlspecialchars($promo['promo_name']) ?></h3>
                            </div>
                            <div class="flex gap-2">
                                <button onclick='editPromotion(<?= json_encode($promo) ?>)' class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 transition" title="แก้ไข">
                                    <i class="bi bi-pencil text-gray-600"></i>
                                </button>
                                <button onclick="deletePromotion(<?= $promo['promo_id'] ?>)" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-red-50 transition" title="ลบ">
                                    <i class="bi bi-trash text-red-500"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Discount -->
                        <div class="mb-4 p-4 rounded-lg text-center" style="background: linear-gradient(135deg, rgba(186, 154, 139, 0.1), rgba(186, 154, 139, 0.05));">
                            <div class="text-sm text-gray-600 mb-1">ส่วนลด</div>
                            <div class="text-3xl font-bold" style="color: var(--primary-dark);"><?= $discountText ?></div>
                        </div>

                        <!-- Details -->
                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            <?php if (!empty($promo['promo_detail'])): ?>
                                <p class="line-clamp-2"><?= htmlspecialchars($promo['promo_detail']) ?></p>
                            <?php endif; ?>
                            <div class="flex items-center gap-2">
                                <i class="bi bi-calendar-range text-gray-400"></i>
                                <span><?= date('d/m/Y', strtotime($promo['promo_start'])) ?> - <?= date('d/m/Y', strtotime($promo['promo_end'])) ?></span>
                            </div>
                            <?php if (!empty($promo['promo_limit_times'])): ?>
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-person-check text-gray-400"></i>
                                    <span>จำกัดสิทธิ์ <?= $promo['promo_limit_times'] ?> ครั้ง/คน</span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Footer -->
                        <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                            <div class="flex items-center gap-1">
                                <i class="bi bi-person-circle"></i>
                                <span><?= htmlspecialchars($creatorName) ?></span>
                            </div>
                            <span><?= date('d/m/Y', strtotime($promo['promo_dateAdd'])) ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Add/Edit Modal -->
<div id="promoModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white z-10 p-6 border-b border-gray-200 rounded-t-xl" style="background: linear-gradient(135deg, var(--primary-light), var(--primary));">
            <div class="flex items-center justify-between">
                <h2 id="modalTitle" class="text-2xl font-bold text-white"></h2>
                <button onclick="closeModal()" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-gray-100 transition">
                    <i class="bi bi-x-lg text-gray-600"></i>
                </button>
            </div>
        </div>

        <form id="promoForm" class="p-6">
            <input type="hidden" id="promo_id" name="promo_id">
            <input type="hidden" id="promo_userAdd" name="promo_userAdd" value="<?= $_SESSION['admin_id'] ?? 1 ?>">

            <!-- Basic Info -->
            <div class="form-section">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="bi bi-info-circle mr-2" style="color: var(--primary);"></i>ข้อมูลพื้นฐาน
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="form-label">ชื่อโปรโมชั่น <span class="text-red-500">*</span></label>
                        <input type="text" id="promo_name" name="promo_name" class="form-input" required placeholder="เช่น ลด 20% ทุกบริการ">
                    </div>
                    <div>
                        <label class="form-label">รายละเอียด</label>
                        <textarea id="promo_detail" name="promo_detail" class="form-textarea" rows="3" placeholder="อธิบายรายละเอียดโปรโมชั่น..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Type & Discount -->
            <div class="form-section">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="bi bi-percent mr-2" style="color: var(--primary);"></i>ประเภทและส่วนลด
                </h3>
                <div class="promo-type-selector mb-4">
                    <label class="type-option">
                        <input type="radio" name="promo_type" value="percent" checked onchange="toggleDiscountFields()">
                        <div class="text-2xl mb-2"><i class="bi bi-percent"></i></div>
                        <div class="font-semibold text-sm">ลดเปอร์เซ็นต์</div>
                    </label>
                    <label class="type-option">
                        <input type="radio" name="promo_type" value="fixed" onchange="toggleDiscountFields()">
                        <div class="text-2xl mb-2"><i class="bi bi-cash"></i></div>
                        <div class="font-semibold text-sm">ลดเงินสด</div>
                    </label>
                    <label class="type-option">
                        <input type="radio" name="promo_type" value="special" onchange="toggleDiscountFields()">
                        <div class="text-2xl mb-2"><i class="bi bi-star"></i></div>
                        <div class="font-semibold text-sm">ราคาพิเศษ</div>
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div id="discountField">
                        <label class="form-label">ส่วนลด <span class="text-red-500">*</span></label>
                        <input type="number" id="promo_discount" name="promo_discount" class="form-input" min="0" step="0.01" placeholder="0">
                    </div>
                    <div id="priceField" style="display: none;">
                        <label class="form-label">ราคาพิเศษ <span class="text-red-500">*</span></label>
                        <input type="number" id="promo_price" name="promo_price" class="form-input" min="0" step="0.01" placeholder="0">
                    </div>
                </div>
            </div>

            <!-- Duration -->
            <div class="form-section">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="bi bi-calendar-range mr-2" style="color: var(--primary);"></i>ระยะเวลา
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">วันเริ่มต้น <span class="text-red-500">*</span></label>
                        <input type="date" id="promo_start" name="promo_start" class="form-input" required>
                    </div>
                    <div>
                        <label class="form-label">วันสิ้นสุด <span class="text-red-500">*</span></label>
                        <input type="date" id="promo_end" name="promo_end" class="form-input" required>
                    </div>
                </div>
            </div>

            <!-- Settings -->
            <div class="form-section">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="bi bi-gear mr-2" style="color: var(--primary);"></i>การตั้งค่า
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">จำกัดสิทธิ์ต่อคน</label>
                        <input type="number" id="promo_limit_times" name="promo_limit_times" class="form-input" min="0" placeholder="ไม่จำกัด">
                        <p class="text-xs text-gray-500 mt-1">เว้นว่างหากไม่จำกัด</p>
                    </div>
                    <div>
                        <label class="form-label">สถานะ <span class="text-red-500">*</span></label>
                        <select id="promo_status" name="promo_status" class="form-select" required>
                            <option value="01">ใช้งาน</option>
                            <option value="02">ปิดใช้งาน</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3">
                <button type="button" onclick="closeModal()" class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    ยกเลิก
                </button>
                <button type="submit" class="flex-1 px-6 py-3 text-white rounded-lg hover:opacity-90 transition" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark));">
                    <i class="bi bi-check-lg mr-2"></i>บันทึก
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Type selector active state
    document.querySelectorAll('.type-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.type-option').forEach(o => o.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Toggle discount fields based on type
    function toggleDiscountFields() {
        const type = document.querySelector('input[name="promo_type"]:checked').value;
        const discountField = document.getElementById('discountField');
        const priceField = document.getElementById('priceField');

        if (type === 'special') {
            discountField.style.display = 'none';
            priceField.style.display = 'block';
            document.getElementById('promo_discount').removeAttribute('required');
            document.getElementById('promo_price').setAttribute('required', 'required');
        } else {
            discountField.style.display = 'block';
            priceField.style.display = 'none';
            document.getElementById('promo_discount').setAttribute('required', 'required');
            document.getElementById('promo_price').removeAttribute('required');
        }
    }

    // Open add modal
    function openAddModal() {
        document.getElementById('modalTitle').innerHTML = '<i class="bi bi-plus-circle mr-2"></i>เพิ่มโปรโมชั่นใหม่';
        document.getElementById('promoForm').reset();
        document.getElementById('promo_id').value = '';
        document.querySelectorAll('.type-option')[0].classList.add('active');
        toggleDiscountFields();
        document.getElementById('promoModal').classList.remove('hidden');
    }

    // Edit promotion
    function editPromotion(promo) {
        document.getElementById('modalTitle').innerHTML = '<i class="bi bi-pencil mr-2"></i>แก้ไขโปรโมชั่น';
        document.getElementById('promo_id').value = promo.promo_id;
        document.getElementById('promo_name').value = promo.promo_name;
        document.getElementById('promo_detail').value = promo.promo_detail || '';
        document.getElementById('promo_discount').value = promo.promo_discount || '';
        document.getElementById('promo_price').value = promo.promo_price || '';
        document.getElementById('promo_start').value = promo.promo_start;
        document.getElementById('promo_end').value = promo.promo_end;
        document.getElementById('promo_limit_times').value = promo.promo_limit_times || '';
        document.getElementById('promo_status').value = promo.promo_status;

        // Set type
        document.querySelector(`input[name="promo_type"][value="${promo.promo_type}"]`).checked = true;
        document.querySelectorAll('.type-option').forEach(o => o.classList.remove('active'));
        document.querySelector(`input[name="promo_type"][value="${promo.promo_type}"]`).closest('.type-option').classList.add('active');
        toggleDiscountFields();

        document.getElementById('promoModal').classList.remove('hidden');
    }

    // Close modal
    function closeModal() {
        document.getElementById('promoModal').classList.add('hidden');
    }

    // Delete promotion
    function deletePromotion(id) {
        Swal.fire({
            title: 'ยืนยันการลบ?',
            text: 'คุณต้องการลบโปรโมชั่นนี้ใช่หรือไม่?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#BA9A8B',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'ใช่, ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                // Ajax delete
                $.ajax({
                    url: 'config/promotion_delete.php',
                    type: 'POST',
                    data: {
                        promo_id: id
                    },
                    success: function(response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบสำเร็จ!',
                                confirmButtonColor: '#BA9A8B'
                            }).then(() => location.reload());
                        }
                    }
                });
            }
        });
    }

    // Form submit
    document.getElementById('promoForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        console.log(...formData);

        $.ajax({
            url: '../config/ctrl_Promotions.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'บันทึกสำเร็จ!',
                        confirmButtonColor: '#BA9A8B'
                    }).then(() => location.reload());
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: response,
                        confirmButtonColor: '#BA9A8B'
                    });
                }
            }
        });
    });

    // Search & Filter
    document.getElementById('searchInput').addEventListener('input', filterPromotions);
    document.getElementById('filterType').addEventListener('change', filterPromotions);
    document.getElementById('filterStatus').addEventListener('change', filterPromotions);

    function filterPromotions() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const type = document.getElementById('filterType').value;
        const status = document.getElementById('filterStatus').value;

        document.querySelectorAll('.promo-card').forEach(card => {
            const name = card.dataset.name;
            const cardType = card.dataset.type;
            const cardStatus = card.dataset.status;

            const matchSearch = name.includes(search);
            const matchType = !type || cardType === type;
            const matchStatus = !status || cardStatus === status;

            card.style.display = (matchSearch && matchType && matchStatus) ? 'block' : 'none';
        });
    }
</script>