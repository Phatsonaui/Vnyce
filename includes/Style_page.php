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

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        /* height: 100%; */
        background: rgba(0, 0, 0, 0.5);
        z-index: 1100;
        align-items: center;
        justify-content: center;
        scrollbar-width: auto;
    }

    .modal.active {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 20px;
        padding: 40px;
        width: 90%;
        max-width: 500px;
        position: relative;
    }

    .close-modal {
        position: absolute;
        top: 15px;
        right: 15px;
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: var(--text-muted);
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
    }

    .form-group textarea {
        min-height: 100px;
        resize: vertical;
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