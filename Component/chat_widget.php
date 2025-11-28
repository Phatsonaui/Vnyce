<?php

/**
 * Chat Widget Component
 * แชทบอทอัตโนมัติสำหรับตอบคำถามลูกค้า
 */
?>
<div class="chat-widget">
    <div class="chat-button" id="chatButton" aria-label="เปิดแชท" role="button" tabindex="0">
        <i class="fas fa-comments"></i>
        <span class="chat-badge">1</span>
    </div>

    <div class="chat-box" id="chatBox" role="dialog" aria-labelledby="chatTitle">
        <div class="chat-header">
            <div>
                <h3 id="chatTitle" style="font-size: 1rem; margin: 0;">V'nyce Clinic</h3>
                <p style="font-size: 0.75rem; margin: 0; opacity: 0.9;">ตอบกลับทันที</p>
            </div>
            <button class="close-chat" id="closeChat" aria-label="ปิดแชท">&times;</button>
        </div>

        <div class="chat-body" id="chatBody">
            <div class="chat-message bot-message">
                <div class="message-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="message-content">
                    <p>สวัสดีค่ะ! 👋</p>
                    <p>ยินดีต้อนรับสู่ V'nyce Clinic มีอะไรให้เราช่วยเหลือไหมคะ?</p>
                </div>
            </div>
        </div>

        <!-- Quick Reply Options -->
        <div class="quick-replies" id="quickReplies">
            <button class="quick-reply-btn" data-message="สอบถามราคา">💰 สอบถามราคา</button>
            <button class="quick-reply-btn" data-message="นัดหมาย">📅 นัดหมาย</button>
            <button class="quick-reply-btn" data-message="เวลาทำการ">🕐 เวลาทำการ</button>
            <button class="quick-reply-btn" data-message="ที่อยู่">📍 ที่อยู่</button>
        </div>

        <div class="chat-input">
            <input type="text"
                id="chatInput"
                placeholder="พิมพ์ข้อความ..."
                aria-label="พิมพ์ข้อความ">
            <button class="send-message" id="sendMessage" aria-label="ส่งข้อความ">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<style>
    /* Chat Widget Styles */
    .chat-widget {
        position: fixed;
        bottom: 30px;
        left: 30px;
        z-index: 1000;
    }

    .chat-button {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        box-shadow: var(--shadow-lg);
        cursor: pointer;
        transition: all 0.3s ease;
        animation: pulse 2s infinite;
        position: relative;
    }

    .chat-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #FF4757;
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: bold;
        border: 2px solid white;
    }

    .chat-button:hover {
        transform: scale(1.1);
    }

    .chat-box {
        position: absolute;
        bottom: 80px;
        left: 0;
        width: 350px;
        max-width: calc(100vw - 40px);
        background: white;
        border-radius: 15px;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        display: none;
        flex-direction: column;
        max-height: 500px;
    }

    .chat-box.active {
        display: flex;
    }

    .chat-header {
        background: var(--primary);
        color: white;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .close-chat {
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s ease;
    }

    .close-chat:hover {
        transform: rotate(90deg);
    }

    .chat-body {
        padding: 15px;
        flex: 1;
        overflow-y: auto;
        max-height: 300px;
        background: #f8f9fa;
    }

    .chat-message {
        margin-bottom: 15px;
        display: flex;
        gap: 10px;
        animation: slideIn 0.3s ease;
    }

    .message-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-dark);
        flex-shrink: 0;
    }

    .message-content {
        background: white;
        padding: 10px 15px;
        border-radius: 15px;
        max-width: 80%;
        box-shadow: var(--shadow-sm);
    }

    .message-content p {
        margin: 5px 0;
        font-size: 0.9rem;
        line-height: 1.4;
    }

    .bot-message {
        align-self: flex-start;
    }

    .user-message {
        align-self: flex-end;
        flex-direction: row-reverse;
    }

    .user-message .message-avatar {
        background: var(--primary);
        color: white;
    }

    .user-message .message-content {
        background: var(--primary);
        color: white;
    }

    /* Quick Replies */
    .quick-replies {
        padding: 10px 15px;
        background: white;
        border-top: 1px solid var(--border-color);
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .quick-reply-btn {
        background: var(--bg-accent);
        border: 1px solid var(--border-color);
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .quick-reply-btn:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
    }

    /* Chat Input */
    .chat-input {
        display: flex;
        padding: 15px;
        border-top: 1px solid var(--border-color);
        background: white;
    }

    .chat-input input {
        flex: 1;
        padding: 10px 15px;
        border: 1px solid var(--border-color);
        border-radius: 20px;
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
    }

    .chat-input input:focus {
        outline: none;
        border-color: var(--primary);
    }

    .send-message {
        background: var(--primary);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-left: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .send-message:hover {
        background: var(--primary-dark);
        transform: scale(1.1);
    }

    /* Typing Indicator */
    .typing-indicator {
        display: flex;
        gap: 4px;
        padding: 10px 15px;
    }

    .typing-indicator span {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--primary);
        animation: typing 1.4s infinite;
    }

    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes typing {

        0%,
        60%,
        100% {
            transform: translateY(0);
        }

        30% {
            transform: translateY(-10px);
        }
    }

    /* Scrollbar */
    .chat-body::-webkit-scrollbar {
        width: 6px;
    }

    .chat-body::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .chat-body::-webkit-scrollbar-thumb {
        background: var(--primary-light);
        border-radius: 3px;
    }

    .chat-body::-webkit-scrollbar-thumb:hover {
        background: var(--primary);
    }

    @media (max-width: 768px) {
        .chat-widget {
            bottom: 20px;
            left: 20px;
        }

        .chat-box {
            width: 320px;
        }

        .chat-button {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }

        .chat-badge {
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
        }
    }
</style>