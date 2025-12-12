<?php

/**
 * Style Configuration for V'nyce Clinic
 * ไฟล์นี้จัดการ CSS ทั้งหมดของเว็บไซต์
 */
?>
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

    /* Reset และ Base Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--bg-body);
        color: var(--text-dark);
        line-height: 1.6;
        overflow-x: hidden;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        line-height: 1.3;
    }

    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Header Styles */
    header {
        background: var(--bg-card);
        box-shadow: var(--shadow-md);
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 10px;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
    }

    .logo-icon {
        background: var(--primary);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .logo-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .logo-text {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .logo-text span {
        color: var(--primary);
    }

    nav ul {
        display: flex;
        list-style: none;
        gap: 30px;
    }

    nav a {
        text-decoration: none;
        color: var(--text-dark);
        font-weight: 500;
        font-size: 16px;
        position: relative;
        transition: color 0.3s ease;
    }

    nav a:hover {
        color: var(--primary);
    }

    nav a::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary);
        transition: width 0.3s ease;
    }

    nav a:hover::after {
        width: 100%;
    }

    .cta-button {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 30px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm);
    }

    .cta-button:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    /* Mobile Menu */
    .mobile-menu-btn {
        display: none;
        background: none;
        border: none;
        font-size: 24px;
        color: var(--text-dark);
        cursor: pointer;
    }

    .mobile-menu {
        position: fixed;
        top: var(--header-height);
        left: 0;
        width: 100%;
        background: var(--bg-card);
        box-shadow: var(--shadow-lg);
        transform: translateY(-100%);
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 999;
        display: none;
    }

    .mobile-menu.active {
        transform: translateY(0);
        opacity: 1;
        display: block;
    }

    .mobile-menu ul {
        list-style: none;
        padding: 20px;
    }

    .mobile-menu li {
        margin-bottom: 15px;
    }

    .mobile-menu a {
        display: block;
        padding: 10px 0;
        text-decoration: none;
        color: var(--text-dark);
        font-weight: 500;
        border-bottom: 1px solid var(--border-color);
    }

    /* Section Styles */
    .section {
        padding: 100px 0;
    }

    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-header h2 {
        font-size: 2.5rem;
        margin-bottom: 15px;
        color: var(--text-dark);
    }

    .section-header p {
        color: var(--text-muted);
        max-width: 600px;
        margin: 0 auto;
    }

    /* Card Styles */
    .card {
        background: var(--bg-card);
        border-radius: 20px;
        padding: 30px;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-md);
    }

    /* Grid Layouts */
    .grid {
        display: grid;
        gap: 30px;
    }

    .grid-3 {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    }

    .grid-4 {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }

    /* Footer */
    footer {
        background: var(--text-dark);
        color: white;
        padding: 60px 0 30px;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
    }

    .footer-column h3 {
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 10px;
    }

    .footer-column h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 2px;
        background: var(--primary);
    }

    .footer-links {
        list-style: none;
    }

    .footer-links li {
        margin-bottom: 12px;
    }

    .footer-links a {
        color: #ccc;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-links a:hover {
        color: var(--primary-light);
    }

    .social-links {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .social-links a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        transition: all 0.3s ease;
    }

    .social-links a:hover {
        background: var(--primary);
        transform: translateY(-3px);
    }

    .copyright {
        text-align: center;
        padding-top: 30px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        color: #aaa;
        font-size: 0.9rem;
    }

    /* Floating Buttons */
    .floating-buttons {
        position: fixed;
        bottom: 30px;
        right: 30px;
        display: flex;
        flex-direction: column;
        gap: 15px;
        z-index: 1000;
    }

    .floating-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        box-shadow: var(--shadow-lg);
        cursor: pointer;
        transition: all 0.3s ease;
        animation: pulse 2s infinite;
    }

    .scroll-top {
        background: var(--primary);
        display: none;
    }

    .floating-btn:hover {
        transform: scale(1.1);
    }

    /* Loading Screen */
    .loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--bg-body);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        transition: opacity 0.5s ease;
    }

    .loading-screen.hidden {
        opacity: 0;
        pointer-events: none;
    }

    .loader {
        width: 60px;
        height: 60px;
        border: 5px solid var(--primary-light);
        border-top: 5px solid var(--primary);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    /* ==================== ENHANCED ANIMATIONS & TRANSITIONS ==================== */

    /* 🎨 1. FADE IN ANIMATIONS - ใช้กับ sections ทั่วไป */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(60px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-60px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-60px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(60px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* 🎨 2. ROTATION ANIMATIONS */
    @keyframes rotateIn {
        from {
            opacity: 0;
            transform: rotate(-10deg) scale(0.9);
        }

        to {
            opacity: 1;
            transform: rotate(0) scale(1);
        }
    }

    /* 🎨 3. BOUNCE ANIMATIONS */
    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }

        50% {
            opacity: 1;
            transform: scale(1.05);
        }

        70% {
            transform: scale(0.9);
        }

        100% {
            transform: scale(1);
        }
    }

    /* 🎨 4. SLIDE ANIMATIONS */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(100%);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* 🎨 5. FLOATING ANIMATION - สำหรับ decorative elements */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    /* 🎨 6. PULSE ANIMATION - สำหรับ call-to-action */
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(186, 154, 139, 0.7);
        }

        70% {
            box-shadow: 0 0 0 15px rgba(186, 154, 139, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(186, 154, 139, 0);
        }
    }

    /* 🎨 7. SHIMMER EFFECT - สำหรับการโหลด */
    @keyframes shimmer {
        0% {
            background-position: -1000px 0;
        }

        100% {
            background-position: 1000px 0;
        }
    }

    /* ==================== APPLY ANIMATIONS TO SECTIONS ==================== */

    /* 📍 HERO SECTION */
    .hero {
        animation: fadeInDown 1s ease-out;
    }

    .hero-text h1 {
        animation: fadeInLeft 1s ease-out 0.2s both;
    }

    .hero-text p {
        animation: fadeInLeft 1s ease-out 0.4s both;
    }

    .hero-text .cta-button {
        animation: bounceIn 0.8s ease-out 0.6s both;
    }

    .hero-image {
        animation: fadeInRight 1s ease-out 0.3s both, float 6s ease-in-out infinite 1.3s;
    }

    /* 📍 ABOUT SECTION */
    .about .section-header {
        animation: fadeInDown 0.8s ease-out;
    }

    .about-text {
        animation: fadeInLeft 0.8s ease-out 0.2s both;
    }

    .about-image {
        animation: fadeInRight 0.8s ease-out 0.4s both;
    }

    .about-image img {
        transition: transform 0.6s ease, box-shadow 0.6s ease;
    }

    .about-image img:hover {
        transform: scale(1.05) rotate(2deg);
        box-shadow: 0 20px 40px rgba(186, 154, 139, 0.3);
    }

    /* 📍 SERVICES SECTION */
    .services .section-header {
        animation: fadeInDown 0.8s ease-out;
    }

    .service-card {
        animation: scaleIn 0.6s ease-out both;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .service-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .service-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .service-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .service-card:nth-child(4) {
        animation-delay: 0.4s;
    }

    .service-card:hover {
        transform: translateY(-15px) scale(1.03);
        box-shadow: 0 15px 35px rgba(186, 154, 139, 0.25);
    }

    .service-icon {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .service-card:hover .service-icon {
        transform: scale(1.2) rotate(10deg);
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
    }

    .service-card h3 {
        transition: color 0.3s ease;
    }

    .service-card:hover h3 {
        color: var(--primary);
    }

    /* 📍 PRICING SECTION */
    .pricing .section-header {
        animation: fadeInDown 0.8s ease-out;
    }

    .pricing-card {
        animation: fadeInUp 0.6s ease-out both;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .pricing-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .pricing-card:hover::before {
        left: 100%;
    }

    .pricing-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .pricing-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .pricing-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .pricing-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 40px rgba(186, 154, 139, 0.2);
    }

    .pricing-card.popular {
        animation: pulse 2s infinite;
    }

    .price {
        transition: transform 0.3s ease;
    }

    .pricing-card:hover .price {
        transform: scale(1.1);
    }

    /* 📍 PROMOTIONS SECTION */
    .promotions .section-header {
        animation: fadeInDown 0.8s ease-out;
    }

    .promo-card {
        animation: rotateIn 0.6s ease-out both;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .promo-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .promo-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .promo-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .promo-card:hover {
        transform: translateY(-15px) rotate(2deg);
        box-shadow: 0 20px 45px rgba(186, 154, 139, 0.3);
    }

    .promo-image img {
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .promo-card:hover .promo-image img {
        transform: scale(1.15) rotate(-2deg);
    }

    .hot-badge {
        animation: pulse 2s infinite;
    }

    /* 📍 GALLERY SECTION */
    .gallery .section-header {
        animation: fadeInDown 0.8s ease-out;
    }

    .gallery-item {
        animation: scaleIn 0.6s ease-out both;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .gallery-item:nth-child(1) {
        animation-delay: 0.1s;
    }

    .gallery-item:nth-child(2) {
        animation-delay: 0.2s;
    }

    .gallery-item:nth-child(3) {
        animation-delay: 0.3s;
    }

    .gallery-item:nth-child(4) {
        animation-delay: 0.4s;
    }

    .gallery-item:hover {
        transform: scale(1.05) rotate(1deg);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        z-index: 10;
    }

    .gallery-item img {
        transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .gallery-item:hover img {
        transform: scale(1.2) rotate(-2deg);
    }

    /* 📍 STATS SECTION */
    .stats {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        position: relative;
        overflow: hidden;
    }

    .stats::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: float 15s ease-in-out infinite;
    }

    .stat-item {
        animation: bounceIn 0.8s ease-out both;
        transition: transform 0.3s ease;
    }

    .stat-item:nth-child(1) {
        animation-delay: 0.1s;
    }

    .stat-item:nth-child(2) {
        animation-delay: 0.2s;
    }

    .stat-item:nth-child(3) {
        animation-delay: 0.3s;
    }

    .stat-item:nth-child(4) {
        animation-delay: 0.4s;
    }

    .stat-item:hover {
        transform: translateY(-10px) scale(1.1);
    }

    .counter {
        animation: none;
        transition: transform 0.3s ease;
    }

    .stat-item:hover .counter {
        transform: scale(1.2);
    }

    /* 📍 TESTIMONIALS SECTION */
    .testimonials .section-header {
        animation: fadeInDown 0.8s ease-out;
    }

    .testimonial-card {
        animation: fadeInUp 0.6s ease-out both;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .testimonial-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .testimonial-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .testimonial-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .testimonial-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 15px 35px rgba(186, 154, 139, 0.2);
    }

    .testimonial-card::before {
        transition: all 0.4s ease;
    }

    .testimonial-card:hover::before {
        transform: scale(1.5);
        opacity: 0.5;
    }

    .author-avatar {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .testimonial-card:hover .author-avatar {
        transform: scale(1.2) rotate(360deg);
    }

    /* 📍 FAQ SECTION */
    .faq .section-header {
        animation: fadeInDown 0.8s ease-out;
    }

    .faq-item {
        animation: fadeInLeft 0.6s ease-out both;
        transition: all 0.3s ease;
    }

    .faq-item:nth-child(1) {
        animation-delay: 0.1s;
    }

    .faq-item:nth-child(2) {
        animation-delay: 0.2s;
    }

    .faq-item:nth-child(3) {
        animation-delay: 0.3s;
    }

    .faq-item:nth-child(4) {
        animation-delay: 0.4s;
    }

    .faq-item:nth-child(5) {
        animation-delay: 0.5s;
    }

    .faq-item:nth-child(6) {
        animation-delay: 0.6s;
    }

    .faq-item:hover {
        transform: translateX(10px);
    }

    .faq-question {
        transition: all 0.3s ease;
    }

    .faq-item:hover .faq-question {
        background: rgba(186, 154, 139, 0.1);
    }

    .faq-question i {
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .faq-item.active .faq-question i {
        transform: rotate(180deg);
        color: var(--primary);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1),
            padding 0.5s cubic-bezier(0.4, 0, 0.2, 1),
            opacity 0.3s ease;
        opacity: 0;
    }

    .faq-item.active .faq-answer {
        max-height: 500px;
        padding: 20px;
        opacity: 1;
    }

    /* 📍 MAP SECTION */
    .map-section .section-header {
        animation: fadeInDown 0.8s ease-out;
    }

    #map {
        animation: scaleIn 0.8s ease-out 0.2s both;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    #map:hover {
        transform: scale(1.02);
        box-shadow: 0 15px 40px rgba(186, 154, 139, 0.25);
    }

    /* 📍 FOOTER */
    footer {
        animation: fadeInUp 0.8s ease-out;
    }

    .footer-column {
        animation: fadeInUp 0.6s ease-out both;
    }

    .footer-column:nth-child(1) {
        animation-delay: 0.1s;
    }

    .footer-column:nth-child(2) {
        animation-delay: 0.2s;
    }

    .footer-column:nth-child(3) {
        animation-delay: 0.3s;
    }

    .footer-column:nth-child(4) {
        animation-delay: 0.4s;
    }

    .social-links a {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .social-links a:hover {
        background: var(--primary);
        transform: translateY(-5px) rotate(360deg) scale(1.2);
        box-shadow: 0 10px 20px rgba(186, 154, 139, 0.4);
    }

    /* ==================== SMOOTH SCROLL BEHAVIOR ==================== */
    html {
        scroll-behavior: smooth;
    }

    section {
        scroll-margin-top: 80px;
    }

    /* ==================== INTERSECTION OBSERVER TRIGGER ==================== */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(50px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .animate-on-scroll.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* ==================== BUTTON ENHANCEMENTS ==================== */
    .cta-button {
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .cta-button::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }

    .cta-button:hover::before {
        width: 300px;
        height: 300px;
    }

    .cta-button:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 10px 30px rgba(186, 154, 139, 0.4);
    }

    .cta-button:active {
        transform: translateY(-1px) scale(1.02);
    }

    /* ==================== LOADING ANIMATIONS ==================== */
    .section {
        position: relative;
    }

    .section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--primary), transparent);
        transform: translateX(-100%);
        animation: slideProgress 2s ease-in-out infinite;
    }

    @keyframes slideProgress {
        0% {
            transform: translateX(-100%);
        }

        50% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(100%);
        }
    }

    /* ==================== RESPONSIVE ADJUSTMENTS ==================== */
    @media (max-width: 768px) {
        .hero-image {
            animation: fadeInUp 1s ease-out 0.3s both, float 6s ease-in-out infinite 1.3s;
        }

        .about-image {
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        .service-card,
        .pricing-card,
        .promo-card,
        .gallery-item,
        .testimonial-card,
        .faq-item {
            animation-delay: 0s !important;
        }
    }

    /* ==================== PERFORMANCE OPTIMIZATION ==================== */
    @media (prefers-reduced-motion: reduce) {

        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-15px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(186, 154, 139, 0.7);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(186, 154, 139, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(186, 154, 139, 0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        nav {
            display: none;
        }

        .header-container>.cta-button {
            display: none;
        }

        .mobile-menu-btn {
            display: block;
        }

        .section {
            padding: 60px 0;
        }

        .section-header h2 {
            font-size: 2rem;
        }

        .floating-buttons {
            bottom: 20px;
            right: 20px;
        }

        .floating-btn {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }
    }

    @media (max-width: 480px) {
        .container {
            padding: 0 15px;
        }

        .logo-text {
            font-size: 20px;
        }

        .section-header h2 {
            font-size: 1.75rem;
        }
    }
</style>