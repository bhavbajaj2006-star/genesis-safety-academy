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

// ===== Band 1 photo slideshow (fast cycle) =====
(function band1Slideshow() {
  const slides = document.querySelectorAll('.band1-slide');
  if (!slides.length) return;
  let current = 0;
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (prefersReducedMotion) return;

  setInterval(() => {
    slides[current].classList.remove('active');
    current = (current + 1) % slides.length;
    slides[current].classList.add('active');
  }, 2500);
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
  let current = location.pathname.split('/').pop().replace(/\.html$/, '');
  if (current === '') current = 'index';
  const onCourseDetailPage = current.startsWith('course-');

  navLinks.forEach((link) => {
    const href = link.getAttribute('href');
    if (!href || href.startsWith('#')) return;
    const linkPage = href.split('/').pop().replace(/\.html$/, '');
    const isMatch = linkPage === current || (onCourseDetailPage && linkPage === 'courses');
    link.classList.toggle('active', isMatch);
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

// ===== Testimonial carousels (one line, arrow navigation) =====
(function testimonialCarousels() {
  document.querySelectorAll('.testimonial-carousel').forEach((carousel) => {
    const track = carousel.querySelector('.testimonial-track');
    const prevBtn = carousel.querySelector('[data-dir="-1"]');
    const nextBtn = carousel.querySelector('[data-dir="1"]');
    if (!track) return;

    function scrollByCard(dir) {
      const card = track.querySelector('.testimonial-card');
      if (!card) return;
      const gap = parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap) || 0;
      track.scrollBy({ left: dir * (card.getBoundingClientRect().width + gap), behavior: 'smooth' });
    }

    if (prevBtn) prevBtn.addEventListener('click', () => scrollByCard(-1));
    if (nextBtn) nextBtn.addEventListener('click', () => scrollByCard(1));
  });
})();

// ===== Testimonial video modal (click a testimonial to play its video) =====
(function testimonialVideoModal() {
  const cards = document.querySelectorAll('.testimonial-card');
  if (!cards.length) return;

  cards.forEach((card) => {
    if (!card.querySelector('.testimonial-play-badge')) {
      const badge = document.createElement('span');
      badge.className = 'testimonial-play-badge';
      badge.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>';
      card.appendChild(badge);
    }
  });

  const backdrop = document.createElement('div');
  backdrop.className = 'video-modal-backdrop';
  backdrop.innerHTML =
    '<div class="video-modal">' +
      '<button type="button" class="video-modal-close" aria-label="Close video">' +
        '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18"/></svg>' +
      '</button>' +
      '<div class="video-modal-player" id="videoModalPlayer"></div>' +
      '<div class="video-modal-info" id="videoModalInfo"></div>' +
    '</div>';
  document.body.appendChild(backdrop);

  const player = backdrop.querySelector('#videoModalPlayer');
  const info = backdrop.querySelector('#videoModalInfo');
  const closeBtn = backdrop.querySelector('.video-modal-close');
  let lastFocused = null;

  function openModal(card) {
    const videoSrc = card.dataset.video;
    const quote = card.querySelector('p') ? card.querySelector('p').textContent : '';
    const authorEl = card.querySelector('.testimonial-author');

    if (videoSrc) {
      player.innerHTML = '<video src="' + videoSrc + '" controls autoplay playsinline></video>';
    } else {
      player.innerHTML =
        '<div class="video-modal-placeholder">' +
          '<span class="play-circle"><svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>' +
          '<p>Video testimonial coming soon</p>' +
        '</div>';
    }

    info.innerHTML = '<p class="video-modal-quote">' + quote + '</p>' + (authorEl ? authorEl.outerHTML : '');

    lastFocused = document.activeElement;
    backdrop.classList.add('show');
    document.body.style.overflow = 'hidden';
    closeBtn.focus();
    document.addEventListener('keydown', onKeydown);
  }

  function closeModal() {
    backdrop.classList.remove('show');
    document.body.style.overflow = '';
    player.innerHTML = '';
    document.removeEventListener('keydown', onKeydown);
    if (lastFocused) lastFocused.focus();
  }

  function onKeydown(e) {
    if (e.key === 'Escape') closeModal();
  }

  cards.forEach((card) => {
    card.addEventListener('click', () => openModal(card));
  });
  closeBtn.addEventListener('click', closeModal);
  backdrop.addEventListener('click', (e) => {
    if (e.target === backdrop) closeModal();
  });
})();

// ===== Gallery lightbox =====
(function galleryLightbox() {
  const items = Array.from(document.querySelectorAll('.gallery-item'));
  const lightbox = document.getElementById('lightbox');
  if (!items.length || !lightbox) return;

  const lightboxImage = document.getElementById('lightboxImage');
  const lightboxName = document.getElementById('lightboxName');
  const lightboxLoc = document.getElementById('lightboxLoc');
  const closeBtn = document.getElementById('lightboxClose');
  const prevBtn = document.getElementById('lightboxPrev');
  const nextBtn = document.getElementById('lightboxNext');
  let currentIndex = 0;
  let lastFocused = null;

  function show(index) {
    currentIndex = (index + items.length) % items.length;
    const activeItem = items[currentIndex];
    const img = activeItem.querySelector('img');
    lightboxImage.src = img.src;
    lightboxImage.alt = img.alt;
    if (lightboxName) lightboxName.textContent = activeItem.dataset.name || '';
    if (lightboxLoc) lightboxLoc.textContent = activeItem.dataset.location || '';
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

// ===== Course search filter =====
(function courseSearch() {
  const input = document.getElementById('courseSearch');
  const grid = document.getElementById('courseGrid');
  const emptyMsg = document.getElementById('courseSearchEmpty');
  if (!input || !grid) return;

  const cards = Array.from(grid.querySelectorAll('[data-course-name]'));

  input.addEventListener('input', () => {
    const query = input.value.trim().toLowerCase();
    let visibleCount = 0;
    cards.forEach((card) => {
      const matches = card.dataset.courseName.includes(query);
      card.style.display = matches ? '' : 'none';
      if (matches) visibleCount++;
    });
    if (emptyMsg) emptyMsg.hidden = visibleCount !== 0;
  });
})();

// ===== Stats count-up ("Numbers says it all") =====
(function statsCountUp() {
  const nums = document.querySelectorAll('.stat-num[data-count]');
  if (!nums.length) return;

  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function setFinal(el) {
    const target = parseInt(el.dataset.count, 10) || 0;
    el.textContent = target + (el.dataset.suffix || '');
  }

  if (prefersReducedMotion || !('IntersectionObserver' in window)) {
    nums.forEach(setFinal);
    return;
  }

  function run(el) {
    const target = parseInt(el.dataset.count, 10) || 0;
    const suffix = el.dataset.suffix || '';
    const duration = 1400;
    const start = performance.now();
    function tick(now) {
      const p = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.round(target * eased) + suffix;
      if (p < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        run(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.4 });

  nums.forEach((el) => observer.observe(el));
})();

// ===== Footer year =====
const yearEl = document.getElementById('year');
if (yearEl) yearEl.textContent = new Date().getFullYear();
