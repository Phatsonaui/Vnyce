<!DOCTYPE html>
<html lang="th" dir="ltr">
</script>

<head>
    <?php
    /**
     * Main Webpage Structure for V'nyce Clinic
     * ไฟล์หลักที่รวมทุกส่วนเข้าด้วยกัน
     */

    // รวมไฟล์ SEO และ Meta Tags
    include 'includes/SEO.php';

    // รวมไฟล์ Styles
    include 'includes/Style_page.php';
    ?>
</head>

<body>
    <!-- Loading Screen -->
    <div class="loading-screen" id="loadingScreen">
        <div class="loader"></div>
    </div>

    <!-- Header -->
    <?php include 'section/header.php'; ?>

    <!-- hero -->
    <?php include 'section/hero.php'; ?>

    <!-- About Section -->
    <?php include 'section/about.php'; ?>

    <!-- Services Section -->
    <?php include 'section/services.php'; ?>

    <!-- Pricing Section -->
    <?php include 'section/pricing.php'; ?>

    <!-- Promotions Section -->
    <?php include 'section/promotions.php'; ?>

    <!-- Gallery Section -->
    <?php include 'section/gallery.php'; ?>

    <!-- Stats Section -->
    <?php include 'section/stats.php'; ?>

    <!-- Testimonials -->
    <?php include 'section/testimonials.php'; ?>

    <!-- FAQ Section -->
    <?php include 'section/faq.php'; ?>

    <!-- Map Section -->
    <?php include 'section/map.php'; ?>

    <!-- Appointment Modal -->
    <?php include 'Component/Appointment_modal.php'; ?>

    <!-- Footer -->
    <?php include 'section/footer.php'; ?>

    <!-- Floating Buttons -->
    <?php include 'Component/floating_buttons.php'; ?>

    <!-- Chat Widget -->
    <?php include 'Component/chat_widget.php'; ?>
    <!-- <div class="chat-widget">
        <div class="chat-button" id="chatButton">
            <i class="fas fa-comments"></i>
        </div>
        <div class="chat-box" id="chatBox">
            <div class="chat-header">
                <span>V'nyce Clinic</span>
                <button class="close-chat" id="closeChat">&times;</button>
            </div>
            <div class="chat-body" id="chatBody">
                <div class="chat-message bot-message">
                    สวัสดีค่ะ! ยินดีต้อนรับสู่ V'nyce Clinic มีอะไรให้เราช่วยเหลือไหมคะ?
                </div>
            </div>
            <div class="chat-input">
                <input type="text" id="chatInput" placeholder="พิมพ์ข้อความ...">
                <button class="send-message" id="sendMessage">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div> -->

    <script src="assets/js/main.js"></script>
</body>

</html>