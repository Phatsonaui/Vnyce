<?php
include("../class/class.php");

// สร้างการเชื่อมต่อฐานข้อมูล
$db = new Database('u507667907_Vnyce');
$db->Table = "V_Promotions";
$db->Where = "";
$promotions = $db->Select();

// ตรวจสอบว่ามีข้อมูลหรือไม่
if (count($promotions) > 0) {
    echo "<h1>โปรโมชั่น</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ชื่อโปรโมชั่น</th><th>รายละเอียด</th><th>วันที่เริ่ม</th><th>วันที่สิ้นสุด</th></tr>";

    foreach ($promotions as $promo) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($promo['promo_name']) . "</td>";
        echo "<td>" . htmlspecialchars($promo['promo_description']) . "</td>";
        echo "<td>" . htmlspecialchars($promo['start_date']) . "</td>";
        echo "<td>" . htmlspecialchars($promo['end_date']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>ไม่มีโปรโมชั่น</p>";
}
