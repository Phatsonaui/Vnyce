<?php
// config/save_booking.php
session_start();
require_once '../class/class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = new Database('u507667907_Vnyce');
        $db->Table = "V_bookings";

        // คำนวณวันหมดอายุ
        $dbProg = new Database('u507667907_Vnyce');
        $dbProg->Table = "V_program";
        $dbProg->Where = "WHERE prog_id = '{$_POST['program_id']}'";
        $program = $dbProg->Select();

        $startDate = date('Y-m-d');
        if (!empty($program)) {
            $date1 = new DateTime($program[0]['prog_date_start']);
            $date2 = new DateTime($program[0]['prog_date_end']);
            $daysValid = $date1->diff($date2)->days;
            $endDate = date('Y-m-d', strtotime("+{$daysVaid} days"));
        } else {
            $endDate = date('Y-m-d', strtotime('+30 days'));
        }

        $data = [
            'customer_id' => $_POST['customer_id'],
            'program_id' => $_POST['program_id'],
            'promotion_id' => !empty($_POST['promotion_id']) ? $_POST['promotion_id'] : null,
            'original_price' => $_POST['original_price'],
            'final_price' => $_POST['final_price'],
            'payment_method' => $_POST['payment_method'],
            'payment_ref' => $_POST['payment_ref'] ?? null,
            'admin_id' => $_POST['admin_id'],
            'booking_date' => date('Y-m-d H:i:s'),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => '01', // รอใช้บริการ
            'paid' => 1 // ชำระเงินแล้ว
        ];

        $bookingId = $db->Insert($data);

        if ($bookingId) {
            echo "success:" . $bookingId;
        } else {
            echo "error_database";
        }
    } catch (Exception $e) {
        echo "error: " . $e->getMessage();
    }
}
