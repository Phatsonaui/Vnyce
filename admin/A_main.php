<?php
session_start();

// ตรวจสอบการ login
if ($_SESSION['verify_V'] != "Vv_verify") {
    header("Location: ../index.php");
    exit();
}

require_once '../class/class.php';

// ถ้ามี login อยู่แล้วจะมี $_SESSION['admin_name']
$adminName = $_SESSION['name_V'] ?? "Admin";
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>V'NYCE Admin</title>
    <link rel="icon" href="img/V'NYCE.jpg" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.2/chart.umd.js" integrity="sha512-KIq/d78rZMlPa/mMe2W/QkRgg+l0/GAAu4mGBacU0OQyPV/7EPoGQChDb269GigVoPQit5CqbNRFbgTjXHHrQg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.semanticui.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <style>
        :root {
            --primary: #BA9A8B;
            --primary-light: #D4BFB3;
            --primary-dark: #9A7A6B;
            --bg-body: #FFF1E8;
            --bg-card: #FFFFFF;
            --bg-accent: #F6E4D2;
            --text-dark: #4A3428;
            --text-muted: #8B7968;
            --border-color: rgba(186, 154, 139, 0.2);
            --sidebar-width: 260px;
            --sidebar-collapsed: 70px;
            --header-height: 64px;
            --shadow-sm: 0 1px 3px rgba(186, 154, 139, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(186, 154, 139, 0.15);
            --shadow-lg: 0 10px 15px -3px rgba(186, 154, 139, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Prompt', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-dark);
            line-height: 1.6;
        }

        a {
            text-decoration: none;
        }

        /* Layout */
        .app-container {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--bg-card);
            border-right: 1px solid var(--border-color);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: fixed;
            height: 100vh;
            z-index: 1000;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }

        .sidebar-header {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: padding 0.3s ease;
        }

        .sidebar.collapsed .sidebar-header {
            padding: 1.5rem 1rem;
            justify-content: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 700;
            color: var(--primary);
            font-size: 1.25rem;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .logo {
            gap: 0;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            flex-shrink: 0;
            overflow: hidden;
        }

        .logo-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .logo-text {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .sidebar.collapsed .logo-text {
            opacity: 0;
            transform: translateX(-10px);
            pointer-events: none;
            position: absolute;
        }

        .sidebar-menu {
            padding: 1rem 0.75rem;
        }

        .nav-item {
            margin-bottom: 0.25rem;
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 500;
            position: relative;
            white-space: nowrap;
        }

        .sidebar.collapsed .nav-link {
            padding: 0.75rem;
            justify-content: center;
        }

        .nav-link:hover {
            background: rgba(186, 154, 139, 0.1);
            color: var(--primary);
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .nav-icon {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .nav-text {
            flex: 1;
            transition: all 0.3s ease;
            transform-origin: left;
        }

        .sidebar.collapsed .nav-text {
            opacity: 0;
            transform: translateX(-10px);
            pointer-events: none;
            position: absolute;
        }

        /* Tooltip for collapsed state */
        .nav-link::after {
            content: attr(data-tooltip);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%) translateX(10px);
            background: var(--text-dark);
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            font-size: 0.8rem;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
            z-index: 1001;
        }

        .sidebar.collapsed .nav-link:hover::after {
            opacity: 1;
            transform: translateY(-50%) translateX(8px);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar.collapsed~.main-content {
            margin-left: var(--sidebar-collapsed);
        }

        /* Top Header */
        .top-header {
            height: var(--header-height);
            background: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .toggle-sidebar {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .toggle-sidebar:hover {
            background: var(--border-color);
            color: var(--text-dark);
        }

        .header-breadcrumb {
            display: flex;
            align-items: center;
            justify-content: start;
            flex: 1;
            margin-left: 1rem;
        }

        .breadcrumb {
            background: none;
            margin: 0;
            padding: 0.4rem 0.75rem;
            border-radius: 8px;
            font-size: 0.9rem;
            display: flex;
            list-style: none;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item a {
            color: var(--text-muted);
            transition: color 0.2s ease;
        }

        .breadcrumb-item a:hover {
            color: var(--primary);
        }

        .breadcrumb-item.active {
            color: var(--primary-dark);
            font-weight: 600;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "›";
            color: var(--primary-light);
            font-weight: bold;
            padding: 0 0.4rem;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .user-menu:hover {
            background: var(--bg-accent);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-dark);
        }

        .user-role {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .logout-btn {
            padding: 0.5rem 1rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.85rem;
        }

        .logout-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-left {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .header-breadcrumb .breadcrumb {
                font-size: 0.85rem;
                padding: 0.25rem 0.5rem;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
                width: var(--sidebar-width);
            }

            .sidebar.mobile-open.collapsed {
                width: var(--sidebar-width);
            }

            .main-content {
                margin-left: 0 !important;
            }

            .mobile-menu-btn {
                display: block !important;
            }

            .sidebar.collapsed~.main-content {
                margin-left: 0 !important;
            }

            .user-info {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .header-breadcrumb {
                display: none;
            }

            .current-page {
                display: block;
                flex: 1;
                text-align: center;
                font-weight: 600;
                font-size: 0.95rem;
                color: var(--text-dark);
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                padding: 0.25rem 0.5rem;
            }
        }

        .current-page {
            display: none;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.25rem;
            color: var(--text-dark);
            cursor: pointer;
        }

        /* Toggle Button Animation */
        .toggle-sidebar .bi-layout-sidebar {
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed~.main-content .toggle-sidebar .bi-layout-sidebar {
            transform: rotate(180deg);
        }

        /* Content Wrapper */
        .content-wrapper {
            padding: 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Cards */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: var(--shadow-md);
        }

        .stat-card {
            transition: all 0.3s ease;
            border-radius: 12px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(186, 154, 139, 0.15);
        }

        .progress-bar-custom {
            height: 8px;
            border-radius: 4px;
            background: linear-gradient(90deg, rgba(186, 154, 139, 0.2) 0%, rgba(186, 154, 139, 0.5) 100%);
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, rgba(186, 154, 139, 0.8) 0%, rgba(186, 154, 139, 1) 100%);
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .header-breadcrumb .d-md-none.current-page {
            font-weight: 600;
            font-size: 1rem;
            color: var(--text-dark);
            padding: 0.25rem 0;
            text-align: center;
            flex: 1;
        }

        /* ปรับการจัดวางบน mobile */
        @media (max-width: 767px) {
            .header-breadcrumb {
                flex: 1;
                margin: 0 0.5rem;
            }

            .header-breadcrumb .d-md-none.current-page {
                text-align: center;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
        }
    </style>
</head>

<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar collapsed" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <div class="logo-icon">
                        <img src="https://lh3.googleusercontent.com/d/1ZjRr5V-BQnQdUPT_9cdDlNUeG974c8fU" alt="V'NYCE Logo">
                    </div>
                    <span class="logo-text">V'NYCE Admin</span>
                </div>
            </div>

            <nav class="sidebar-menu" id="s-menu">
                <ul class="nav flex-column">
                    <?php
                    $page = $_GET['page'] ?? 'dash';
                    $menuItems = [
                        ['icon' => 'bi-grid', 'label' => 'ภาพรวม', 'value' => 'dash', 'link' => 'A_main.php?page=dash'],
                        ['icon' => 'bi-people', 'label' => 'ลูกค้า', 'value' => 'customer_list', 'link' => 'A_main.php?page=customer_list'],
                        ['icon' => 'bi-calendar-check', 'label' => 'โปรแกรม', 'value' => 'prog', 'link' => 'A_main.php?page=prog'],
                        ['icon' => 'bi-tag', 'label' => 'โปรโมชั่น', 'value' => 'promotions', 'link' => 'A_main.php?page=promo'],
                        ['icon' => 'bi-wallet2', 'label' => 'Top Up', 'value' => 'topup', 'link' => 'A_main.php?page=topup'],
                        // ['icon' => 'bi-file-text', 'label' => 'รายงานจากลูกค้า', 'value' => 'reports', 'link' => 'AdminReports.php'],
                    ];

                    foreach ($menuItems as $item) {
                        $isActive = ($page === $item['value']);
                        $classes = "nav-link" . ($isActive ? " active" : "");

                        echo '<li class="nav-item">';
                        echo '<a href="' . $item['link'] . '" class="' . $classes . '" data-tooltip="' . $item['label'] . '" title="' . $item['label'] . '">';
                        echo '<i class="nav-icon ' . $item['icon'] . '"></i>';
                        echo '<span class="nav-text">' . $item['label'] . '</span>';
                        echo '</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Header -->
            <header class="top-header">
                <div class="header-left">
                    <button class="mobile-menu-btn" id="mobileMenuBtn">
                        <i class="bi bi-list"></i>
                    </button>
                    <button class="toggle-sidebar" id="toggleSidebar" title="ยุบ/ขยายเมนู">
                        <i class="bi bi-layout-sidebar"></i>
                    </button>
                </div>

                <div class="header-breadcrumb">
                    <?php
                    $breadcrumbLabels = [
                        'dash' => 'ภาพรวม',
                        'customer_list' => 'ลูกค้า',
                        'customer_history' => 'ประวัติลูกค้า',
                        'prog' => 'โปรแกรม',
                        'prog_a' => '<a style="color:#9A7A6B;" href="A_main.php?page=prog">โปรแกรม</a><li class="breadcrumb-item active" aria-current="page">เพิ่มโปรแกรม</li>',
                        'promo' => 'โปรโมชั่น',
                        'topup' => 'Top Up',
                        'settings' => 'ตั้งค่า',
                    ];

                    $page = $_GET['page'] ?? 'dash';
                    $breadcrumb = ['Dashboard'];

                    if ($page !== 'dash' && isset($breadcrumbLabels[$page])) {
                        $breadcrumb[] = $breadcrumbLabels[$page];
                    }

                    echo '<nav aria-label="breadcrumb" class="ms-3">';
                    echo '<ol class="breadcrumb mb-0">';
                    foreach ($breadcrumb as $i => $label) {
                        if ($i === 0) {
                            echo '<li class="breadcrumb-item"><a href="A_main.php?page=dash">' . $label . '</a></li>';
                        } else {
                            echo '<li class="breadcrumb-item active" aria-current="page">' . $label . '</li>';
                        }
                    }
                    echo '</ol>';
                    echo '</nav>';

                    // สำหรับ Mobile - แสดงเฉพาะหน้าปัจจุบัน
                    echo '<div class="d-md-none current-page">';
                    if ($page === 'dash') {
                        echo 'Dashboard';
                    } else if (isset($breadcrumbLabels[$page])) {
                        echo $breadcrumbLabels[$page];
                    } else {
                        echo 'หน้าไม่พบ';
                    }
                    echo '</div>';
                    ?>
                </div>

                <span class="current-page" aria-hidden="true"></span>

                <div class="header-actions">
                    <div class="user-menu">
                        <div class="user-avatar">
                            <?php echo mb_substr($adminName, 0, 1, 'UTF-8'); ?>
                        </div>
                        <div class="user-info">
                            <div class="user-name"><?php echo $adminName; ?></div>
                            <div class="user-role">ผู้ดูแลระบบ</div>
                        </div>
                    </div>
                    <a href="../config/logout.php" class="logout-btn">
                        ออกจากระบบ
                    </a>
                </div>
            </header>

            <!-- Content -->
            <div class="content-wrapper">
                <?php
                switch ($_GET['page'] ?? 'dash') {
                    case 'dash':
                        include 'dashboard.php';
                        break;
                    case 'prog':
                        include 'program/program.php';
                        break;
                    case 'prog_a':
                        include 'program/add_program.php';
                        break;
                    case 'settings':
                        include 'pages/settings.php';
                        break;
                    case 'customer_list':
                        include 'customer_list.php';
                        break;
                    case 'customer_history':
                        include 'customer_history.php';
                        break;
                    case 'promo':
                        include 'promotion/promotion.php';
                        break;
                    case 'topup':
                        include 'topup.php';
                        break;
                    default:
                        include 'pages/404.php';
                        break;
                }
                ?>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Update current page text for mobile
            const activeCrumb = document.querySelector('.header-breadcrumb .breadcrumb-item.active');
            const currentPageEl = document.querySelector('.current-page');

            if (activeCrumb && currentPageEl) {
                const text = activeCrumb.textContent.trim();
                currentPageEl.textContent = text;
            }

            if (currentPageEl && currentPageEl.textContent.trim() === '') {
                currentPageEl.textContent = 'Dashboard';
            }

            // Load saved sidebar state
            const sidebarCollapsed = localStorage.getItem('adminSidebarCollapsed');
            const sidebar = document.getElementById('sidebar');
            if (sidebarCollapsed === 'false') {
                sidebar.classList.remove('collapsed');
            }
        });

        // Toggle Sidebar
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');

            // Save state to localStorage
            const isCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('adminSidebarCollapsed', isCollapsed);
        });

        // Mobile Menu
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('mobile-open');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const mobileBtn = document.getElementById('mobileMenuBtn');

            if (window.innerWidth <= 768 &&
                !sidebar.contains(event.target) &&
                !mobileBtn.contains(event.target) &&
                sidebar.classList.contains('mobile-open')) {
                sidebar.classList.remove('mobile-open');
            }
        });

        function showSwalMessage(title, icon, confirmButtonText, focusElementId = null) {
            Swal.fire({
                title: title,
                icon: icon,
                showCancelButton: false,
                confirmButtonText: confirmButtonText,
                confirmButtonColor: '#BA9A8B', // สีธีม V'NYCE
                background: '#F9F5F2', // สีพื้นหลังธีม V'NYCE
                color: '#6B4226', // สีข้อความธีม V'NYCE
                showClass: {
                    popup: 'animate__animated animate__fadeInDown' // animation
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp' // animation
                },
            }).then((result) => {
                if (result.isConfirmed && focusElementId) {
                    document.getElementById(focusElementId).focus();
                }
            });
        }
    </script>
</body>

</html>