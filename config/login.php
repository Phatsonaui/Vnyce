<?php session_start();
$tel = $_POST['tel'] ?? '';
if (isset($tel)) {
    $_SESSION['Database_V'] = "VaNYC2E_V5ER4bR7I0FIEeD";
    require_once '../class/class.php';
    $db = new Database('u507667907_Vnyce');
    $db->Table = "V_User";
    $db->Where = "WHERE v_tel = '$tel'";
    $result = $db->Select();
    foreach ($result as $row) {
        $_SESSION['v_id'] = $row['v_id'];
        $_SESSION['name_V'] = $row['v_name'];
        $_SESSION['verify_V'] = "Vv_verify";
        if ($row['v_status'] == 1) {
            $status = "admin";
            echo json_encode(["status" => "success", "role" => $status]);
        } else {
            $status = "user";
            echo json_encode(["status" => "success", "role" => $status]);
        }
    }
} else {
    echo json_encode(["status" => "error"]);
    exit();
}
