<?php
include("../class/class.php");

// สร้างการเชื่อมต่อฐานข้อมูล
$db = new Database('u507667907_Vnyce');
$db->Table = "V_Dashboard";
$db->Where = "";
$dashboard = $db->Select();

// ตรวจสอบว่ามีข้อมูลหรือไม่
if (count($dashboard) > 0) {
    echo "<h1>Dashboard รายเดือน</h1>";
    echo "<table border='1'>";
    echo "<tr><th>เดือน</th><th>ปี</th><th>ลูกค้าใหม่</th><th>ลูกค้าเก่า</th><th>รายรับรวม</th></tr>";

    foreach ($dashboard as $data) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($data['month']) . "</td>";
        echo "<td>" . htmlspecialchars($data['year']) . "</td>";
        echo "<td>" . htmlspecialchars($data['new_customers']) . "</td>";
        echo "<td>" . htmlspecialchars($data['returning_customers']) . "</td>";
        echo "<td>" . htmlspecialchars($data['total_revenue']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>ไม่มีข้อมูล Dashboard</p>";
}
