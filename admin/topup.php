<?php
include("../class/class.php");

// สร้างการเชื่อมต่อฐานข้อมูล
$db = new Database('u507667907_Vnyce');
$db->Table = "V_TopUp";
$db->Where = "";
$topups = $db->Select();

// ตรวจสอบว่ามีข้อมูลหรือไม่
if (count($topups) > 0) {
    echo "<h1>รายการ Top Up</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ชื่อ</th><th>จำนวนเงิน</th><th>วันที่เติมเงิน</th></tr>";

    foreach ($topups as $topup) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($topup['v_id']) . "</td>";
        echo "<td>" . htmlspecialchars($topup['amount']) . "</td>";
        echo "<td>" . htmlspecialchars($topup['created_at']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>ไม่มีรายการ Top Up</p>";
}
