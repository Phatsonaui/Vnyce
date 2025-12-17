<?php
session_start();
$_SESSION['Database_V'] = "VaNYC2E_V5ER4bR7I0FIEeD";
require_once '../class/class.php';

// ตรวจสอบการ login
if (!isset($_SESSION['verify_V']) || $_SESSION['verify_V'] != "Vv_verify") {
    echo "unauthorized";
    exit();
}

$db = new Database('u507667907_Vnyce');
$db->Table = "V_User";
$db->Where = "WHERE v_status = '02' AND v_birth IS NOT NULL AND v_birth != '0000-00-00' ORDER BY v_birth ASC";
$allUsers = $db->Select();

$birthdayUsers = [];
$currentYear = date('Y');

foreach ($allUsers as $user) {
    if (empty($user['v_birth']) || $user['v_birth'] === '0000-00-00') continue;

    $birthDate = new DateTime($user['v_birth']);
    $birthThisYear = new DateTime($currentYear . '-' . $birthDate->format('m-d'));
    $now = new DateTime();

    if ($birthThisYear < $now) {
        $birthThisYear = new DateTime(($currentYear + 1) . '-' . $birthDate->format('m-d'));
    }

    $interval = $now->diff($birthThisYear);
    $daysUntil = $interval->days;

    if ($daysUntil <= 90) { // แสดง 90 วันข้างหน้า
        $user['days_until'] = $daysUntil;
        $user['birth_this_year'] = $birthThisYear->format('Y-m-d');
        $birthdayUsers[] = $user;
    }
}

usort($birthdayUsers, function ($a, $b) {
    return $a['days_until'] - $b['days_until'];
});

if (count($birthdayUsers) > 0) {
    echo '<div class="space-y-2">';

    foreach ($birthdayUsers as $user) {
        $prefix = ['01' => 'นาย', '02' => 'นาง', '03' => 'นางสาว'][$user['v_prefix']] ?? '';
        $fullName = $prefix . ' ' . $user['v_fname'] . ' ' . $user['v_lname'];
        $daysUntil = $user['days_until'];

        $birthDate = new DateTime($user['v_birth']);
        $now = new DateTime();
        $age = $now->diff($birthDate)->y + 1;

        if ($daysUntil == 0) {
            $badgeClass = 'bg-red-100 text-red-700';
            $badgeText = 'วันนี้!';
            $icon = 'bi-gift-fill';
            $rowClass = 'bg-red-50 border-red-200';
        } elseif ($daysUntil <= 7) {
            $badgeClass = 'bg-orange-100 text-orange-700';
            $badgeText = $daysUntil . ' วัน';
            $icon = 'bi-calendar-heart';
            $rowClass = 'bg-orange-50 border-orange-200';
        } else {
            $badgeClass = 'bg-blue-100 text-blue-700';
            $badgeText = $daysUntil . ' วัน';
            $icon = 'bi-calendar-event';
            $rowClass = 'hover:bg-gray-50';
        }

        $birthDateFormatted = date('d/m/Y', strtotime($user['birth_this_year']));

        echo '<div class="flex items-center justify-between p-3 rounded-lg border transition ' . $rowClass . '">';
        echo '<div class="flex items-center gap-3 flex-1">';
        echo '<div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-semibold" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark));">';
        echo '<i class="' . $icon . ' text-xl"></i>';
        echo '</div>';
        echo '<div class="flex-1">';
        echo '<div class="font-medium text-gray-800">' . htmlspecialchars($fullName) . '</div>';
        echo '<div class="text-sm text-gray-500">' . $birthDateFormatted . ' (ครบ ' . $age . ' ปี)</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="flex items-center gap-2">';
        echo '<span class="px-3 py-1 rounded-full text-xs font-semibold ' . $badgeClass . '">' . $badgeText . '</span>';
        echo '<button onclick="sendBirthdayWish(' . $user['v_id'] . ', \'' . htmlspecialchars($fullName) . '\')" ';
        echo 'class="px-3 py-1 bg-pink-500 text-white rounded-lg text-xs hover:bg-pink-600 transition">';
        echo '<i class="bi bi-send-fill"></i> อวยพร';
        echo '</button>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';
} else {
    echo '<p class="text-center text-gray-500 py-8">ไม่มีลูกค้าที่จะมีวันเกิดใน 90 วันนี้</p>';
}
