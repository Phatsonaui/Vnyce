<?php
// config/get_customer_history.php
session_start();
require_once '../class/class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customer_id'])) {
    $customerId = $_POST['customer_id'];


    $db = new Database('u507667907_Vnyce');
    $db->Table = "V_bookings b 
                  LEFT JOIN V_program p ON b.program_id = p.prog_id 
                  LEFT JOIN V_promotions pr ON b.promotion_id = pr.promo_id";
    $db->Where = "WHERE b.customer_id = '$customerId' ORDER BY b.booking_date DESC";

    $history = $db->Select();

    if (empty($history)) {
        echo '<p class="text-muted text-center py-3">ยังไม่มีประวัติการใช้โปรแกรม</p>';
    } else {
        echo '<div class="timeline">';
        foreach ($history as $item) {
            $statusMap = [
                '01' => ['text' => 'รอใช้บริการ', 'color' => 'primary'],
                '02' => ['text' => 'กำลังใช้บริการ', 'color' => 'warning'],
                '03' => ['text' => 'เสร็จสิ้น', 'color' => 'success'],
                '04' => ['text' => 'ยกเลิก', 'color' => 'danger']
            ];
            $status = $statusMap[$item['status']] ?? ['text' => 'ไม่ทราบ', 'color' => 'secondary'];

            echo '<div class="timeline-item mb-3">';
            echo '<div class="timeline-dot"><i class="bi bi-check"></i></div>';
            echo '<div class="card">';
            echo '<div class="card-body p-2">';
            echo '<h6 class="mb-1">' . htmlspecialchars($item['prog_name']) . '</h6>';
            echo '<div class="text-muted small">';
            echo '<div><i class="bi bi-calendar"></i> ' . date('d/m/Y', strtotime($item['booking_date'])) . '</div>';
            echo '<div><i class="bi bi-cash"></i> ฿' . number_format($item['final_price'], 2) . '</div>';
            if (!empty($item['promo_name'])) {
                echo '<div><i class="bi bi-tag"></i> ' . htmlspecialchars($item['promo_name']) . '</div>';
            }
            echo '<div><span class="badge bg-' . $status['color'] . '">' . $status['text'] . '</span></div>';
            echo '</div>';
            echo '</div></div></div>';
        }
        echo '</div>';
    }
}
