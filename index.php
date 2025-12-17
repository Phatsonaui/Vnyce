<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN</title>
  <link rel="icon" href="img/Fon.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;300&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      /* สีหลักของแบรนด์ */
      --primary: #BA9A8B;
      --primary-light: #D4BFB3;
      --primary-dark: #9A7A6B;

      /* สีพื้นหลัง */
      --bg-body: #FFF1E8;
      --bg-card: #FFFFFF;
      --bg-accent: #F6E4D2;

      /* สีตัวอักษร */
      --text-dark: #4A3428;
      --text-muted: #8B7968;

      /* อื่นๆ */
      --border-color: rgba(186, 154, 139, 0.2);
      --sidebar-width: 260px;
      --sidebar-collapsed: 70px;
      --header-height: 64px;

      /* เงา */
      --shadow-sm: 0 1px 3px rgba(186, 154, 139, 0.1);
      --shadow-md: 0 4px 6px -1px rgba(186, 154, 139, 0.15);
      --shadow-lg: 0 10px 15px -3px rgba(186, 154, 139, 0.2);
    }

    /* ==================== FORM SECTIONS ==================== */
    .form-section {
      margin-bottom: 32px;
    }

    .form-section:last-child {
      margin-bottom: 0;
    }

    .section-title {
      font-size: 18px;
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 16px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .section-title i {
      color: var(--primary);
      font-size: 20px;
    }

    /* ==================== FORM GROUPS ==================== */
    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      color: var(--text-dark);
      margin-bottom: 8px;
    }

    .required {
      color: var(--error);
      margin-left: 4px;
    }

    /* ==================== INPUTS ==================== */
    .form-input,
    .form-select,
    .form-textarea {
      width: 100%;
      padding: 14px 16px;
      border: 2px solid var(--border-color);
      border-radius: 12px;
      font-size: 15px;
      font-family: 'Prompt', sans-serif;
      color: var(--text-dark);
      background: white;
      transition: all 0.3s ease;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(186, 154, 139, 0.1);
      transform: translateY(-2px);
    }

    .form-input::placeholder {
      color: var(--text-muted);
    }

    .form-textarea {
      min-height: 100px;
      resize: vertical;
    }

    /* Input with Icon */
    .input-group {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-muted);
      font-size: 18px;
      pointer-events: none;
      transition: color 0.3s ease;
    }

    .input-group .form-input,
    .input-group .form-select {
      padding-left: 48px;
    }

    .input-group .form-input:focus~.input-icon,
    .input-group .form-select:focus~.input-icon {
      color: var(--primary);
    }

    /* ==================== GRID LAYOUT ==================== */
    .form-grid {
      display: grid;
      gap: 20px;
    }

    .form-grid-2 {
      grid-template-columns: repeat(2, 1fr);
    }

    /* ==================== INFO BOX ==================== */
    .info-box {
      background: linear-gradient(135deg, var(--bg-accent) 0%, #fff 100%);
      border-left: 4px solid var(--primary);
      padding: 16px;
      border-radius: 12px;
      margin-bottom: 24px;
      display: flex;
      gap: 12px;
      align-items: start;
    }

    .info-box i {
      color: var(--primary);
      font-size: 24px;
      flex-shrink: 0;
      margin-top: 2px;
    }

    .info-box-content p {
      color: var(--text-dark);
      font-size: 14px;
      line-height: 1.6;
      margin-bottom: 8px;
    }

    .info-box-content p:last-child {
      margin-bottom: 0;
    }

    /* ==================== CHECKBOX ==================== */
    .checkbox-wrapper {
      display: flex;
      align-items: start;
      gap: 12px;
      cursor: pointer;
    }

    .checkbox-wrapper input[type="checkbox"] {
      width: 20px;
      height: 20px;
      border: 2px solid var(--border-color);
      border-radius: 6px;
      cursor: pointer;
      flex-shrink: 0;
      margin-top: 2px;
      transition: all 0.3s ease;
    }

    .checkbox-wrapper input[type="checkbox"]:checked {
      background: var(--primary);
      border-color: var(--primary);
    }

    .checkbox-wrapper label {
      font-size: 14px;
      color: var(--text-dark);
      cursor: pointer;
      margin: 0;
    }
  </style>
</head>

<body class="bg-gradient-to-br from-amber-50 to-stone-100 min-h-screen">

  <!-- 🔸 Toast Container -->
  <div id="messaged" class="fixed top-4 right-4 z-50 flex flex-col gap-3"></div>

  <div class="flex items-center justify-center min-h-screen p-4">
    <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-2xl">

      <!-- Logo -->
      <div class="text-center mb-8">
        <h1 class="text-4xl font-bold" style="color: #B8A08A;">V'NYCE</h1>
        <p class="text-gray-500 mt-2">ระบบจัดการสมาชิก</p>
      </div>

      <!-- Tabs -->
      <div class="flex mb-6 bg-gray-100 rounded-lg p-1">
        <button onclick="showLogin()" id="loginTab"
          class="flex-1 py-2 rounded-lg font-medium transition-all bg-white shadow" style="color: #B8A08A;">
          เข้าสู่ระบบ
        </button>
        <button onclick="showRegister()" id="registerTab"
          class="flex-1 py-2 rounded-lg font-medium transition-all text-gray-600">
          สมัครสมาชิก
        </button>
      </div>

      <!-- Login Form -->
      <div id="loginForm">
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">เบอร์โทรศัพท์</label>
            <input type="number" id="tel" required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none transition"
              placeholder="0812345678">
          </div>

          <!-- <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">รหัสผ่าน</label>
              <input type="password" id="loginPassword" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none transition"
                placeholder="••••••••">
            </div> -->

          <button type="submit" id="loginBtn"
            class="w-full bg-purple-600 text-white py-3 rounded-lg font-medium hover:bg-purple-700 transition transform hover:scale-105 active:scale-95">
            เข้าสู่ระบบ
          </button>
        </div>
      </div>

      <!-- Register Form -->
      <div id="registerForm" class="hidden">
        <div class="form-section">
          <h3 class="section-title">
            <i class="fas fa-user"></i>
            ข้อมูลส่วนตัว
          </h3>

          <div class="form-group">
            <label for="regPrefix">คำนำหน้า <span class="required" style="color: red;">*</span></label>
            <div class="input-group">
              <select id="regPrefix" name="regPrefix" class="form-select" required aria-required="true">
                <option value="">เลือกคำนำหน้า</option>
                <option value="01">นาย</option>
                <option value="02">นาง</option>
                <option value="03">นางสาว</option>
              </select>
              <i class="input-icon fas fa-user"></i>
            </div>
          </div>
          <div class="form-grid form-grid-2">
            <div class="form-group">
              <label for="regFirstName">ชื่อ <span class="required" style="color: red;">*</span></label>
              <div class="input-group">
                <input type="text" id="regFirstName" name="regFirstName" class="form-input" required
                  placeholder="กรอกชื่อ"
                  aria-required="true">
                <i class="input-icon fas fa-user"></i>
              </div>
            </div>
            <div class="form-group">
              <label for="regLastName">นามสกุล <span class="required" style="color: red;">*</span></label>
              <div class="input-group">
                <input type="text" id="regLastName" name="regLastName" class="form-input" required
                  placeholder="กรอกนามสกุล"
                  aria-required="true">
                <i class="input-icon fas fa-user"></i>
              </div>
            </div>
          </div>

          <div class="form-grid form-grid-2">
            <div class="form-group">
              <label for="regPhone">เบอร์โทรศัพท์ <span class="required" style="color: red;">*</span></label>
              <div class="input-group">
                <input type="tel"
                  id="regPhone"
                  name="regPhone"
                  class="form-input"
                  placeholder="0XX-XXX-XXXX"
                  pattern="[0-9]{10}"
                  required
                  aria-required="true">
                <i class="input-icon fas fa-phone"></i>
              </div>
            </div>

            <div class="form-group">
              <label for="regEmail">อีเมล</label>
              <div class="input-group">
                <input type="email"
                  id="regEmail"
                  name="regEmail"
                  class="form-input"
                  placeholder="example@email.com">
                <i class="input-icon fas fa-envelope"></i>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="regBirthDate">วันเกิด <span style="color: red;" class="required">*</span></label>
            <div class="input-group">
              <input type="date"
                id="regBirthDate"
                name="regBirthDate"
                class="form-input"
                required
                aria-required="true">
              <i class="input-icon fas fa-calendar"></i>
            </div>
          </div>
          <button type="submit" id="registerBtn" class="btn btn-primary">
            <i class="fas fa-check"></i>
            สมัครสมาชิก
          </button>
        </div>

        <!-- <div class="space-y-4">
          <div class="grid grid-cols-3 gap-3">
            <div class="col-span-1">
              <label class="block text-sm font-medium text-gray-700 mb-2">คำนำหน้า</label>
              <select id="regPrefix" required
                class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none">
                <option value="01">นาย</option>
                <option value="02">นาง</option>
                <option value="03">นางสาว</option>
              </select>
            </div>
          </div>

          <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">ชื่อ</label>
            <input type="text" id="regFirstName" required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none"
              placeholder="ชื่อ">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">นามสกุล</label>
            <input type="text" id="regLastName" required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none"
              placeholder="นามสกุล">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">เบอร์โทรศัพท์</label>
            <input type="tel" id="regPhone" required pattern="[0-9]{10}"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none"
              placeholder="0812345678">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">วันเกิด</label>
            <input type="date" id="regBirthDate" required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">อีเมล</label>
            <input type="email" id="regEmail" required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none"
              placeholder="your@email.com">
          </div>

          <button type="submit" id="registerBtn"
            class="w-full bg-pink-600 text-white py-3 rounded-lg font-medium hover:bg-pink-700 transition transform hover:scale-105 active:scale-95">
            สมัครสมาชิก
          </button>
        </div> -->
      </div>
    </div>
  </div>

  <script>
    /* ---------------------- Tab Control ---------------------- */
    function showLogin() {
      document.getElementById('loginForm').classList.remove('hidden');
      document.getElementById('registerForm').classList.add('hidden');
      document.getElementById('loginTab').classList.add('bg-white', 'text-purple-600', 'shadow');
      document.getElementById('loginTab').classList.remove('text-gray-600');
      document.getElementById('registerTab').classList.remove('bg-white', 'text-pink-600', 'shadow');
      document.getElementById('registerTab').classList.add('text-gray-600');
    }

    function showRegister() {
      document.getElementById('loginForm').classList.add('hidden');
      document.getElementById('registerForm').classList.remove('hidden');
      document.getElementById('registerTab').classList.add('bg-white', 'text-pink-600', 'shadow');
      document.getElementById('registerTab').classList.remove('text-gray-600');
      document.getElementById('loginTab').classList.remove('bg-white', 'text-purple-600', 'shadow');
      document.getElementById('loginTab').classList.add('text-gray-600');
    }

    /* ---------------------- Login ---------------------- */
    document.addEventListener('DOMContentLoaded', function() {
      var loginBtn = document.getElementById('loginBtn');
      var RegisBtn = document.getElementById('registerBtn');

      loginBtn.addEventListener('click', function() {
        var tel = document.getElementById('tel').value;

        if (tel === "" || tel.length !== 10) {
          Swal.fire({
            icon: 'error',
            title: 'กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง',
            timer: 3000,
            timerProgressBar: true
          });
        } else {
          var formData = new FormData();
          formData.append("tel", tel);

          $.ajax({
            type: 'POST',
            url: 'config/login.php',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
              console.log(data);
              if (data.status === 'success') {
                Swal.fire({
                  title: 'เข้าสู่ระบบสำเร็จ',
                  icon: 'success',
                  timer: 3000,
                  timerProgressBar: true,
                  confirmButtonColor: '#BA9A8B',
                  background: '#F9F5F2',
                  color: '#6B4226',
                  showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                  },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                  }
                });
                setTimeout(function() {
                  if (data.role === 'admin') {
                    window.location.href = 'admin/A_main.php?page=dash';
                  } else {
                    window.location.href = 'verify2FA.php';
                  }
                }, 3000);
                return;
              } else {
                Swal.fire({
                  itle: 'กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง',
                  icon: 'error',
                  timer: 3000,
                  timerProgressBar: true,
                  confirmButtonColor: '#BA9A8B',
                  background: '#F9F5F2',
                  color: '#6B4226',
                  showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                  },
                  hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                  }
                });
                setTimeout(function() {
                  location.reload();
                }, 3000);
                return;
              }
            }
          });
        }
      });

      /* ---------------------- Register ---------------------- */
      RegisBtn.addEventListener('click', function() {
        var prefix = document.getElementById('regPrefix').value;
        var firstName = document.getElementById('regFirstName').value;
        var lastName = document.getElementById('regLastName').value;
        var phone = document.getElementById('regPhone').value;
        var birthDate = document.getElementById('regBirthDate').value;
        var email = document.getElementById('regEmail').value;

        if (phone === "" || phone.length !== 10) {
          Swal.fire({
            icon: 'error',
            title: 'กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง',
            timer: 3000,
            timerProgressBar: true
          });
        } else {
          var formData = new FormData();
          formData.append("prefix", prefix);
          formData.append("firstName", firstName);
          formData.append("lastName", lastName);
          formData.append("phone", phone);
          formData.append("birthDate", birthDate);
          formData.append("email", email);

          $.ajax({
            type: 'POST',
            url: 'config/ctrl_register.php',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
              console.log(response);
              if (response.status === 'success') {
                Swal.fire({
                  icon: 'success',
                  title: 'สมัครสมาชิกสำเร็จ',
                  text: 'กรุณาลงชื่อเข้าใช้',
                  timer: 3000,
                  timerProgressBar: true
                });
                setTimeout(() => {
                  showLogin();
                  document.getElementById('tel').value = response.tel;
                }, 2000);
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'เกิดข้อผิดพลาด',
                  text: response.message,
                  timer: 3000,
                  timerProgressBar: true
                });
                btn.disabled = false;
                btn.textContent = 'สมัครสมาชิก';
              }
            },
            error: function() {
              Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์a',
                timer: 3000,
                timerProgressBar: true
              });
              btn.disabled = false;
              btn.textContent = 'สมัครสมาชิก';
            }
          });
        }
      });

    });
  </script>
</body>

</html>