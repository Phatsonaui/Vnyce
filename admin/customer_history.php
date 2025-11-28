<?php
// customer_program.php
$primaryColor = '#BA9A8B';
?>


<script>
    let selectedCustomer = null;
    let selectedProgram = null;

    document.addEventListener('DOMContentLoaded', function() {
        // Payment method change handler
        document.querySelectorAll('input[name="paymentMethod"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const transferDetails = document.getElementById('transferDetails');
                const cardDetails = document.getElementById('cardDetails');
                const paymentDetails = document.getElementById('paymentDetails');

                // Hide all
                if (transferDetails) transferDetails.style.display = 'none';
                if (cardDetails) cardDetails.style.display = 'none';
                if (paymentDetails) paymentDetails.style.display = 'none';

                // Show relevant
                if (this.value === 'transfer') {
                    if (paymentDetails) paymentDetails.style.display = 'block';
                    if (transferDetails) transferDetails.style.display = 'block';
                } else if (this.value === 'card') {
                    if (paymentDetails) paymentDetails.style.display = 'block';
                    if (cardDetails) cardDetails.style.display = 'block';
                }
            });
        });

        // Search customer
        const searchInput = document.getElementById('searchCustomer');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const search = e.target.value.toLowerCase();
                document.querySelectorAll('.customer-card').forEach(card => {
                    const name = card.dataset.name.toLowerCase();
                    card.style.display = name.includes(search) ? 'block' : 'none';
                });
            });
        }
    });

    // Select customer
    function selectCustomer(element) {
        // Remove previous selection
        document.querySelectorAll('.customer-card').forEach(c => c.classList.remove('selected'));
        element.classList.add('selected');

        selectedCustomer = {
            id: element.dataset.id,
            name: element.dataset.name
        };

        const selectedNameEl = document.getElementById('selectedCustomerName');
        const summaryCustomerEl = document.getElementById('summaryCustomer');
        if (selectedNameEl) selectedNameEl.textContent = selectedCustomer.name;
        if (summaryCustomerEl) summaryCustomerEl.textContent = selectedCustomer.name;

        // Enable step 2
        document.getElementById('step2').classList.add('active');

        // Load customer history
        loadCustomerHistory(selectedCustomer.id);
    }

    // Select program
    function selectProgram(element) {
        document.querySelectorAll('.program-item').forEach(p => p.classList.remove('selected'));
        element.classList.add('selected');

        selectedProgram = {
            id: element.dataset.id,
            name: element.dataset.name,
            price: parseFloat(element.dataset.price),
            rounds: element.dataset.rounds,
            days: element.dataset.days
        };

        const summaryProgramEl = document.getElementById('summaryProgram');
        const summaryRoundsEl = document.getElementById('summaryRounds');
        const summaryDaysEl = document.getElementById('summaryDays');

        if (summaryProgramEl) summaryProgramEl.textContent = selectedProgram.name;
        if (summaryRoundsEl) summaryRoundsEl.textContent = selectedProgram.rounds + ' ครั้ง';
        if (summaryDaysEl) summaryDaysEl.textContent = selectedProgram.days + ' วัน';

        // Enable step 3
        document.getElementById('step3').classList.add('active');

        calculateTotal();
    }

    // Calculate total
    function calculateTotal() {
        if (!selectedProgram) return;

        const originalPrice = selectedProgram.price;
        let finalPrice = originalPrice;
        let discount = 0;

        const promoSelect = document.getElementById('promotionSelect');
        if (!promoSelect) return;

        const selectedOption = promoSelect.options[promoSelect.selectedIndex];

        if (selectedOption.value) {
            const type = selectedOption.dataset.type;
            const discountValue = parseFloat(selectedOption.dataset.discount);
            const specialPrice = parseFloat(selectedOption.dataset.price);

            if (type === 'percent') {
                discount = originalPrice * (discountValue / 100);
                finalPrice = originalPrice - discount;
            } else if (type === 'fixed') {
                discount = discountValue;
                finalPrice = Math.max(0, originalPrice - discount);
            } else if (type === 'special') {
                finalPrice = specialPrice;
                discount = originalPrice - specialPrice;
            }
        }

        const originalPriceEl = document.getElementById('originalPrice');
        const discountAmountEl = document.getElementById('discountAmount');
        const totalPriceEl = document.getElementById('totalPrice');
        const discountRow = document.getElementById('discountRow');

        if (originalPriceEl) originalPriceEl.textContent = '฿' + originalPrice.toFixed(2);
        if (discountAmountEl) discountAmountEl.textContent = '-฿' + discount.toFixed(2);
        if (totalPriceEl) totalPriceEl.textContent = '฿' + finalPrice.toFixed(2);

        if (discountRow) {
            if (discount > 0) {
                discountRow.style.display = 'flex';
            } else {
                discountRow.style.display = 'none';
            }
        }
    }

    // Load customer history (now globally accessible)
    window.loadCustomerHistory = function(customerId) {
        console.log('Loading history for customer ID:', customerId);
        if (typeof $ === 'undefined') {
            console.error('jQuery is not loaded.');
            return;
        }
        $.ajax({
            url: '../config/get_customer_history.php',
            type: 'POST',
            data: {
                customer_id: customerId
            },
            success: function(response) {
                console.log('History response:', response);
                const historyList = document.getElementById('historyList');
                if (historyList) historyList.innerHTML = response;
                const customerHistory = document.getElementById('customerHistory');
                console.log('Customer history element:', customerHistory);
                if (customerHistory) customerHistory.style.display = 'block';
            }
        });
    }

    // Confirm booking
    function confirmBooking() {
        if (!selectedCustomer || !selectedProgram) {
            Swal.fire({
                icon: 'warning',
                title: 'กรุณาเลือกลูกค้าและโปรแกรม',
                confirmButtonColor: '<?= $primaryColor ?>'
            });
            return;
        }

        const promoSelect = document.getElementById('promotionSelect');
        if (!promoSelect) {
            console.error('Promotion select element not found.');
            return;
        }
        const promotionId = promoSelect.value;
        const originalPrice = selectedProgram.price;
        const finalPrice = parseFloat(document.getElementById('totalPrice').textContent.replace('฿', ''));
        const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;

        // Get payment details
        let paymentRef = '';
        if (paymentMethod === 'transfer') {
            paymentRef = document.getElementById('transferRef').value;
            if (!paymentRef) {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณากรอกหมายเลขอ้างอิง',
                    confirmButtonColor: '<?= $primaryColor ?>'
                });
                return;
            }
        } else if (paymentMethod === 'card') {
            paymentRef = document.getElementById('cardLast4').value;
            if (!paymentRef || paymentRef.length !== 4) {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณากรอก 4 หลักท้ายของบัตร',
                    confirmButtonColor: '<?= $primaryColor ?>'
                });
                return;
            }
        }

        const paymentMethodText = {
            'cash': 'เงินสด',
            'transfer': 'โอนเงิน',
            'card': 'บัตรเครดิต/เดบิต'
        };

        Swal.fire({
            title: 'ยืนยันการชำระเงิน?',
            html: `
            <div class="text-start">
                <p><strong>ลูกค้า:</strong> ${selectedCustomer.name}</p>
                <p><strong>โปรแกรม:</strong> ${selectedProgram.name}</p>
                ${promotionId ? `<p><strong>โปรโมชั่น:</strong> ${promoSelect.options[promoSelect.selectedIndex].text}</p>` : ''}
                <p><strong>วิธีชำระเงิน:</strong> ${paymentMethodText[paymentMethod]}</p>
                ${paymentRef ? `<p><strong>อ้างอิง:</strong> ${paymentRef}</p>` : ''}
                <hr>
                <p class="mb-0"><strong>ยอดชำระ:</strong> <span style="color: <?= $primaryColor ?>; font-weight: bold; font-size: 1.5rem;">฿${finalPrice.toFixed(2)}</span></p>
            </div>
        `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'ยืนยันชำระเงิน',
            cancelButtonText: 'ยกเลิก',
            confirmButtonColor: '<?= $primaryColor ?>',
            cancelButtonColor: '#6b7280'
        }).then((result) => {
            if (result.isConfirmed) {
                if (typeof $ === 'undefined') {
                    console.error('jQuery is not loaded.');
                    return;
                }
                $.ajax({
                    url: '../config/save_booking.php',
                    type: 'POST',
                    data: {
                        customer_id: selectedCustomer.id,
                        program_id: selectedProgram.id,
                        promotion_id: promotionId || null,
                        original_price: originalPrice,
                        final_price: finalPrice,
                        payment_method: paymentMethod,
                        payment_ref: paymentRef,
                        admin_id: '<?= $_SESSION['admin_id'] ?? 1 ?>'
                    },
                    success: function(response) {
                        if (response.startsWith('success:')) {
                            const bookingId = response.split(':')[1];
                            Swal.fire({
                                icon: 'success',
                                title: 'ชำระเงินสำเร็จ!',
                                html: 'ต้องการพิมพ์ใบเสร็จหรือไม่?',
                                showCancelButton: true,
                                confirmButtonText: '<i class="bi bi-printer"></i> พิมพ์ใบเสร็จ',
                                cancelButtonText: 'ปิด',
                                confirmButtonColor: '<?= $primaryColor ?>',
                                cancelButtonColor: '#6b7280'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    printReceipt(bookingId);
                                }
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: response,
                                confirmButtonColor: '<?= $primaryColor ?>'
                            });
                        }
                    }
                });
            }
        });
    }

    // Print receipt
    function printReceipt(bookingId) {
        const printWindow = window.open('../config/print_receipt.php?id=' + bookingId, '_blank', 'width=800,height=1000');
        printWindow.onload = function() {
            printWindow.print();
        };
    }
</script>
<style>
    :root {
        --primary: #BA9A8B;
        --primary-light: #D4BFB3;
        --primary-dark: #9A7A6B;
    }

    .customer-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .customer-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(186, 154, 139, 0.2);
    }

    .customer-card.selected {
        border: 2px solid var(--primary);
        background: rgba(186, 154, 139, 0.05);
    }

    .program-item {
        transition: all 0.2s ease;
    }

    .program-item:hover {
        background: rgba(186, 154, 139, 0.05);
    }

    .program-item.selected {
        border-left: 4px solid var(--primary);
        background: rgba(186, 154, 139, 0.1);
    }

    .step {
        opacity: 0.5;
        pointer-events: none;
    }

    .step.active {
        opacity: 1;
        pointer-events: auto;
    }

    .timeline-item {
        position: relative;
        padding-left: 2rem;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 0.5rem;
        top: 0;
        bottom: -1rem;
        width: 2px;
        background: #e5e7eb;
    }

    .timeline-item:last-child::before {
        display: none;
    }

    .timeline-dot {
        position: absolute;
        left: 0;
        top: 0.25rem;
        width: 1.5rem;
        height: 1.5rem;
        border-radius: 50%;
        background: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.75rem;
    }
</style>

<div class="container-fluid p-4">
    <!-- Header -->
    <div class="mb-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            <i class="bi bi-calendar-check-fill mr-2" style="color: var(--primary);"></i>
            จัดการโปรแกรมลูกค้า
        </h1>
        <p class="text-gray-600">เลือกลูกค้าและโปรแกรมที่ต้องการ</p>
    </div>

    <div class="row">
        <!-- Step 1: เลือกลูกค้า -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm step active" id="step1">
                <div class="card-header text-white" style="background: var(--primary);">
                    <h5 class="mb-0">
                        <i class="bi bi-person-check"></i> ขั้นตอนที่ 1: เลือกลูกค้า
                    </h5>
                </div>
                <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                    <div class="mb-3">
                        <input type="text" id="searchCustomer" class="form-control" placeholder="ค้นหาชื่อลูกค้า...">
                    </div>
                    <div id="customerList">
                        <?php
                        $db = new Database('u507667907_Vnyce');
                        $db->Table = "V_User";
                        $db->Where = "WHERE v_status = '02' ORDER BY v_fname ASC";
                        $customers = $db->Select();

                        foreach ($customers as $customer) {
                            $prefix = ['01' => 'นาย', '02' => 'นาง', '03' => 'นางสาว'][$customer['v_prefix']] ?? '';
                            $fullName = $prefix . $customer['v_fname'] . ' ' . $customer['v_lname'];
                        ?>
                            <div class="customer-card card mb-2 p-3"
                                data-id="<?= $customer['v_id'] ?>"
                                data-name="<?= htmlspecialchars($fullName) ?>"
                                onclick="selectCustomer(this)">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white me-3"
                                        style="width: 40px; height: 40px; background: var(--primary);">
                                        <strong><?= mb_substr($customer['v_fname'], 0, 1) ?></strong>
                                    </div>
                                    <div>
                                        <strong><?= htmlspecialchars($fullName) ?></strong>
                                        <div class="text-muted small">HN<?= str_pad($customer['v_id'], 6, '0', STR_PAD_LEFT) ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 2: เลือกโปรแกรม -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm step" id="step2">
                <div class="card-header text-white" style="background: var(--primary);">
                    <h5 class="mb-0">
                        <i class="bi bi-list-check"></i> ขั้นตอนที่ 2: เลือกโปรแกรม
                    </h5>
                </div>
                <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                    <div class="mb-3">
                        <strong>ลูกค้า:</strong> <span id="selectedCustomerName" class="text-muted">-</span>
                    </div>
                    <div id="programList">
                        <?php
                        $dbProg = new Database('u507667907_Vnyce');
                        $dbProg->Table = "V_program";
                        $dbProg->Where = "WHERE prog_status = '01' ORDER BY prog_name ASC";
                        $programs = $dbProg->Select();

                        // ดึงข้อมูลโปรแกรมที่ลูกค้าเคยใช้ไปแล้ว
                        $dbUsed = new Database('u507667907_Vnyce');
                        $dbUsed->Table = "V_bookings b 
                                        LEFT JOIN V_program p ON b.program_id = p.prog_id";
                        $dbUsed->Where = "WHERE b.customer_id IN (SELECT v_id FROM V_User WHERE v_status = '02') 
                                          AND b.status = 'active' 
                                          GROUP BY b.booking_id, p.prog_id, p.prog_rounds ";
                        $usedPrograms = $dbUsed->Select();
                        $usedProgramIds = array_column($usedPrograms, 'prog_id');

                        foreach ($programs as $program) {
                            // ถ้าโปรแกรมนี้เคยใช้ครบแล้ว ให้ข้าม
                            if (in_array($program['prog_id'], $usedProgramIds)) {
                                continue;
                            }

                            // คำนวณวันที่ใช้งานได้
                            $date1 = new DateTime($program['prog_date_start']);
                            $date2 = new DateTime($program['prog_date_end']);
                            $daysValid = $date1->diff($date2)->days;
                        ?>
                            <div class="program-item card mb-2 p-3"
                                data-id="<?= $program['prog_id'] ?>"
                                data-name="<?= htmlspecialchars($program['prog_name']) ?>"
                                data-price="<?= $program['prog_price'] ?>"
                                data-rounds="<?= $program['prog_rounds'] ?>"
                                data-days="<?= $daysValid ?>"
                                onclick="selectProgram(this)">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <strong><?= htmlspecialchars($program['prog_name']) ?></strong>
                                        <div class="text-muted small">
                                            <i class="bi bi-clock"></i> <?= $program['prog_rounds'] ?> ครั้ง • <?= $daysValid ?> วัน
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <strong style="color: var(--primary);">฿<?= number_format($program['prog_price'], 2) ?></strong>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 3: เลือกโปรโมชั่นและสรุป -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm step" id="step3">
                <div class="card-header text-white" style="background: var(--primary);">
                    <h5 class="mb-0">
                        <i class="bi bi-receipt"></i> ขั้นตอนที่ 3: สรุปและชำระเงิน
                    </h5>
                </div>
                <div class="card-body">
                    <!-- สรุปรายการ -->
                    <div class="mb-4">
                        <h6 class="border-bottom pb-2">รายละเอียดการจอง</h6>
                        <table class="table table-sm">
                            <tr>
                                <td>ลูกค้า:</td>
                                <td><strong id="summaryCustomer">-</strong></td>
                            </tr>
                            <tr>
                                <td>โปรแกรม:</td>
                                <td><strong id="summaryProgram">-</strong></td>
                            </tr>
                            <tr>
                                <td>จำนวนครั้ง:</td>
                                <td><span id="summaryRounds">-</span></td>
                            </tr>
                            <tr>
                                <td>ระยะเวลา:</td>
                                <td><span id="summaryDays">-</span></td>
                            </tr>
                        </table>
                    </div>

                    <!-- เลือกโปรโมชั่น -->
                    <div class="mb-4">
                        <h6 class="border-bottom pb-2">โปรโมชั่น (ถ้ามี)</h6>
                        <select id="promotionSelect" class="form-select" onchange="calculateTotal()">
                            <option value="">-- ไม่ใช้โปรโมชั่น --</option>
                            <?php
                            $dbPromo = new Database('u507667907_Vnyce');
                            $dbPromo->Table = "V_promotions";
                            $dbPromo->Where = "WHERE promo_status = 'active' ";
                            // AND promo_start <= CURDATE() AND promo_end >= CURDATE()
                            $promotions = $dbPromo->Select();

                            foreach ($promotions as $promo) {
                                $promoText = '';
                                if ($promo['promo_type'] == 'percent') {
                                    $promoText = "ลด {$promo['promo_discount']}%";
                                } elseif ($promo['promo_type'] == 'fixed') {
                                    $promoText = "ลด ฿" . number_format($promo['promo_discount']);
                                } else {
                                    $promoText = "ราคาพิเศษ ฿" . number_format($promo['promo_price']);
                                }
                            ?>
                                <option value="<?= $promo['promo_id'] ?>"
                                    data-type="<?= $promo['promo_type'] ?>"
                                    data-discount="<?= $promo['promo_discount'] ?>"
                                    data-price="<?= $promo['promo_price'] ?>">
                                    <?= htmlspecialchars($promo['promo_name']) ?> (<?= $promoText ?>)
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- สรุปราคา -->
                    <div class="mb-4 p-3 rounded" style="background: rgba(186, 154, 139, 0.1);">
                        <div class="d-flex justify-content-between mb-2">
                            <span>ราคาปกติ:</span>
                            <span id="originalPrice">฿0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 text-success" id="discountRow" style="display: none !important;">
                            <span>ส่วนลด:</span>
                            <span id="discountAmount">-฿0.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>ยอดชำระ:</strong>
                            <strong id="totalPrice" style="color: var(--primary); font-size: 1.5rem;">฿0.00</strong>
                        </div>
                    </div>

                    <!-- วิธีชำระเงิน -->
                    <div class="mb-4">
                        <h6 class="border-bottom pb-2">วิธีชำระเงิน</h6>
                        <div class="row g-2">
                            <div class="col-4">
                                <input type="radio" class="btn-check" name="paymentMethod" id="payCash" value="cash" checked>
                                <label class="btn btn-outline-success w-100" for="payCash">
                                    <i class="bi bi-cash-coin d-block mb-1" style="font-size: 1.5rem;"></i>
                                    <small>เงินสด</small>
                                </label>
                            </div>
                            <div class="col-4">
                                <input type="radio" class="btn-check" name="paymentMethod" id="payTransfer" value="transfer">
                                <label class="btn btn-outline-primary w-100" for="payTransfer">
                                    <i class="bi bi-phone d-block mb-1" style="font-size: 1.5rem;"></i>
                                    <small>โอนเงิน</small>
                                </label>
                            </div>
                            <div class="col-4">
                                <input type="radio" class="btn-check" name="paymentMethod" id="payCard" value="card">
                                <label class="btn btn-outline-info w-100" for="payCard">
                                    <i class="bi bi-credit-card d-block mb-1" style="font-size: 1.5rem;"></i>
                                    <small>บัตร</small>
                                </label>
                            </div>
                        </div>

                        <!-- รายละเอียดเพิ่มเติมตามวิธีชำระเงิน -->
                        <div id="paymentDetails" class="mt-3" style="display: none;">
                            <!-- Transfer Details -->
                            <div id="transferDetails" style="display: none;">
                                <label class="form-label">หมายเลขอ้างอิง/เลขที่โอน</label>
                                <input type="text" id="transferRef" class="form-control" placeholder="กรอกหมายเลขอ้างอิง">
                            </div>
                            <!-- Card Details -->
                            <div id="cardDetails" style="display: none;">
                                <label class="form-label">4 หลักท้ายบัตร</label>
                                <input type="text" id="cardLast4" class="form-control" placeholder="xxxx" maxlength="4">
                            </div>
                        </div>
                    </div>

                    <!-- ปุ่มยืนยัน -->
                    <button class="btn btn-lg w-100 text-white" style="background: var(--primary);" onclick="confirmBooking()">
                        <i class="bi bi-check-circle"></i> ยืนยันและชำระเงิน
                    </button>
                </div>
            </div>

            <!-- ประวัติลูกค้า -->
            <div class="card shadow-sm mt-4" id="customerHistory" style="display: none;">
                <div class="card-header" style="background: var(--primary-light);">
                    <h6 class="mb-0 text-gray-800">
                        <i class="bi bi-clock-history"></i> ประวัติการใช้โปรแกรม
                    </h6>
                </div>
                <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                    <div id="historyList">
                        <p class="text-muted text-center">เลือกลูกค้าเพื่อดูประวัติ</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>