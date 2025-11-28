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
    function resizeImage($file, $destination, $max_width, $max_height)
    {
        list($width, $height) = getimagesize($file);
        $ratio = $width / $height;

        if ($width > $max_width || $height > $max_height) {
            if ($ratio > 1) {
                $new_width = $max_width;
                $new_height = $max_width / $ratio;
            } else {
                $new_width = $max_height * $ratio;
                $new_height = $max_height;
            }

            $src = imagecreatefromstring(file_get_contents($file));
            $dst = imagecreatetruecolor($new_width, $new_height);

            imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($dst, $destination, 90);

            imagedestroy($src);
            imagedestroy($dst);
        } else {
            copy($file, $destination);
        }
    }
    // รับข้อมูลจาก FormData
    $prog_id = $_POST['prog_id'] ?? '';
    $prog_userAdd = $_POST['prog_userAdd'] ?? '';
    $prog_name = $_POST['prog_name'] ?? '';
    $prog_point = $_POST['prog_point'] ?? '';
    $prog_date_start = $_POST['prog_date_start'] ?? '';
    $prog_date_end = $_POST['prog_date_end'] ?? '';
    $prog_price = $_POST['prog_price'] ?? '';
    $prog_rounds = $_POST['prog_rounds'] ?? '';
    $prog_detail = $_POST['prog_detail'] ?? '';
    $prog_type = $_POST['prog_type'] ?? '';
    $Pstatus = $_POST['status'] ?? '';


    if ($Pstatus == "add_program") {
        // บันทึกข้อมูลลงฐานข้อมูล
        $db = new Database('u507667907_Vnyce'); // เปลี่ยนชื่อ database ตามของคุณ
        $db->Table = "V_program"; // เปลี่ยนชื่อตารางตามของคุณ
        $db->Field = "prog_name, prog_detail, prog_price, prog_rounds, prog_point, prog_date_start, prog_date_end, prog_type, prog_img, prog_userAdd, prog_status, prog_dateAdd";
        $db->Value = "'$prog_name', '$prog_detail', '$prog_price', '$prog_rounds', '$prog_point', '$prog_date_start', '$prog_date_end', '" . str_pad($prog_type, 2, '0', STR_PAD_LEFT) . "', '', '$prog_userAdd', '01', NOW()";
        $result = $db->Insert();

        $db2 = new Database('nurse');
        $db2->Table = "V_program";
        $db2->Where = "where prog_name='$prog_name' AND prog_detail = '$prog_detail' AND prog_price='$prog_price' AND prog_img = '' order by prog_id desc Limit 1";
        $user = $db2->Select();
        foreach ($user as $values => $data) {
            $slide_pict1 = $_FILES['prog_img']['name'];

            if (!empty($slide_pict1)) {

                // ดึงนามสกุลไฟล์
                $ext = pathinfo($slide_pict1, PATHINFO_EXTENSION);

                // ตั้งชื่อไฟล์ใหม่
                $FileFrm = "IMG_Program_" . $data['prog_id'] . "." . strtolower($ext);

                // path ปลายทาง
                $uploadDir  = __DIR__ . "/../admin/program/img/";  // ใช้ absolute path
                $uploadPath = $uploadDir . $FileFrm;

                // ตรวจสอบว่าโฟลเดอร์เขียนได้ไหม
                if (!is_dir($uploadDir)) {
                    die("Error: Upload directory not found.");
                }
                if (!is_writable($uploadDir)) {
                    die("Error: Upload directory is not writable.");
                }

                // ถ้าไฟล์ > 2 MB ปรับขนาด
                if ($_FILES['prog_img']['size'] > 2 * 1024 * 1024) {

                    // ถ้ามีฟังก์ชัน resize ให้เรียก
                    if (function_exists('resizeImage')) {
                        resizeImage($_FILES['prog_img']['tmp_name'], $uploadPath, 1024, 768);
                    } else {
                        die("resizeImage() is missing!");
                    }
                } else {
                    // อัปโหลดตรงๆ
                    if (!move_uploaded_file($_FILES["prog_img"]["tmp_name"], $uploadPath)) {
                        die("Error uploading file.");
                    }
                }

                // ตั้ง permission
                chmod($uploadPath, 0644);

                // update database
                $db1 = new Database('nurse');
                $db1->Table = "V_program";
                $db1->Set   = "prog_img='$FileFrm'";
                $db1->Where = "WHERE prog_id='{$data['prog_id']}'";
                $db1->Update();
            }
        }

        if ($result) {
            echo "success";
        } else {
            // ลบไฟล์ที่อัพโหลดถ้าบันทึกข้อมูลไม่สำเร็จ
            if (file_exists($uploadPath)) {
                unlink($uploadPath);
            }
            echo "error_database";
        }
    } else if ($Pstatus == "edit_program") {
        // ตรวจสอบว่ามีโปรแกรมนี้อยู่หรือไม่
        $db_check = new Database('u507667907_Vnyce');
        $db_check->Table = "V_program";
        $db_check->Where = "WHERE prog_id = '$prog_id'";
        $existing_program = $db_check->Select();

        if (count($existing_program) == 0) {
            echo "program_not_found";
            exit();
        }

        // เตรียมข้อมูลสำหรับการอัพเดท
        $update_fields = [
            "prog_name = '$prog_name'",
            "prog_detail = '$prog_detail'",
            "prog_price = '$prog_price'",
            "prog_point = '$prog_point'",
            "prog_rounds = '$prog_rounds'",
            "prog_date_start = '$prog_date_start'",
            "prog_date_end = '$prog_date_end'",
            "prog_type = '" . str_pad($prog_type, 2, '0', STR_PAD_LEFT) . "'",
            "prog_dateAdd = NOW()"
        ];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if (isset($_FILES['prog_img']) && $_FILES['prog_img']['error'] == 0) {
            $slide_pict1 = $_FILES['prog_img']['name'];

            if (!empty($slide_pict1)) {
                // ดึงนามสกุลไฟล์
                $ext = pathinfo($slide_pict1, PATHINFO_EXTENSION);

                // ตั้งชื่อไฟล์ใหม่
                $FileFrm = "IMG_Program_" . $prog_id . "." . strtolower($ext);

                // path ปลายทาง
                $uploadDir  = __DIR__ . "/../admin/program/img/";
                $uploadPath = $uploadDir . $FileFrm;

                // ตรวจสอบว่าโฟลเดอร์เขียนได้ไหม
                if (!is_dir($uploadDir)) {
                    die("Error: Upload directory not found.");
                }
                if (!is_writable($uploadDir)) {
                    die("Error: Upload directory is not writable.");
                }

                // ลบไฟล์เก่าถ้ามี
                $old_image = $existing_program[0]['prog_img'];
                if (!empty($old_image) && file_exists($uploadDir . $old_image)) {
                    unlink($uploadDir . $old_image);
                }

                // ถ้าไฟล์ > 2 MB ปรับขนาด
                if ($_FILES['prog_img']['size'] > 2 * 1024 * 1024) {
                    // ใช้ฟังก์ชัน resizeImage
                    resizeImage($_FILES['prog_img']['tmp_name'], $uploadPath, 1024, 768);
                } else {
                    // อัปโหลดตรงๆ
                    if (!move_uploaded_file($_FILES["prog_img"]["tmp_name"], $uploadPath)) {
                        die("Error uploading file.");
                    }
                }

                // ตั้ง permission
                chmod($uploadPath, 0644);

                // เพิ่มฟิลด์รูปภาพในการอัพเดท
                $update_fields[] = "prog_img = '$FileFrm'";
            }
        }

        // อัพเดทข้อมูลในฐานข้อมูล
        $db = new Database('u507667907_Vnyce');
        $db->Table = "V_program";
        $db->Set = implode(", ", $update_fields);
        $db->Where = "WHERE prog_id = '$prog_id'";
        $result = $db->Update();

        if ($result) {
            echo "success";
        } else {
            // ลบไฟล์ที่อัพโหลดใหม่ถ้าอัพเดทข้อมูลไม่สำเร็จ
            if (isset($uploadPath) && file_exists($uploadPath)) {
                unlink($uploadPath);
            }
            echo "error_database";
        }
    } else if ($Pstatus == "delete_program") {
        // ตรวจสอบว่ามีโปรแกรมนี้อยู่หรือไม่
        $db_check = new Database('u507667907_Vnyce');
        $db_check->Table = "V_program";
        $db_check->Where = "WHERE prog_id = '$prog_id'";
        $existing_program = $db_check->Select();

        if (count($existing_program) == 0) {
            echo "program_not_found";
            exit();
        }

        // ลบรูปภาพถ้ามี
        $old_image = $existing_program[0]['prog_img'];
        if (!empty($old_image)) {
            $imagePath = __DIR__ . "/../admin/program/img/" . $old_image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // ลบข้อมูลจากฐานข้อมูล
        $db = new Database('u507667907_Vnyce');
        $db->Table = "V_program";
        $db->Where = "WHERE prog_id = '$prog_id'";
        $result = $db->Delete();

        if ($result) {
            echo "success";
        } else {
            echo "error_database";
        }
    } else if ($Pstatus == "deactivate_program") {
        // ตรวจสอบว่ามีโปรแกรมนี้อยู่หรือไม่
        $db_check = new Database('u507667907_Vnyce');
        $db_check->Table = "V_program";
        $db_check->Where = "WHERE prog_id = '$prog_id'";
        $existing_program = $db_check->Select();

        if (count($existing_program) == 0) {
            echo "program_not_found";
            exit();
        }

        // อัพเดทสถานะเป็นปิดการใช้งาน (02)
        $db = new Database('u507667907_Vnyce');
        $db->Table = "V_program";
        $db->Set = "prog_status = '02', prog_dateAdd = NOW()";
        $db->Where = "WHERE prog_id = '$prog_id'";
        $result = $db->Update();

        if ($result) {
            echo "success";
        } else {
            echo "error_database";
        }
    }
} catch (Exception $e) {
    // Log error
    error_log("Program Add Error: " . $e->getMessage());
    echo "error_exception: " . $e->getMessage();
}
