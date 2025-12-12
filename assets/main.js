/**
 * Main JavaScript for V'nyce Clinic Website
 * จัดการ Interactions, Animations, และ Events ทั้งหมด
 */

// ==================== Loading Screen ====================
window.addEventListener("load", function () {
  const loadingScreen = document.getElementById("loadingScreen");
  setTimeout(() => {
    loadingScreen.classList.add("hidden");
  }, 1000);
});

// ==================== Mobile Menu ====================
const mobileMenuBtn = document.getElementById("mobileMenuBtn");
const mobileMenu = document.getElementById("mobileMenu");

if (mobileMenuBtn && mobileMenu) {
  mobileMenuBtn.addEventListener("click", function () {
    const isActive = mobileMenu.classList.toggle("active");
    const icon = mobileMenuBtn.querySelector("i");

    // Update icon
    if (isActive) {
      icon.classList.remove("fa-bars");
      icon.classList.add("fa-times");
      mobileMenuBtn.setAttribute("aria-expanded", "true");
    } else {
      icon.classList.remove("fa-times");
      icon.classList.add("fa-bars");
      mobileMenuBtn.setAttribute("aria-expanded", "false");
    }
  });

  // Close mobile menu when clicking on a link
  const mobileMenuLinks = mobileMenu.querySelectorAll("a");
  mobileMenuLinks.forEach((link) => {
    link.addEventListener("click", () => {
      if (link.id !== "mobileAppointmentBtn") {
        mobileMenu.classList.remove("active");
        mobileMenuBtn.querySelector("i").classList.remove("fa-times");
        mobileMenuBtn.querySelector("i").classList.add("fa-bars");
        mobileMenuBtn.setAttribute("aria-expanded", "false");
      }
    });
  });
}

// ==================== Appointment Modal ====================
const appointmentBtn = document.getElementById("appointmentBtn");
const heroAppointmentBtn = document.getElementById("heroAppointmentBtn");
const mobileAppointmentBtn = document.getElementById("mobileAppointmentBtn");
const appointmentModal = document.getElementById("appointmentModal");
const closeModal = document.getElementById("closeModal");

function openAppointmentModal() {
  if (appointmentModal) {
    appointmentModal.classList.add("active");
    document.body.style.overflow = "hidden";
  }
}

function closeAppointmentModal() {
  if (appointmentModal) {
    appointmentModal.classList.remove("active");
    document.body.style.overflow = "auto";
  }
}

// Open modal events
if (appointmentBtn)
  appointmentBtn.addEventListener("click", openAppointmentModal);
if (heroAppointmentBtn)
  heroAppointmentBtn.addEventListener("click", openAppointmentModal);
if (mobileAppointmentBtn) {
  mobileAppointmentBtn.addEventListener("click", function (e) {
    e.preventDefault();
    openAppointmentModal();
    if (mobileMenu) {
      mobileMenu.classList.remove("active");
      const icon = mobileMenuBtn?.querySelector("i");
      if (icon) {
        icon.classList.remove("fa-times");
        icon.classList.add("fa-bars");
      }
    }
  });
}

// Close modal events
if (closeModal) closeModal.addEventListener("click", closeAppointmentModal);

// Close modal when clicking outside
if (appointmentModal) {
  appointmentModal.addEventListener("click", function (e) {
    if (e.target === appointmentModal) {
      closeAppointmentModal();
    }
  });

  // Close with Escape key
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && appointmentModal.classList.contains("active")) {
      closeAppointmentModal();
    }
  });
}

// ==================== Appointment Form Submission ====================
const appointmentForm = document.getElementById("appointmentForm");
if (appointmentForm) {
  appointmentForm.addEventListener("submit", function (e) {
    e.preventDefault();

    // Get form data
    const formData = new FormData(appointmentForm);
    const data = Object.fromEntries(formData);

    // Show loading
    const submitBtn = appointmentForm.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> กำลังส่ง...';
    submitBtn.disabled = true;

    // Simulate API call (replace with actual API endpoint)
    setTimeout(() => {
      // Success
      alert(
        "ขอบคุณสำหรับการนัดหมาย!\n\nเราจะติดต่อกลับไปภายใน 24 ชั่วโมง\nหรือโทรเลย: 093-895-5999"
      );
      closeAppointmentModal();
      appointmentForm.reset();

      // Reset button
      submitBtn.innerHTML = originalText;
      submitBtn.disabled = false;

      // Send to analytics (if you use GA4)
      if (typeof gtag !== "undefined") {
        gtag("event", "appointment_submit", {
          service: data.service,
          date: data.date,
        });
      }
    }, 1500);
  });
}

// ==================== Service Detail Buttons ====================
const serviceDetailBtns = document.querySelectorAll(".service-detail-btn");
serviceDetailBtns.forEach((btn) => {
  btn.addEventListener("click", function () {
    const service = this.getAttribute("data-service");
    // Set service in appointment form
    const serviceSelect = document.getElementById("service");
    if (serviceSelect) {
      serviceSelect.value = service;
    }
    openAppointmentModal();
  });
});

// ==================== Pricing and Promotion Buttons ====================
const pricingButtons = document.querySelectorAll(
  ".pricing-card .cta-button, .promo-card .cta-button"
);
pricingButtons.forEach((button) => {
  button.addEventListener("click", function () {
    const service = this.getAttribute("data-service");
    const serviceSelect = document.getElementById("service");
    if (serviceSelect && service) {
      // Try to match service name
      const options = serviceSelect.options;
      for (let i = 0; i < options.length; i++) {
        if (options[i].text.includes(service)) {
          serviceSelect.selectedIndex = i;
          break;
        }
      }
    }
    openAppointmentModal();
  });
});

// ==================== FAQ Accordion ====================
const faqItems = document.querySelectorAll(".faq-item");
faqItems.forEach((item) => {
  const question = item.querySelector(".faq-question");
  if (question) {
    question.addEventListener("click", () => {
      // Close all other items
      faqItems.forEach((otherItem) => {
        if (otherItem !== item && otherItem.classList.contains("active")) {
          otherItem.classList.remove("active");
        }
      });
      // Toggle current item
      item.classList.toggle("active");
    });
  }
});

// ==================== Stats Counter ====================
function animateCounter(element, target, duration = 2000) {
  let current = 0;
  const increment = target / (duration / 16);
  const timer = setInterval(() => {
    current += increment;
    if (current >= target) {
      element.textContent = target;
      clearInterval(timer);
    } else {
      element.textContent = Math.ceil(current);
    }
  }, 16);
}

const statsSection = document.getElementById("stats");
if (statsSection) {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const counters = entry.target.querySelectorAll(".counter");
          counters.forEach((counter) => {
            const target = +counter.getAttribute("data-target");
            animateCounter(counter, target);
          });
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.5 }
  );

  observer.observe(statsSection);
}

// ==================== Scroll to Top Button ====================
const scrollTopBtn = document.getElementById("scrollTop");

window.addEventListener("scroll", function () {
  if (scrollTopBtn) {
    if (window.pageYOffset > 300) {
      scrollTopBtn.style.display = "flex";
    } else {
      scrollTopBtn.style.display = "none";
    }
  }
});

if (scrollTopBtn) {
  scrollTopBtn.addEventListener("click", function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });
}

// ==================== Chat Widget ====================
const chatButton = document.getElementById("chatButton");
const chatBox = document.getElementById("chatBox");
const closeChat = document.getElementById("closeChat");
const chatBody = document.getElementById("chatBody");
const chatInput = document.getElementById("chatInput");
const sendMessage = document.getElementById("sendMessage");
const quickReplies = document.querySelectorAll(".quick-reply-btn");

if (chatButton && chatBox) {
  // Open chat
  chatButton.addEventListener("click", function () {
    chatBox.classList.toggle("active");
    if (chatBox.classList.contains("active")) {
      chatInput?.focus();
      // Hide badge
      const badge = chatButton.querySelector(".chat-badge");
      if (badge) badge.style.display = "none";
    }
  });

  // Close chat
  if (closeChat) {
    closeChat.addEventListener("click", function () {
      chatBox.classList.remove("active");
    });
  }

  // Add message to chat
  function addMessage(message, isUser = false) {
    if (!chatBody) return;

    const messageDiv = document.createElement("div");
    messageDiv.classList.add("chat-message");
    messageDiv.classList.add(isUser ? "user-message" : "bot-message");

    messageDiv.innerHTML = `
            <div class="message-avatar">
                <i class="fas fa-${isUser ? "user" : "robot"}"></i>
            </div>
            <div class="message-content">
                <p>${message}</p>
            </div>
        `;

    chatBody.appendChild(messageDiv);
    chatBody.scrollTop = chatBody.scrollHeight;
  }

  // Show typing indicator
  function showTyping() {
    if (!chatBody) return;

    const typingDiv = document.createElement("div");
    typingDiv.classList.add("typing-indicator");
    typingDiv.innerHTML = "<span></span><span></span><span></span>";
    chatBody.appendChild(typingDiv);
    chatBody.scrollTop = chatBody.scrollHeight;
    return typingDiv;
  }

  // Handle user message
  function handleUserMessage(message) {
    if (!message.trim()) return;

    addMessage(message, true);
    if (chatInput) chatInput.value = "";

    // Show typing
    const typing = showTyping();

    // Simulate bot response
    setTimeout(() => {
      if (typing) typing.remove();

      let response = "";
      const msg = message.toLowerCase();

      if (msg.includes("ราคา") || msg.includes("ค่าใช้จ่าย")) {
        response =
          'เรามีแพ็คเกจราคาที่หลากหลายเริ่มต้นที่ 1,500 บาทค่ะ สามารถดูรายละเอียดเพิ่มเติมได้ที่หน้า "แพ็คเกจราคา" หรือโทรมาสอบถามได้ที่ 093-895-5999 ค่ะ';
      } else if (msg.includes("นัดหมาย") || msg.includes("จอง")) {
        response =
          "สามารถนัดหมายได้ผ่านฟอร์มนัดหมายบนเว็บไซต์ หรือโทรมาที่ 093-895-5999 ได้ทุกวันค่ะ ต้องการให้เราเปิดฟอร์มนัดหมายให้ไหมคะ?";
      } else if (
        msg.includes("เวลา") ||
        msg.includes("เปิด") ||
        msg.includes("กี่โมง")
      ) {
        response =
          "เราเปิดให้บริการ:\n📅 จันทร์-ศุกร์: 16:30-21:00 น.\n📅 เสาร์-อาทิตย์: 10:00-21:00 น.";
      } else if (
        msg.includes("ที่อยู่") ||
        msg.includes("ที่ตั้ง") ||
        msg.includes("อยู่")
      ) {
        response =
          "ที่อยู่คลินิก:\n📍 62/3 ถนนศรีโสธรตัดใหม่ 18\nตำบลหน้าเมือง อำเภอเมือง\nฉะเชิงเทรา 24000\n\nสามารถดูแผนที่ได้ที่ด้านล่างของเว็บไซต์ค่ะ";
      } else if (msg.includes("บริการ") || msg.includes("ทำอะไร")) {
        response =
          "เรามีบริการ:\n✨ รักษาสิวและรอยสิว\n✨ ฉีดผิวขาว\n✨ เลเซอร์กำจัดขน\n✨ ดูแลผิวพรรณ\n✨ Botox & Filler\n\nสนใจบริการไหนคะ?";
      } else {
        response =
          "ขอบคุณสำหรับข้อความค่ะ 😊\n\nหากมีคำถามเพิ่มเติมสามารถ:\n📞 โทร: 093-895-5999\n💬 LINE: @vnyceclinic\n📧 Email: info@vnyce.com";
      }

      addMessage(response);
    }, 1000);
  }

  // Quick replies
  quickReplies.forEach((btn) => {
    btn.addEventListener("click", function () {
      const message = this.getAttribute("data-message");
      handleUserMessage(message);
    });
  });

  // Send message button
  if (sendMessage) {
    sendMessage.addEventListener("click", function () {
      if (chatInput) {
        handleUserMessage(chatInput.value);
      }
    });
  }

  // Send message with Enter key
  if (chatInput) {
    chatInput.addEventListener("keypress", function (e) {
      if (e.key === "Enter") {
        handleUserMessage(this.value);
      }
    });
  }
}

// ==================== Smooth Scrolling ====================
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    const href = this.getAttribute("href");
    if (href === "#" || !href) return;

    e.preventDefault();
    const target = document.querySelector(href);
    if (target) {
      const headerHeight = 80;
      const targetPosition = target.offsetTop - headerHeight;

      window.scrollTo({
        top: targetPosition,
        behavior: "smooth",
      });

      // Close mobile menu if open
      if (mobileMenu && mobileMenu.classList.contains("active")) {
        mobileMenu.classList.remove("active");
        const icon = mobileMenuBtn?.querySelector("i");
        if (icon) {
          icon.classList.remove("fa-times");
          icon.classList.add("fa-bars");
        }
      }
    }
  });
});

// ==================== Header Scroll Effect ====================
let lastScroll = 0;
const header = document.querySelector("header");

window.addEventListener("scroll", function () {
  const currentScroll = window.pageYOffset;

  if (header) {
    if (currentScroll > 100) {
      header.style.boxShadow = "var(--shadow-lg)";
      header.style.background = "rgba(255, 255, 255, 0.95)";
    } else {
      header.style.boxShadow = "var(--shadow-md)";
      header.style.background = "var(--bg-card)";
    }

    // Hide header on scroll down (optional)
    /*
        if (currentScroll > lastScroll && currentScroll > 500) {
            header.style.transform = 'translateY(-100%)';
        } else {
            header.style.transform = 'translateY(0)';
        }
        */
  }

  lastScroll = currentScroll;
});

// ==================== Intersection Observer for Animations ====================
const animationObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = "running";
        animationObserver.unobserve(entry.target);
      }
    });
  },
  {
    root: null,
    rootMargin: "0px",
    threshold: 0.1,
  }
);

// Observe all service cards
document.querySelectorAll(".service-card").forEach((card) => {
  card.style.animationPlayState = "paused";
  animationObserver.observe(card);
});

// ==================== Form Validation ====================
function validatePhone(phone) {
  const phoneRegex = /^[0-9]{10}$/;
  return phoneRegex.test(phone.replace(/-/g, ""));
}

function validateEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

// Add real-time validation
const phoneInput = document.getElementById("phone");
if (phoneInput) {
  phoneInput.addEventListener("input", function () {
    const value = this.value.replace(/\D/g, "");
    if (value.length === 10) {
      this.setCustomValidity("");
    } else if (value.length > 0) {
      this.setCustomValidity("กรุณากรอกเบอร์โทรศัพท์ 10 หลัก");
    }
  });
}

// ==================== Console Welcome Message ====================
console.log(
  "%c🌟 V'nyce Clinic Website",
  "color: #BA9A8B; font-size: 24px; font-weight: bold;"
);
console.log(
  "%cสนใจร่วมงานกับเรา? ส่ง Resume มาที่ info@vnyce.com",
  "color: #8B7968; font-size: 14px;"
);

// ==================== Google Analytics (if needed) ====================
// Uncomment and add your GA4 measurement ID
/*
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-XXXXXXXXXX');
*/
