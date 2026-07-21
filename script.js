// ===== Hero slideshow =====
(function heroSlideshow() {
  const slides = document.querySelectorAll('.hero-slide');
  const dots = document.querySelectorAll('.hero-dot');
  if (!slides.length) return;
  let current = 0;
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function goTo(i) {
    slides[current].classList.remove('active');
    if (dots[current]) dots[current].classList.remove('active');
    current = (i + slides.length) % slides.length;
    slides[current].classList.add('active');
    if (dots[current]) dots[current].classList.add('active');
  }

  dots.forEach((dot, i) => dot.addEventListener('click', () => goTo(i)));

  if (!prefersReducedMotion) {
    setInterval(() => goTo(current + 1), 5200);
  }
})();

// ===== Sticky header shadow =====
(function stickyHeader() {
  const header = document.getElementById('siteHeader');
  if (!header) return;
  window.addEventListener('scroll', () => {
    header.classList.toggle('scrolled', window.scrollY > 20);
  }, { passive: true });
})();

// ===== Mobile nav =====
(function mobileNav() {
  const hamburger = document.getElementById('hamburger');
  const nav = document.getElementById('mainNav');
  const backdrop = document.getElementById('navBackdrop');
  const navClose = document.getElementById('navClose');
  if (!hamburger || !nav || !backdrop || !navClose) return;

  function openNav() {
    nav.classList.add('open');
    hamburger.classList.add('open');
    hamburger.setAttribute('aria-expanded', 'true');
    backdrop.classList.add('show');
    document.body.style.overflow = 'hidden';
  }

  function closeNav() {
    nav.classList.remove('open');
    hamburger.classList.remove('open');
    hamburger.setAttribute('aria-expanded', 'false');
    backdrop.classList.remove('show');
    document.body.style.overflow = '';
  }

  hamburger.addEventListener('click', () => {
    if (nav.classList.contains('open')) closeNav();
    else openNav();
  });
  navClose.addEventListener('click', closeNav);
  backdrop.addEventListener('click', closeNav);
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && nav.classList.contains('open')) closeNav();
  });
  nav.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', closeNav);
  });
})();

// ===== Active nav link for current page =====
(function activeNavForPage() {
  const navLinks = document.querySelectorAll('.main-nav a[href]');
  let current = location.pathname.split('/').pop();
  if (current === '') current = 'index.html';

  navLinks.forEach((link) => {
    const href = link.getAttribute('href');
    if (!href || href.startsWith('#')) return;
    const linkPage = href.split('/').pop();
    link.classList.toggle('active', linkPage === current);
  });
})();

// ===== Product category enquiry pre-fill =====
(function productEnquiry() {
  document.querySelectorAll('.product-card[data-enquiry]').forEach((card) => {
    card.addEventListener('click', () => {
      sessionStorage.setItem('enquiryTopic', 'Safety products');
      sessionStorage.setItem('enquiryMessage', `I'm interested in ${card.dataset.enquiry}. Please share pricing and availability.`);
    });
  });
})();

// ===== Course enquiry pre-fill =====
(function courseEnquiry() {
  document.querySelectorAll('.course-card[data-enquiry]').forEach((card) => {
    card.addEventListener('click', () => {
      sessionStorage.setItem('enquiryTopic', card.dataset.enquiry);
      sessionStorage.setItem('enquiryMessage', `I'm interested in enrolling in ${card.dataset.enquiry}. Please share the next batch dates.`);
    });
  });
})();

// ===== Corporate training enquiry pre-fill =====
(function corporateEnquiry() {
  document.querySelectorAll('.corporate-tag[data-enquiry]').forEach((tag) => {
    tag.addEventListener('click', () => {
      sessionStorage.setItem('enquiryTopic', 'Corporate training');
      sessionStorage.setItem('enquiryMessage', `I'd like to schedule ${tag.dataset.enquiry} for our team. Please share availability and pricing.`);
    });
  });
})();

// ===== Apply any pre-filled enquiry (set on a previous page) to this page's form =====
(function applyStoredEnquiry() {
  const topic = document.getElementById('fTopic');
  const msg = document.getElementById('fMsg');
  if (!topic && !msg) return;
  const storedTopic = sessionStorage.getItem('enquiryTopic');
  const storedMessage = sessionStorage.getItem('enquiryMessage');
  if (storedTopic && topic) {
    const hasOption = Array.from(topic.options).some((o) => o.value === storedTopic);
    if (hasOption) topic.value = storedTopic;
  }
  if (storedMessage && msg) msg.value = storedMessage;
  sessionStorage.removeItem('enquiryTopic');
  sessionStorage.removeItem('enquiryMessage');
})();

// ===== Gallery lightbox =====
(function galleryLightbox() {
  const items = Array.from(document.querySelectorAll('.gallery-item'));
  const lightbox = document.getElementById('lightbox');
  if (!items.length || !lightbox) return;

  const lightboxImage = document.getElementById('lightboxImage');
  const closeBtn = document.getElementById('lightboxClose');
  const prevBtn = document.getElementById('lightboxPrev');
  const nextBtn = document.getElementById('lightboxNext');
  let currentIndex = 0;
  let lastFocused = null;

  function show(index) {
    currentIndex = (index + items.length) % items.length;
    const img = items[currentIndex].querySelector('img');
    lightboxImage.src = img.src;
    lightboxImage.alt = img.alt;
  }

  function open(index) {
    lastFocused = document.activeElement;
    show(index);
    lightbox.hidden = false;
    document.body.style.overflow = 'hidden';
    closeBtn.focus();
    document.addEventListener('keydown', onKeydown);
  }

  function close() {
    lightbox.hidden = true;
    document.body.style.overflow = '';
    document.removeEventListener('keydown', onKeydown);
    if (lastFocused) lastFocused.focus();
  }

  function onKeydown(e) {
    if (e.key === 'Escape') close();
    if (e.key === 'ArrowRight') show(currentIndex + 1);
    if (e.key === 'ArrowLeft') show(currentIndex - 1);
  }

  items.forEach((item, index) => {
    item.addEventListener('click', () => open(index));
  });
  closeBtn.addEventListener('click', close);
  prevBtn.addEventListener('click', () => show(currentIndex - 1));
  nextBtn.addEventListener('click', () => show(currentIndex + 1));
  lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox) close();
  });
})();

// ===== Contact / enquiry form =====
(function contactForm() {
  const form = document.getElementById('contactForm');
  const success = document.getElementById('formSuccess');
  const resetBtn = document.getElementById('resetForm');
  const nameInput = document.getElementById('fName');
  const phoneInput = document.getElementById('fPhone');
  const nameError = document.getElementById('fNameError');
  const phoneError = document.getElementById('fPhoneError');
  if (!form || !nameInput || !phoneInput) return;

  function validate(input, errorEl, message) {
    if (!input.checkValidity()) {
      if (errorEl) errorEl.textContent = message;
      return false;
    }
    if (errorEl) errorEl.textContent = '';
    return true;
  }

  nameInput.addEventListener('blur', () => validate(nameInput, nameError, 'Please enter your full name.'));
  phoneInput.addEventListener('blur', () => validate(phoneInput, phoneError, 'Please enter a valid phone number.'));

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const nameOk = validate(nameInput, nameError, 'Please enter your full name.');
    const phoneOk = validate(phoneInput, phoneError, 'Please enter a valid phone number.');
    if (!nameOk) { nameInput.focus(); return; }
    if (!phoneOk) { phoneInput.focus(); return; }

    form.hidden = true;
    if (success) success.hidden = false;
  });

  if (resetBtn) {
    resetBtn.addEventListener('click', () => {
      form.reset();
      if (nameError) nameError.textContent = '';
      if (phoneError) phoneError.textContent = '';
      if (success) success.hidden = true;
      form.hidden = false;
    });
  }
})();

// ===== Footer year =====
const yearEl = document.getElementById('year');
if (yearEl) yearEl.textContent = new Date().getFullYear();
