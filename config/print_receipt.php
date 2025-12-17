<?php
// config/print_receipt.php
session_start();
require_once '../class/class.php';

$bookingId = $_GET['id'] ?? 0;

// ดึงข้อมูลการจอง
$db = new Database('u507667907_Vnyce');
$db->Table = "V_bookings b 
              LEFT JOIN V_User u ON b.customer_id = u.v_id
              LEFT JOIN V_program p ON b.program_id = p.prog_id
              LEFT JOIN V_promotions pr ON b.promotion_id = pr.promo_id
              LEFT JOIN V_User admin ON b.admin_id = admin.v_id";
$db->Where = "WHERE b.booking_id = '$bookingId'";
$booking = $db->Select();

if (empty($booking)) {
    die('ไม่พบข้อมูลการจอง');
}

$data = $booking[0];
$prefixMap = ['01' => 'นาย', '02' => 'นาง', '03' => 'นางสาว'];
$customerPrefix = $prefixMap[$data['v_prefix']] ?? '';
$customerName = $customerPrefix . $data['v_fname'] . ' ' . $data['v_lname'];

$adminPrefix = $prefixMap[$data['prefix']] ?? '';
$adminName = $adminPrefix . $data['fname'] . ' ' . $data['lname'];

$paymentMethodMap = [
    'cash' => 'เงินสด',
    'transfer' => 'โอนเงิน',
    'card' => 'บัตรเครดิต/เดบิต'
];
$paymentMethod = $paymentMethodMap[$data['payment_method']] ?? 'ไม่ระบุ';
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบเสร็จรับเงิน #<?= str_pad($bookingId, 6, '0', STR_PAD_LEFT) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Prompt', sans-serif;
            padding: 20px;
            background: white;
        }

        .receipt {
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid #BA9A8B;
            padding: 40px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #BA9A8B;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #BA9A8B;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .receipt-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .receipt-no {
            text-align: right;
        }

        .receipt-no strong {
            color: #BA9A8B;
            font-size: 18px;
        }

        .customer-info {
            background: #f9f5f2;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .customer-info h3 {
            color: #BA9A8B;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .info-row {
            display: flex;
            padding: 8px 0;
        }

        .info-label {
            width: 150px;
            font-weight: 500;
            color: #666;
        }

        .info-value {
            flex: 1;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table th {
            background: #BA9A8B;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 500;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #e5e5e5;
        }

        .text-right {
            text-align: right;
        }

        .summary {
            margin-top: 30px;
            text-align: right;
        }

        .summary-row {
            display: flex;
            justify-content: flex-end;
            padding: 8px 0;
            font-size: 16px;
        }

        .summary-label {
            width: 150px;
            text-align: right;
            padding-right: 20px;
        }

        .summary-value {
            width: 150px;
            text-align: right;
            font-weight: 500;
        }

        .total-row {
            border-top: 2px solid #BA9A8B;
            margin-top: 10px;
            padding-top: 10px;
        }

        .total-row .summary-label,
        .total-row .summary-value {
            color: #BA9A8B;
            font-size: 24px;
            font-weight: 700;
        }

        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #e5e5e5;
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        .signature {
            display: flex;
            justify-content: space-around;
            margin: 50px 0 30px;
        }

        .signature-box {
            text-align: center;
        }

        .signature-line {
            width: 200px;
            border-top: 1px solid #333;
            margin: 50px auto 10px;
        }

        @media print {
            body {
                padding: 0;
            }

            .receipt {
                border: none;
                padding: 20px;
            }

            @page {
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <div class="receipt">
        <!-- Header -->
        <div class="header">
            <h1>V'NYCE CLINIC</h1>
            <p>ใบเสร็จรับเงิน / Receipt</p>
            <p style="margin-top: 10px;">123 ถนนสุขุมวิท แขวงคลองเตย เขตคลองเตย กรุงเทพฯ 10110</p>
            <p>โทร: 02-123-4567 | Email: info@vnyce.com</p>
        </div>

        <!-- Receipt Info -->
        <div class="receipt-info">
            <div>
                <div><strong>วันที่:</strong> <?= date('d/m/Y H:i', strtotime($data['booking_date'])) ?> น.</div>
            </div>
            <div class="receipt-no">
                <strong>เลขที่: #<?= str_pad($bookingId, 6, '0', STR_PAD_LEFT) ?></strong>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="customer-info">
            <h3>ข้อมูลลูกค้า</h3>
            <div class="info-row">
                <div class="info-label">ชื่อ-นามสกุล:</div>
                <div class="info-value"><?= htmlspecialchars($customerName) ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">รหัสลูกค้า:</div>
                <div class="info-value">HN<?= str_pad($data['customer_id'], 6, '0', STR_PAD_LEFT) ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">วิธีชำระเงิน:</div>
                <div class="info-value"><?= $paymentMethod ?></div>
            </div>
            <?php if (!empty($data['payment_ref'])) { ?>
                <div class="info-row">
                    <div class="info-label">หมายเลขอ้างอิง:</div>
                    <div class="info-value"><?= htmlspecialchars($data['payment_ref']) ?></div>
                </div>
            <?php } ?>
        </div>

        <!-- Items Table -->
        <table>
            <thead>
                <tr>
                    <th>รายการ</th>
                    <th class="text-right">จำนวน</th>
                    <th class="text-right">ราคา/หน่วย</th>
                    <th class="text-right">รวม</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong><?= htmlspecialchars($data['prog_name']) ?></strong>
                        <div style="font-size: 14px; color: #666; margin-top: 5px;">
                            <?= $data['prog_rounds'] ?> ครั้ง • ใช้ได้ถึง <?= date('d/m/Y', strtotime($data['end_date'])) ?>
                        </div>
                    </td>
                    <td class="text-right">1</td>
                    <td class="text-right">฿<?= number_format($data['original_price'], 2) ?></td>
                    <td class="text-right">฿<?= number_format($data['original_price'], 2) ?></td>
                </tr>
                <?php if (!empty($data['promo_name'])) {
                    $discount = $data['original_price'] - $data['final_price'];
                ?>
                    <tr>
                        <td colspan="3" style="color: #10b981; font-weight: 500;">
                            <i>ส่วนลด: <?= htmlspecialchars($data['promo_name']) ?></i>
                        </td>
                        <td class="text-right" style="color: #10b981; font-weight: 500;">
                            -฿<?= number_format($discount, 2) ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Summary -->
        <div class="summary">
            <div class="summary-row">
                <div class="summary-label">ราคาปกติ:</div>
                <div class="summary-value">฿<?= number_format($data['original_price'], 2) ?></div>
            </div>
            <?php if ($data['original_price'] != $data['final_price']) { ?>
                <div class="summary-row">
                    <div class="summary-label">ส่วนลด:</div>
                    <div class="summary-value" style="color: #10b981;">-฿<?= number_format($data['original_price'] - $data['final_price'], 2) ?></div>
                </div>
            <?php } ?>
            <div class="summary-row total-row">
                <div class="summary-label">ยอดชำระทั้งสิ้น:</div>
                <div class="summary-value">฿<?= number_format($data['final_price'], 2) ?></div>
            </div>
        </div>

        <!-- Signature -->
        <div class="signature">
            <div class="signature-box">
                <div class="signature-line"></div>
                <div>ผู้รับเงิน</div>
                <div style="font-size: 12px; color: #666; margin-top: 5px;"><?= htmlspecialchars($adminName) ?></div>
            </div>
            <div class="signature-box">
                <div class="signature-line"></div>
                <div>ลูกค้า</div>
                <div style="font-size: 12px; color: #666; margin-top: 5px;"><?= htmlspecialchars($customerName) ?></div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>ขอบคุณที่ใช้บริการ</strong></p>
            <p style="margin-top: 10px;">เอกสารนี้ออกโดยระบบอัตโนมัติและมีผลใช้ได้โดยไม่ต้องลงลายมือชื่อ</p>
            <p style="margin-top: 5px; font-size: 12px;">พิมพ์เมื่อ: <?= date('d/m/Y H:i:s') ?> น.</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            setTimeout(() => {
                window.print();
            }, 500);
        };
    </script>
</body>

</html>