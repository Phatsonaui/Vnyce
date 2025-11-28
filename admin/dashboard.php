<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>ภาพรวมระบบ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: #BA9A8B;
            --primary-light: #D4BFB3;
            --primary-dark: #9A7A6B;
            --bg-body: #FFF1E8;
            --bg-card: #FFFFFF;
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Prompt', sans-serif;
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #fef9f5 100%);
            border: 1px solid rgba(186, 154, 139, 0.2);
            border-radius: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(186, 154, 139, 0.05) 0%, transparent 70%);
            transition: all 0.5s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(186, 154, 139, 0.15);
            border-color: var(--primary);
        }

        .stat-card:hover::before {
            transform: scale(1.2);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 4px 12px rgba(186, 154, 139, 0.3);
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: rgba(186, 154, 139, 0.1);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-light), var(--primary));
            transition: width 0.5s ease;
            border-radius: 4px;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .activity-item {
            padding: 1rem;
            border-left: 3px solid var(--primary);
            background: rgba(186, 154, 139, 0.05);
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .activity-item:hover {
            background: rgba(186, 154, 139, 0.1);
            transform: translateX(5px);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fed7aa;
            color: #92400e;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        .modal-backdrops {
            backdrop-filter: blur(4px);
        }
    </style>
</head>

<body>
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="mb-8 animate-fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold" style="color: var(--primary-dark);">
                        <i class="bi bi-speedometer2 mr-2"></i>ภาพรวมระบบ
                    </h1>
                    <p class="text-gray-600 mt-2">ข้อมูลสรุปรายเดือนของคลินิก</p>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-500">อัพเดตล่าสุด</div>
                    <div id="lastUpdate" class="text-sm font-semibold" style="color: var(--primary);"></div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-xl p-6 mb-6 shadow-sm border border-gray-200 animate-fade-in" style="animation-delay: 0.1s;">
            <div class="flex flex-wrap items-center gap-4">
                <div class="flex items-center gap-2">
                    <i class="bi bi-calendar-event text-xl" style="color: var(--primary);"></i>
                    <label class="text-sm font-medium text-gray-700">เลือกช่วงเวลา</label>
                </div>
                <div class="flex gap-2">
                    <select id="monthSelect" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:ring-2 focus:ring-offset-0 focus:ring-yellow-600">
                        <option value="1">มกราคม</option>
                        <option value="2">กุมภาพันธ์</option>
                        <option value="3">มีนาคม</option>
                        <option value="4">เมษายน</option>
                        <option value="5">พฤษภาคม</option>
                        <option value="6">มิถุนายน</option>
                        <option value="7">กรกฎาคม</option>
                        <option value="8">สิงหาคม</option>
                        <option value="9">กันยายน</option>
                        <option value="10">ตุลาคม</option>
                        <option value="11">พฤศจิกายน</option>
                        <option value="12">ธันวาคม</option>
                    </select>
                    <select id="yearSelect" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:ring-2 focus:ring-offset-0 focus:ring-yellow-600">
                    </select>
                </div>
                <button onclick="refreshData()" class="ml-auto px-4 py-2 text-white rounded-lg hover:opacity-90 transition flex items-center gap-2" style="background-color: var(--primary);">
                    <i class="bi bi-arrow-clockwise"></i>
                    รีเฟรช
                </button>
            </div>
        </div>

        <?php
        // ดึงข้อมูลลูกค้า
        $db = new Database('u507667907_Vnyce');
        $db->Table = "V_User";
        $db->Where = "WHERE v_status = '02'";
        $users = $db->Select();

        $newCustomers = [];
        $returningCustomers = [];
        $currentYear = date('Y');
        $currentMonth = date('m');

        foreach ($users as $user) {
            $regisDate = strtotime($user['v_regis']);
            $regisYear = date('Y', $regisDate);
            $regisMonth = date('m', $regisDate);

            if ($regisYear == $currentYear && $regisMonth == $currentMonth) {
                $newCustomers[] = $user;
            } else {
                $returningCustomers[] = $user;
            }
        }

        $totalCustomers = count($users);
        $newCustomersCount = count($newCustomers);
        $returningCustomersCount = count($returningCustomers);

        // คำนวณรายรับ (สมมติ)
        $totalRevenue = 0;
        $revenueGoal = 200000;
        $revenuePercent = ($totalRevenue / $revenueGoal) * 100;

        // ดึงข้อมูลโปรแกรม
        $dbProg = new Database('u507667907_Vnyce');
        $dbProg->Table = "V_program";
        $dbProg->Where = "WHERE prog_status = '01'";
        $programs = $dbProg->Select();
        $totalPrograms = count($programs);
        ?>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Card 1: ลูกค้าทั้งหมด -->
            <div class="stat-card p-6 shadow-sm animate-fade-in" style="animation-delay: 0.2s;">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <span class="badge badge-success">
                        <i class="bi bi-arrow-up"></i>
                        +<?= $newCustomersCount ?>
                    </span>
                </div>
                <p class="text-gray-600 text-sm mb-1">ลูกค้าทั้งหมด</p>
                <p class="text-4xl font-bold mb-2" style="color: var(--primary-dark);">
                    <?= number_format($totalCustomers) ?>
                </p>
                <p class="text-xs text-gray-500 mb-3">คน</p>
                <div>
                    <div class="flex justify-between text-xs text-gray-600 mb-1">
                        <span>ลูกค้าใหม่เดือนนี้</span>
                        <span><?= $totalCustomers > 0 ? round(($newCustomersCount / $totalCustomers) * 100) : 0 ?>%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width:<?= $totalCustomers > 0 ? round(($newCustomersCount / $totalCustomers) * 100) : 0 ?>%"></div>
                    </div>
                </div>
            </div>

            <!-- Card 2: รายรับ -->
            <div class="stat-card p-6 shadow-sm animate-fade-in" style="animation-delay: 0.3s;">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <span class="badge badge-info">
                        รายเดือน
                    </span>
                </div>
                <p class="text-gray-600 text-sm mb-1">รายรับรวม</p>
                <p class="text-4xl font-bold mb-2" style="color: #059669;">
                    ฿<?= number_format($totalRevenue) ?>
                </p>
                <p class="text-xs text-gray-500 mb-3">บาท</p>
                <div>
                    <div class="flex justify-between text-xs text-gray-600 mb-1">
                        <span>เป้าหมาย ฿<?= number_format($revenueGoal) ?></span>
                        <span><?= round($revenuePercent) ?>%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width:<?= round($revenuePercent) ?>%; background: linear-gradient(90deg, #10b981, #059669);"></div>
                    </div>
                </div>
            </div>

            <!-- Card 3: ลูกค้าใหม่ -->
            <div class="stat-card p-6 shadow-sm cursor-pointer animate-fade-in" style="animation-delay: 0.4s;" onclick="showCustomerModal('new')">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <i class="bi bi-arrow-right text-2xl" style="color: var(--primary);"></i>
                </div>
                <p class="text-gray-600 text-sm mb-1">ลูกค้าใหม่</p>
                <p class="text-4xl font-bold mb-2" style="color: #d97706;">
                    <?= number_format($newCustomersCount) ?>
                </p>
                <p class="text-xs text-gray-500">คน (เดือนนี้)</p>
            </div>

            <!-- Card 4: ลูกค้าเก่า -->
            <div class="stat-card p-6 shadow-sm cursor-pointer animate-fade-in" style="animation-delay: 0.5s;" onclick="showCustomerModal('returning')">
                <div class="flex items-start justify-between mb-4">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                    <i class="bi bi-arrow-right text-2xl" style="color: var(--primary);"></i>
                </div>
                <p class="text-gray-600 text-sm mb-1">ลูกค้าเก่า</p>
                <p class="text-4xl font-bold mb-2" style="color: #2563eb;">
                    <?= number_format($returningCustomersCount) ?>
                </p>
                <p class="text-xs text-gray-500">คน (กลับมาใช้บริการ)</p>
            </div>
        </div>

        <!-- Charts & Activities -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Chart: รายรับรายเดือน -->
            <div class="lg:col-span-2 bg-white rounded-xl p-6 shadow-sm border border-gray-200 animate-fade-in" style="animation-delay: 0.6s;">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="bi bi-bar-chart-fill mr-2" style="color: var(--primary);"></i>
                        รายรับรายเดือน
                    </h3>
                    <span class="badge badge-info">6 เดือนล่าสุด</span>
                </div>
                <div class="chart-container">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 animate-fade-in" style="animation-delay: 0.7s;">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="bi bi-lightning-charge-fill mr-2" style="color: var(--primary);"></i>
                    สถิติด่วน
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 rounded-lg" style="background: rgba(186, 154, 139, 0.05);">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark));">
                                <i class="bi bi-award text-white"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">โปรแกรม</div>
                                <div class="text-xl font-bold" style="color: var(--primary-dark);"><?= $totalPrograms ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-lg" style="background: rgba(16, 185, 129, 0.05);">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #10b981, #059669);">
                                <i class="bi bi-check-circle text-white"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">นัดหมายวันนี้</div>
                                <div class="text-xl font-bold text-green-600">0</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-lg" style="background: rgba(59, 130, 246, 0.05);">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                                <i class="bi bi-star text-white"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">คะแนนเฉลี่ย</div>
                                <div class="text-xl font-bold text-blue-600">4.8</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 animate-fade-in" style="animation-delay: 0.8s;">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="bi bi-clock-history mr-2" style="color: var(--primary);"></i>
                กิจกรรมล่าสุด
            </h3>
            <div class="space-y-3">
                <?php
                // แสดงลูกค้า 5 คนล่าสุด
                $recentCustomers = array_slice($users, -5);
                $recentCustomers = array_reverse($recentCustomers);

                foreach ($recentCustomers as $customer) {
                    $prefixMap = ['01' => 'นาย', '02' => 'นาง', '03' => 'นางสาว'];
                    $prefix = $prefixMap[$customer['v_prefix']] ?? '';
                    $fullName = $prefix . ' ' . $customer['v_fname'] . ' ' . $customer['v_lname'];
                    $timeAgo = time() - strtotime($customer['v_regis']);
                    $timeText = '';
                    if ($timeAgo < 3600) {
                        $timeText = floor($timeAgo / 60) . ' นาทีที่แล้ว';
                    } elseif ($timeAgo < 86400) {
                        $timeText = floor($timeAgo / 3600) . ' ชั่วโมงที่แล้ว';
                    } else {
                        $timeText = floor($timeAgo / 86400) . ' วันที่แล้ว';
                    }
                ?>
                    <div class="activity-item">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-semibold" style="background: var(--primary);">
                                    <?= mb_substr($customer['v_fname'], 0, 1) ?>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-800"><?= htmlspecialchars($fullName) ?></div>
                                    <div class="text-xs text-gray-500">ลงทะเบียนใหม่</div>
                                </div>
                            </div>
                            <div class="text-xs text-gray-500"><?= $timeText ?></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="customerModal" class="fixed inset-0 z-50 flex items-center justify-center bg-opacity-40 hidden modal-backdrops">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden animate-fade-in">
            <div class="p-6 border-b border-gray-200" style="background: linear-gradient(135deg, var(--primary-light), var(--primary));">
                <div class="flex items-center justify-between">
                    <h2 id="modalTitle" class="text-2xl font-bold text-white"></h2>
                    <button onclick="closeCustomerModal()" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-gray-100 transition">
                        <i class="bi bi-x-lg text-gray-600"></i>
                    </button>
                </div>
            </div>
            <div id="modalContent" class="p-6 max-h-[70vh] overflow-y-auto"></div>
        </div>
    </div>

    <script>
        // Initialize
        document.addEventListener("DOMContentLoaded", function() {

            document.getElementById('customerModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });

            // Set year dropdown
            const yearSelect = document.getElementById('yearSelect');
            const currentYear = new Date().getFullYear();
            for (let y = currentYear - 4; y <= currentYear; y++) {
                const op = document.createElement('option');
                op.value = y;
                op.textContent = y + 543;
                yearSelect.appendChild(op);
            }
            yearSelect.value = currentYear;
            document.getElementById('monthSelect').value = new Date().getMonth() + 1;

            // Update time
            updateLastUpdate();
            setInterval(updateLastUpdate, 60000);

            // Initialize chart
            initRevenueChart();
        });

        function updateLastUpdate() {
            document.getElementById('lastUpdate').textContent = new Date().toLocaleString("th-TH", {
                day: 'numeric',
                month: 'short',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function refreshData() {
            location.reload();
        }

        // Chart
        function initRevenueChart() {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.'],
                    datasets: [{
                        label: 'รายรับ (บาท)',
                        data: [45000, 52000, 48000, 61000, 58000, 73000],
                        borderColor: '#BA9A8B',
                        backgroundColor: 'rgba(186, 154, 139, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '฿' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        }

        // Modal
        const newCustomers = <?php echo json_encode($newCustomers); ?>;
        const returningCustomers = <?php echo json_encode($returningCustomers); ?>;

        function getPrefixText(prefixCode) {
            const prefixMap = {
                '01': 'นาย',
                '02': 'นาง',
                '03': 'นางสาว'
            };
            return prefixMap[prefixCode] || '';
        }

        function showCustomerModal(type) {
            const modal = document.getElementById('customerModal');
            const title = document.getElementById('modalTitle');
            const content = document.getElementById('modalContent');
            let customers = type === 'new' ? newCustomers : returningCustomers;

            title.innerHTML = `<i class="bi bi-${type === 'new' ? 'person-plus' : 'person-check'}-fill mr-2"></i>รายชื่อลูกค้า${type === 'new' ? 'ใหม่' : 'เก่า'}`;

            if (customers.length === 0) {
                content.innerHTML = '<p class="text-center text-gray-500 py-12">ไม่มีข้อมูล</p>';
            } else {
                let html = `
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">#</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">ชื่อ-นามสกุล</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">เบอร์โทร</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">วันที่ลงทะเบียน</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                `;
                customers.forEach((u, i) => {
                    const fullName = `${getPrefixText(u.v_prefix)} ${u.v_fname || ''} ${u.v_lname || ''}`.trim();
                    html += `
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-600">${i + 1}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-semibold" style="background: var(--primary);">
                                    ${u.v_fname.charAt(0)}
                                </div>
                                <span class="font-medium text-gray-800">${fullName}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">${u.v_tel || '-'}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">${u.v_regis || '-'}</td>
                    </tr>
                    `;
                });
                html += '</tbody></table></div>';
                content.innerHTML = html;
            }
            modal.classList.remove('hidden');
        }

        function closeCustomerModal() {
            document.getElementById('customerModal').classList.add('hidden');
        }

        function closeModal() {
            document.getElementById('customerModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentProgram = null;
        }
    </script>
</body>

</html>