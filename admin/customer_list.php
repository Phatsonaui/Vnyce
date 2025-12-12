<?php
// customer_list.php

function DateThai($strDate)
{
    $date = strtotime($strDate);
    $day = date("j", $date);
    $month = date("n", $date);
    $year = date("Y", $date) + 543; // Convert to Buddhist Era

    // Thai month names
    $monthNames = ["", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];

    // Format the date string
    $formattedDate = $day . " " . $monthNames[$month] . " " . $year;

    return $formattedDate;
}
?>

<style>
    .page-header {
        margin-bottom: 2rem;
    }

    .page-header h1 {
        font-size: 1.75rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .page-header p {
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .table-card {
        background: var(--bg-card);
        border-radius: 1rem;
        box-shadow: 0 1px 3px rgba(186, 154, 139, 0.1);
        overflow: hidden;
    }

    .table-card-header {
        padding: 1.5rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-bottom: 1px solid var(--border-color);
    }

    .table-card-header h2 {
        color: white;
        font-size: 1.125rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table-card-body {
        padding: 1.5rem;
    }

    /* DataTable Custom Styles */
    .dataTables_wrapper {
        font-family: 'Prompt', sans-serif;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 1rem;
    }

    .dataTables_wrapper .dataTables_length select {
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        padding: 0.5rem 2rem 0.5rem 0.75rem;
        color: var(--text-dark);
        background-color: white;
        margin: 0 0.5rem;
    }

    .dataTables_wrapper .dataTables_length select:focus,
    .dataTables_wrapper .dataTables_filter input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(186, 154, 139, 0.1);
    }

    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        color: var(--text-dark);
        margin-left: 0.5rem;
    }

    /* Table Styles */
    table.dataTable {
        border-collapse: separate !important;
        border-spacing: 0;
        width: 100% !important;
    }

    table.dataTable thead th {
        background: var(--bg-accent);
        color: var(--text-dark);
        font-weight: 600;
        padding: 1rem;
        border: none;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    table.dataTable thead th:first-child {
        border-top-left-radius: 0.5rem;
    }

    table.dataTable thead th:last-child {
        border-top-right-radius: 0.5rem;
    }

    table.dataTable tbody tr {
        transition: all 0.2s ease;
    }

    table.dataTable tbody tr:hover {
        background-color: rgba(186, 154, 139, 0.05);
    }

    table.dataTable tbody td {
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-dark);
        vertical-align: middle;
    }

    table.dataTable tbody tr:last-child td {
        border-bottom: none;
    }

    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 0.375rem 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.75rem;
        font-weight: 500;
        background: var(--primary-light);
        color: var(--text-dark);
    }

    .status-badge.active {
        background: #86efac;
        color: #166534;
    }

    .status-badge.inactive {
        background: #fca5a5;
        color: #991b1b;
    }

    /* Action Buttons */
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 0.5rem;
        border: none;
        transition: all 0.2s ease;
        cursor: pointer;
        margin: 0 0.25rem;
    }

    .action-btn i {
        font-size: 0.875rem;
    }

    .action-btn.btn-view {
        background: var(--primary);
        color: white;
    }

    .action-btn.btn-view:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(186, 154, 139, 0.3);
    }

    .action-btn.btn-edit {
        background: #fbbf24;
        color: white;
    }

    .action-btn.btn-edit:hover {
        background: #f59e0b;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(251, 191, 36, 0.3);
    }

    .action-btn.btn-delete {
        background: #ef4444;
        color: white;
    }

    .action-btn.btn-delete:hover {
        background: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
    }

    /* Pagination */
    .dataTables_wrapper .dataTables_paginate {
        margin-top: 1.5rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5rem 0.75rem;
        margin: 0 0.125rem;
        border-radius: 0.375rem;
        border: 1px solid var(--border-color);
        color: var(--text-dark) !important;
        background: white;
        transition: all 0.2s ease;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: var(--bg-accent) !important;
        border-color: var(--primary) !important;
        color: var(--text-dark) !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--primary) !important;
        border-color: var(--primary) !important;
        color: white !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Info Text */
    .dataTables_wrapper .dataTables_info {
        color: var(--text-muted);
        font-size: 0.875rem;
        padding-top: 1rem;
    }

    /* Empty State */
    .dataTables_empty {
        padding: 3rem !important;
        text-align: center;
        color: var(--text-muted);
    }

    /* Customer ID Badge */
    .customer-id {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: var(--primary-dark);
        background: var(--bg-accent);
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.875rem;
    }

    /* Number Badge */
    .number-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background: var(--primary);
        color: white;
        border-radius: 50%;
        font-weight: 600;
        font-size: 0.875rem;
    }

    /* Loading State */
    .dataTables_processing {
        background: rgba(255, 255, 255, 0.95) !important;
        color: var(--primary) !important;
    }
</style>
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1><i class="bi bi-people-fill"></i> รายชื่อลูกค้า</h1>
        <p>จัดการข้อมูลลูกค้าทั้งหมดในระบบ</p>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <div class="table-card-header">
            <h2>
                <i class="bi bi-list-ul"></i>
                รายการลูกค้าทั้งหมด
            </h2>
        </div>
        <div class="table-card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="dtBasicExample">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">รหัสลูกค้า</th>
                            <th width="40%">ชื่อ-นามสกุล</th>
                            <th width="15%">วันเกิด</th>
                            <th width="15%">สถานะ</th>
                            <th width="15%" class="text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $r = 0;
                        $db = new Database('u507667907_Vnyce');
                        $db->Table = "V_User";
                        $db->Where = "WHERE v_status = '02'";
                        $users = $db->Select();

                        foreach ($users as $user) {
                            $r++;

                            // กำหนดสถานะ
                            $statusClass = 'active';
                            $statusText = 'ใช้งาน';
                            if ($user['v_status'] == '01') {
                                $statusClass = 'inactive';
                                $statusText = 'ระงับ';
                            }
                        ?>
                            <tr>
                                <td>
                                    <div class="number-badge"><?php echo $r; ?></div>
                                </td>
                                <td>
                                    <span class="customer-id">HN<?php echo str_pad($user['v_id'], 6, '0', STR_PAD_LEFT); ?></span>
                                </td>
                                <td>
                                    <div style="font-weight: 500;">
                                        <?php echo htmlspecialchars($user['v_fname'] . ' ' . $user['v_lname']); ?>
                                    </div>
                                </td>
                                <td>
                                    <?php echo DateThai($user['v_birth']); ?>
                                </td>
                                <td>
                                    <span class="status-badge <?php echo $statusClass; ?>">
                                        <?php echo $statusText; ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="A_main.php?page=customer_history&v_id=<?php echo urlencode($user['v_id']); ?>"
                                        class="action-btn btn-view"
                                        title="ดูข้อมูล">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="A_main.php?page=customer_edit&v_id=<?php echo urlencode($user['v_id']); ?>"
                                        class="action-btn btn-edit"
                                        title="แก้ไข">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="button"
                                        class="action-btn btn-delete"
                                        onclick="deleteCustomer(<?php echo $user['v_id']; ?>)"
                                        title="ลบ">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#dtBasicExample').DataTable({
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            "pageLength": 10,
            "order": [
                [0, "asc"]
            ],
            "language": {
                "lengthMenu": "แสดง _MENU_ รายการ",
                "search": "ค้นหา:",
                "searchPlaceholder": "พิมพ์เพื่อค้นหา...",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป »",
                    "previous": "« ย้อนกลับ"
                },
                "info": "แสดงข้อมูล _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                "infoFiltered": "(กรองจาก _MAX_ รายการทั้งหมด)",
                "infoEmpty": "ไม่พบข้อมูล",
                "emptyTable": "ไม่มีข้อมูลในตาราง",
                "zeroRecords": "ไม่พบข้อมูลที่ค้นหา",
                "loadingRecords": "กำลังโหลดข้อมูล...",
                "processing": "กำลังประมวลผล..."
            },
            "dom": '<"d-flex justify-content-between align-items-center mb-3"lf>rtip',
            "drawCallback": function(settings) {
                // Initialize tooltips
                $('[title]').tooltip();
            }
        });

        // Custom styling for length menu and search
        $('.dataTables_length label').contents().filter(function() {
            return this.nodeType === 3;
        }).remove();

        $('.dataTables_filter label').contents().filter(function() {
            return this.nodeType === 3;
        }).remove();
    });

    // Delete customer function
    function deleteCustomer(customerId) {
        Swal.fire({
            title: 'ยืนยันการลบ?',
            text: "คุณต้องการลบข้อมูลลูกค้านี้ใช่หรือไม่?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#BA9A8B',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'ใช่, ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                // Ajax call to delete
                $.ajax({
                    url: 'config/customer_delete.php',
                    type: 'POST',
                    data: {
                        v_id: customerId
                    },
                    success: function(response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบสำเร็จ!',
                                text: 'ข้อมูลลูกค้าถูกลบเรียบร้อยแล้ว',
                                confirmButtonColor: '#BA9A8B'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: 'ไม่สามารถลบข้อมูลได้',
                                confirmButtonColor: '#BA9A8B'
                            });
                        }
                    }
                });
            }
        });
    }
</script>