<?php
session_start();
$_SESSION['Database_V'] = "VaNYC2E_V5ER4bR7I0FIEeD";
require_once '../class/class.php';

// ตรวจสอบการ login
if (!isset($_SESSION['verify_V']) || $_SESSION['verify_V'] != "Vv_verify") {
    echo "unauthorized";
    exit();
}

try {
    $promo_id = $_POST['promo_id'] ?? '';
    $promo_name = $_POST['promo_name'] ?? '';
    $promo_detail = $_POST['promo_detail'] ?? '';
    $promo_type = $_POST['promo_type'] ?? '';
    $promo_discount = $_POST['promo_discount'] ?? null;
    $promo_price = $_POST['promo_price'] ?? null;
    $promo_start = $_POST['promo_start'] ?? '';
    $promo_end = $_POST['promo_end'] ?? '';
    $promo_limit_times = $_POST['promo_limit_times'] ?? null;
    $promo_status = $_POST['promo_status'] ?? '';
    $promo_userAdd = $_POST['promo_userAdd'] ?? '';

    $db = new Database('u507667907_Vnyce');
    $db->Table = "V_promotions";
    $db->Field = "promo_name, promo_detail, promo_type, promo_discount, promo_price, promo_start, promo_end, promo_limit_times, promo_status, promo_userAdd, promo_dateAdd";
    $db->Value = "'$promo_name', '$promo_detail', '$promo_type', '$promo_discount', '$promo_price', '$promo_start', '$promo_end', '$promo_limit_times', '$promo_status', NOW()";
    $result = $db->Insert();

    if ($result) {
        echo "success";
    } else {
        echo "error";
    }

    // if (!empty($promo_id)) {
    //     // Update
    //     $db->Where = "WHERE promo_id = '{$promo_id}'";
    //     $result = $db->Update($data);
    // } else {
    //     // Insert
    //     $data['promo_dateAdd'] = date('Y-m-d H:i:s');
    //     $result = $db->Insert($data);
    // }

} catch (Exception $e) {
    echo 'error: ' . $e->getMessage();
}
