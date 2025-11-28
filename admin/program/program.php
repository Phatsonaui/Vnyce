<?php
// ตัวแปรสีหลักของระบบ
$primaryColor = '#B8A08A';
$secondaryColor = '#9D8B7C';
?>
<!DOCTYPE html>
<html>

<head>
    <base target="_top">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(184, 160, 138, 0.2);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="max-w-7xl mx-auto p-6">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">โปรแกรมทั้งหมด</h1>
                <p class="text-gray-600 mt-2">เลือกโปรแกรมที่เหมาะกับคุณ</p>
            </div>

            <a href="A_main.php?page=prog_a"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg font-medium hover:opacity-90 transition shadow"
                style="background-color: <?php echo $primaryColor; ?>; color: white;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                เพิ่มโปรแกรม
            </a>
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-lg shadow p-6 mb-6 d-none">
            <div class="flex flex-wrap gap-3">
                <button onclick="filterByCategory('all')" id="filterAll"
                    class="px-4 py-2 rounded-lg font-medium transition shadow"
                    style="background-color: <?php echo $primaryColor; ?>; color: white;">
                    ทั้งหมด
                </button>

                <?php
                $categories = ['ดูแลผิว', 'ลดน้ำหนัก', 'สปา', 'อื่นๆ'];
                $filterIds = ['filterSkincare', 'filterWeight', 'filterSpa', 'filterOther'];

                foreach ($categories as $index => $category) {
                    echo "<button onclick=\"filterByCategory('$category')\" id=\"{$filterIds[$index]}\"
            class=\"px-4 py-2 rounded-lg font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 transition\">
            $category
          </button>";
                }
                ?>
            </div>
        </div>

        <!-- Programs Grid -->
        <div id="programsList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <?php
            $db = new Database('u507667907_Vnyce');
            $db->Table = "V_program";
            $db->Where = "WHERE prog_status = '01'";
            $users = $db->Select();
            if (count($users) == 0) {
            ?>
                <div class="col-span-full text-center py-12">
                    <div class="w-24 h-24 mx-auto mb-4 rounded-full flex items-center justify-center" style="background: rgba(186, 154, 139, 0.1);">
                        <i class="bi-calendar-check text-5xl" style="color: var(--primary);"></i>
                    </div>
                    <p class="text-gray-500 text-lg">ไม่มีโปรแกรมในขณะนี้</p>
                </div>
                <?php
            } else {
                foreach ($users as $key => $data) {
                    $dbuser = new Database('u507667907_Vnyce');
                    $dbuser->Table = "V_User";
                    $dbuser->Where = "WHERE v_id = '$data[prog_userAdd]'";
                    $usersd = $dbuser->Select();
                    $pre = '';
                    if (!empty($usersd)) {
                        switch ($usersd[0]['v_prefix']) {
                            case '01':
                                $pre = 'นาย';
                                break;
                            case '02':
                                $pre = 'นาง';
                                break;
                            case '03':
                                $pre = 'นางสาว';
                                break;
                        }
                        $nameuser = $pre . $usersd[0]['v_fname'] . ' ' . $usersd[0]['v_lname'];
                    } else {
                        $nameuser = 'ผู้ดูแลระบบ';
                    }

                    // คำนวณวันที่ใช้งานได้
                    $date1 = new DateTime($data['prog_date_start']);
                    $date2 = new DateTime($data['prog_date_end']);
                    $interval = $date1->diff($date2);
                    $daysValid = $interval->days;

                    // แปลงข้อมูลเป็น JSON สำหรับส่งไปยัง modal
                    $programData = [
                        'id' => $data['prog_id'],
                        'name' => $data['prog_name'],
                        'detail' => $data['prog_detail'] ?? 'ดูรายละเอียดเพิ่มเติม',
                        'price' => $data['prog_price'],
                        'originalPrice' => $data['prog_price'] * 3.33, // สมมติราคาเดิมแพงกว่า 70%
                        'point' => $data['prog_point'],
                        'dateStart' => $data['prog_date_start'],
                        'dateEnd' => $data['prog_date_end'],
                        'daysValid' => $daysValid,
                        'img' => $data['prog_img'],
                        'type' => $data['prog_type'],
                        'creator' => $nameuser,
                        'sessions' => $data['prog_rounds'] // ค่าเริ่มต้น สามารถปรับได้
                    ];
                ?>
                    <div class="text-center py-12">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover-lift cursor-pointer">
                            <!-- Image -->
                            <div class="relative h-48 overflow-hidden" style="background: linear-gradient(to bottom right, <?php echo $primaryColor; ?> ,<?php echo $secondaryColor; ?>);">
                                <?php if (!empty($data['prog_img'])) { ?>
                                    <img src="program/img/<?php echo htmlspecialchars($data['prog_img']); ?>"
                                        alt="<?php echo htmlspecialchars($data['prog_name']); ?>"
                                        class="w-full h-full object-cover">
                                <?php } else { ?>
                                    <div class="w-full h-full flex items-center justify-center text-white">
                                        <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path>
                                            <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                <?php } ?>

                                <div class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                                    -70%
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full mb-3"
                                    style="background-color: rgba(186, 154, 139, 0.15); color: <?php echo $primaryColor; ?>;">
                                    <?php
                                    // แสดงประเภทโปรแกรม
                                    $typeText = 'ทั่วไป';
                                    switch ($data['prog_type']) {
                                        case '01':
                                            $typeText = 'ดูแลผิวหน้า';
                                            break;
                                        case '02':
                                            $typeText = 'ดูแลผิวกาย';
                                            break;
                                        case '03':
                                            $typeText = 'ลดน้ำหนัก';
                                            break;
                                        case '04':
                                            $typeText = 'นวด/สปา';
                                            break;
                                    }
                                    echo $typeText;
                                    ?>
                                </span>

                                <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2"><?php echo $data['prog_name']; ?></h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2"><?php echo $data['prog_detail']; ?></p>

                                <!-- Info -->
                                <div class="space-y-2 mb-4 text-sm">
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>สามารถใช้บริการได้ <span class="font-bold"><?php echo $data['prog_rounds']; ?></span> ครั้ง • ใช้ได้ภายใน <span class="font-bold"><?php echo $daysValid; ?></span> วัน</span>
                                    </div>
                                    <?php if ($data['prog_point'] > 0) { ?>
                                        <div class="flex items-center text-purple-600">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <span>รับ <?php echo number_format($data['prog_point']); ?> คะแนน</span>
                                        </div>
                                    <?php } ?>

                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                        </svg>
                                        <span>สร้างโดย: <?php echo htmlspecialchars($nameuser); ?></span>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="flex items-end justify-between pt-4 border-t gap-2">
                                    <div>
                                        <p class="text-sm text-gray-500 line-through">
                                            ฿<?php echo number_format($data['prog_price'] * 3.33, 2); ?>
                                        </p>
                                        <p class="text-2xl font-bold" style="color: <?php echo $primaryColor; ?>;">
                                            ฿<?php echo number_format($data['prog_price'], 2); ?>
                                        </p>
                                    </div>
                                    <div class="flex gap-2">
                                        <button onclick='viewProgram(<?php echo htmlspecialchars(json_encode($programData)); ?>)'
                                            class="px-3 py-2 text-white rounded-lg font-medium hover:opacity-90 transition"
                                            style="background-color: <?php echo $primaryColor; ?>">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>

                                        <button onclick="openEditModal(<?php echo htmlspecialchars(json_encode($programData)); ?>)"
                                            class="px-3 py-2 text-white rounded-lg font-medium hover:opacity-90 transition"
                                            style="background-color: <?php echo $primaryColor; ?>;">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php }
            ?>
        </div>
    </div>

    <!-- Program Detail Modal -->
    <div id="programModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 top-auto">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="relative">
                <!-- Image Header -->
                <div id="modalImage" class="h-64 bg-cover bg-center relative" style="background: linear-gradient(to bottom right, <?php echo $primaryColor; ?>, <?php echo $secondaryColor; ?>);">
                    <div class="absolute top-4 right-4">
                        <button onclick="closeModal()"
                            class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-gray-100 transition">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="mb-6">
                        <div class="flex items-start justify-between mb-3">
                            <h2 id="modalTitle" class="text-3xl font-bold text-gray-800"></h2>
                            <span id="modalCategory" class="px-3 py-1 text-sm font-semibold rounded-full"
                                style="background-color: rgba(186, 154, 139, 0.15); color: <?php echo $primaryColor; ?>;">
                            </span>
                        </div>
                        <p id="modalDescription" class="text-gray-600 leading-relaxed"></p>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <p class="text-sm text-gray-600 mb-1">จำนวนครั้ง</p>
                            <p id="modalSessions" class="text-2xl font-bold" style="color: <?php echo $primaryColor; ?>;"></p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <p class="text-sm text-gray-600 mb-1">ราคา</p>
                            <p id="modalPrice" class="text-2xl font-bold" style="color: <?php echo $primaryColor; ?>;"></p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <p class="text-sm text-gray-600 mb-1">คะแนนที่ได้</p>
                            <p id="modalPoints" class="text-2xl font-bold text-purple-600"></p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <p class="text-sm text-gray-600 mb-1">ระยะเวลา</p>
                            <p id="modalDuration" class="text-2xl font-bold text-blue-600"></p>
                        </div>
                    </div>

                    <!-- Discount Badge -->
                    <div class="mb-6">
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path>
                                <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-red-800 font-semibold">ส่วนลดพิเศษ 70%</span>
                        </div>
                    </div>

                    <!-- Info List -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <h3 class="font-semibold text-blue-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            ข้อมูลโปรแกรม
                        </h3>
                        <ul class="space-y-2 text-sm text-blue-900">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>ใช้งานได้ <span id="modalDurationInfo"></span> วัน หลังจากซื้อ</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>สามารถใช้บริการได้ <span id="modalSessionsInfo"></span> ครั้ง</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>รับคะแนนสะสมทันที <span id="modalPointsInfo"></span> คะแนน</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>โปรแกรมมีผลถึง <span id="modalValidUntil"></span></span>
                            </li>
                        </ul>
                    </div>

                    <!-- Call to Action -->
                    <div class="flex gap-3">
                        <button onclick="closeModal()"
                            class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                            ปิด
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Program Modal -->
    <div id="editProgramModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">แก้ไขโปรแกรม</h2>
                    <button onclick="closeEditModal()"
                        class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200 transition">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="editProgramForm" enctype="multipart/form-data">
                    <input type="hidden" id="edit_prog_id" name="prog_id">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- ชื่อโปรแกรม -->
                        <div>
                            <label for="edit_prog_name" class="block text-sm font-medium text-gray-700 mb-2">ชื่อโปรแกรม</label>
                            <input type="text" id="edit_prog_name" name="prog_name" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- ประเภทโปรแกรม -->
                        <div>
                            <label for="edit_prog_type" class="block text-sm font-medium text-gray-700 mb-2">ประเภทโปรแกรม</label>
                            <select id="edit_prog_type" name="prog_type" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="01">ดูแลผิวหน้า</option>
                                <option value="02">ดูแลผิวกาย</option>
                                <option value="03">ลดน้ำหนัก</option>
                                <option value="04">นวด/สปา</option>
                            </select>
                        </div>

                        <!-- ราคา -->
                        <div>
                            <label for="edit_prog_price" class="block text-sm font-medium text-gray-700 mb-2">ราคา</label>
                            <input type="number" id="edit_prog_price" name="prog_price" step="0.01" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- คะแนน -->
                        <div>
                            <label for="edit_prog_point" class="block text-sm font-medium text-gray-700 mb-2">คะแนนที่ได้รับ</label>
                            <input type="number" id="edit_prog_point" name="prog_point" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- จำนวนรอบ -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">จำนวนรอบ</label>
                            <input type="number" id="edit_prog_rounds" min="1" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        </div>

                        <!-- วันที่เริ่มต้น -->
                        <div>
                            <label for="edit_prog_date_start" class="block text-sm font-medium text-gray-700 mb-2">วันที่เริ่มต้น</label>
                            <input type="date" id="edit_prog_date_start" name="prog_date_start" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- วันที่สิ้นสุด -->
                        <div>
                            <label for="edit_prog_date_end" class="block text-sm font-medium text-gray-700 mb-2">วันที่สิ้นสุด</label>
                            <input type="date" id="edit_prog_date_end" name="prog_date_end" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <!-- รายละเอียด -->
                    <div class="mb-6">
                        <label for="edit_prog_detail" class="block text-sm font-medium text-gray-700 mb-2">รายละเอียดโปรแกรม</label>
                        <textarea id="edit_prog_detail" name="prog_detail" rows="4" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <!-- รูปภาพ -->
                    <div class="mb-6">
                        <label for="edit_prog_img" class="block text-sm font-medium text-gray-700 mb-2">รูปภาพโปรแกรม</label>
                        <input type="file" id="edit_prog_img" name="prog_img" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-1">หากไม่ต้องการเปลี่ยนรูปภาพ ให้เว้นว่างไว้</p>
                        <div id="currentImagePreview" class="mt-2"></div>
                    </div>

                    <!-- ปุ่มดำเนินการ -->
                    <div class="flex gap-3 pt-6 border-t">
                        <button type="button" onclick="deleteProgram()"
                            class="flex-1 px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                            ลบโปรแกรม
                        </button>
                        <button type="button" onclick="deactivateProgram()"
                            class="flex-1 px-6 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition font-medium">
                            ปิดการใช้งาน
                        </button>
                        <button type="submit"
                            class="flex-1 px-6 py-3 text-white rounded-lg hover:opacity-90 transition font-medium"
                            style="background-color: <?php echo $primaryColor; ?>;">
                            บันทึกการแก้ไข
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const PRIMARY_COLOR = '<?php echo $primaryColor; ?>';
        const SECONDARY_COLOR = '<?php echo $secondaryColor; ?>';

        let currentProgram = null;

        function viewProgram(programData) {
            currentProgram = programData;
            console.log('Viewing program:', programData);
            // Set modal image
            const modalImage = document.getElementById('modalImage');
            if (programData.img) {
                modalImage.style.backgroundImage = `url('program/img/${programData.img}')`;
                modalImage.style.backgroundSize = 'cover';
                modalImage.style.backgroundPosition = 'center';
            }

            // Set modal content
            document.getElementById('modalTitle').textContent = programData.name;
            document.getElementById('modalDescription').textContent = programData.detail;

            // Set category
            const typeMap = {
                '01': 'ดูแลผิวหน้า',
                '02': 'ดูแลผิวกาย',
                '03': 'ลดน้ำหนัก',
                '04': 'นวด/สปา'
            };
            document.getElementById('modalCategory').textContent = typeMap[programData.type] || 'ทั่วไป';

            // Set details
            document.getElementById('modalSessions').textContent = programData.sessions + ' ครั้ง';
            document.getElementById('modalPrice').textContent = '฿' + parseFloat(programData.price).toLocaleString('th-TH', {
                minimumFractionDigits: 2
            });
            document.getElementById('modalPoints').textContent = parseInt(programData.point).toLocaleString() + ' คะแนน';
            document.getElementById('modalDuration').textContent = programData.daysValid + ' วัน';

            // Set info list
            document.getElementById('modalDurationInfo').textContent = programData.daysValid;
            document.getElementById('modalSessionsInfo').textContent = programData.sessions;
            document.getElementById('modalPointsInfo').textContent = parseInt(programData.point).toLocaleString();

            // Format date
            const endDate = new Date(programData.dateEnd);
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            document.getElementById('modalValidUntil').textContent = endDate.toLocaleDateString('th-TH', options);

            // Show modal
            document.getElementById('programModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('programModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentProgram = null;
        }

        // ฟังก์ชันเปิด modal แก้ไขโปรแกรม
        function openEditModal(programData) {
            currentProgram = programData;

            // เติมข้อมูลในฟอร์ม
            document.getElementById('edit_prog_id').value = programData.id;
            document.getElementById('edit_prog_name').value = programData.name;
            document.getElementById('edit_prog_type').value = programData.type;
            document.getElementById('edit_prog_price').value = programData.price;
            document.getElementById('edit_prog_point').value = programData.point;
            document.getElementById('edit_prog_rounds').value = programData.sessions;
            document.getElementById('edit_prog_date_start').value = programData.dateStart;
            document.getElementById('edit_prog_date_end').value = programData.dateEnd;
            document.getElementById('edit_prog_detail').value = programData.detail;

            // แสดงรูปภาพปัจจุบัน
            const previewContainer = document.getElementById('currentImagePreview');
            if (programData.img) {
                previewContainer.innerHTML = `
                    <p class="text-sm text-gray-600 mb-2">รูปภาพปัจจุบัน:</p>
                    <img src="program/img/${programData.img}" alt="${programData.name}" class="w-32 h-32 object-cover rounded-lg border">
                `;
            } else {
                previewContainer.innerHTML = '<p class="text-sm text-gray-600">ไม่มีรูปภาพ</p>';
            }

            // แสดง modal
            document.getElementById('editProgramModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            document.getElementById('editProgramModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentProgram = null;
        }

        // ฟังก์ชันแก้ไขโปรแกรม
        function edit_programs() {
            var prog_id = $("#edit_prog_id").val();
            var prog_name = $("#edit_prog_name").val();
            var prog_point = $("#edit_prog_point").val();
            var prog_rounds = $("#edit_prog_rounds").val();
            var prog_date_start = $("#edit_prog_date_start").val();
            var prog_date_end = $("#edit_prog_date_end").val();
            var prog_price = $("#edit_prog_price").val();
            var prog_detail = $("#edit_prog_detail").val();
            var prog_type = $("#edit_prog_type").val();
            var prog_img = $("#edit_prog_img")[0].files[0];

            // ตรวจสอบวันที่
            if (new Date(prog_date_end) <= new Date(prog_date_start)) {
                showSwalMessage('วันที่สิ้นสุดต้องมากกว่าวันที่เริ่มต้น', 'warning', 'ตกลง', 'edit_prog_date_end');
                return;
            }

            // ตรวจสอบประเภทไฟล์ (ถ้ามีการอัพโหลดรูปภาพใหม่)
            if (prog_img && !isValidImageFile(prog_img)) {
                showSwalMessage('กรุณาเลือกไฟล์รูปภาพที่มีนามสกุล .jpg, .png, หรือ .gif เท่านั้น', 'warning', 'ตกลง', 'edit_prog_img');
                return;
            }

            var formData = new FormData();

            formData.append("status", 'edit_program');
            formData.append("prog_id", prog_id);
            formData.append("prog_name", prog_name);
            formData.append("prog_point", prog_point);
            formData.append("prog_rounds", prog_rounds);
            formData.append("prog_date_start", prog_date_start);
            formData.append("prog_date_end", prog_date_end);
            formData.append("prog_price", prog_price);
            formData.append("prog_detail", prog_detail);
            formData.append("prog_type", prog_type);

            // เพิ่มรูปภาพถ้ามีการอัพโหลดใหม่
            if (prog_img) {
                formData.append("prog_img", prog_img);
            }

            //เช็คข้อมูล formdata
            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }

            $.ajax({
                type: "POST",
                url: "../config/ctrl_Programs.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data === "success") {
                        showSwalMessage('แก้ไขโปรแกรมสำเร็จ', 'success', 'ตกลง');
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        console.log(data);
                        showSwalMessage('เกิดข้อผิดพลาดในการแก้ไขโปรแกรม', 'error', 'ตกลง');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    showSwalMessage('เกิดข้อผิดพลาดในการเชื่อมต่อ', 'error', 'ตกลง');
                }
            });
        }

        // ฟังก์ชันลบโปรแกรม
        function deleteProgram() {
            if (!currentProgram) return;

            Swal.fire({
                title: 'ยืนยันการลบโปรแกรม',
                html: `<p class="mb-4">คุณต้องการลบโปรแกรม <strong>"${currentProgram.name}"</strong> ใช่หรือไม่?</p>
                       <p class="text-red-600">การกระทำนี้ไม่สามารถย้อนกลับได้!</p>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ลบโปรแกรม',
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6b7280'
            }).then((result) => {
                if (result.isConfirmed) {
                    // ส่งคำขอลบไปยังเซิร์ฟเวอร์
                    $.ajax({
                        type: "POST",
                        url: "../config/ctrl_Programs.php",
                        data: {
                            status: 'delete_program',
                            prog_id: currentProgram.id
                        },
                        success: function(data) {
                            if (data === "success") {
                                showSwalMessage('ลบโปรแกรมสำเร็จ', 'success', 'ตกลง');
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            } else {
                                showSwalMessage('เกิดข้อผิดพลาดในการลบโปรแกรม', 'error', 'ตกลง');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            showSwalMessage('เกิดข้อผิดพลาดในการเชื่อมต่อ', 'error', 'ตกลง');
                        }
                    });
                }
            });
        }

        // ฟังก์ชันปิดการใช้งานโปรแกรม
        function deactivateProgram() {
            if (!currentProgram) return;

            Swal.fire({
                title: 'ยืนยันการปิดการใช้งาน',
                html: `<p class="mb-4">คุณต้องการปิดการใช้งานโปรแกรม <strong>"${currentProgram.name}"</strong> ใช่หรือไม่?</p>
                       <p class="text-yellow-600">โปรแกรมจะไม่แสดงในรายการ แต่ยังคงอยู่ในระบบ</p>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ปิดการใช้งาน',
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#eab308',
                cancelButtonColor: '#6b7280'
            }).then((result) => {
                if (result.isConfirmed) {
                    // ส่งคำขอปิดการใช้งานไปยังเซิร์ฟเวอร์
                    $.ajax({
                        type: "POST",
                        url: "../config/ctrl_Programs.php",
                        data: {
                            status: 'deactivate_program',
                            prog_id: currentProgram.id
                        },
                        success: function(data) {
                            if (data === "success") {
                                showSwalMessage('ปิดการใช้งานโปรแกรมสำเร็จ', 'success', 'ตกลง');
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            } else {
                                showSwalMessage('เกิดข้อผิดพลาดในการปิดการใช้งาน', 'error', 'ตกลง');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            showSwalMessage('เกิดข้อผิดพลาดในการเชื่อมต่อ', 'error', 'ตกลง');
                        }
                    });
                }
            });
        }

        // ฟังก์ชันตรวจสอบไฟล์รูปภาพ
        function isValidImageFile(file) {
            if (!file) return true; // ถ้าไม่มีไฟล์ให้ผ่าน (ไม่บังคับเปลี่ยนรูป)

            const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            return validTypes.includes(file.type);
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Submit form แก้ไขโปรแกรม
            document.getElementById('editProgramForm').addEventListener('submit', function(e) {
                e.preventDefault();
                edit_programs();
            });

            // Close modal when clicking outside
            document.getElementById('programModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });

            document.getElementById('editProgramModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeEditModal();
                }
            });

            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (!document.getElementById('programModal').classList.contains('hidden')) {
                        closeModal();
                    }
                    if (!document.getElementById('editProgramModal').classList.contains('hidden')) {
                        closeEditModal();
                    }
                }
            });
        });
    </script>
</body>

</html>