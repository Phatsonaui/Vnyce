<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../class/class.php';
$db = new Database('u507667907_Vnyce');

$prefix = $_POST['prefix'] ?? '';
$firstName = $_POST['firstName'] ?? '';
$lastName = $_POST['lastName'] ?? '';
$phone = $_POST['phone'] ?? '';
$birthDate = $_POST['birthDate'] ?? '';
$email = $_POST['email'] ?? '';

$db->Table = "V_User";
$db->Field = "v_prefix, v_fname, v_lname, v_tel, v_birth, v_mail, v_status";
$db->Value = "'$prefix', '$firstName', '$lastName', '$phone', '$birthDate', '$email', '2'";

if ($db->Insert()) {
    echo json_encode(["status" => "success", "message" => "สมัครสมาชิกสำเร็จ", "tel" => $phone]);
} else {
    echo json_encode(["status" => "error", "message" => "เกิดข้อผิดพลาดในการสมัครสมาชิก"]);
}
