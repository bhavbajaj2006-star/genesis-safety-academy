// ===== Hero slideshow =====
(function heroSlideshow() {
  const slides = document.querySelectorAll('.hero-slide');
  const dots = document.querySelectorAll('.hero-dot');
  let current = 0;
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function goTo(i) {
    slides[current].classList.remove('active');
    dots[current].classList.remove('active');
    current = (i + slides.length) % slides.length;
    slides[current].classList.add('active');
    dots[current].classList.add('active');
  }

  dots.forEach((dot, i) => dot.addEventListener('click', () => goTo(i)));

  if (!prefersReducedMotion) {
    setInterval(() => goTo(current + 1), 5200);
  }
})();

// ===== Sticky header shadow =====
(function stickyHeader() {
  const header = document.getElementById('siteHeader');
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

// ===== Active nav link on scroll =====
(function activeNavOnScroll() {
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.main-nav a');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const id = entry.target.getAttribute('id');
        navLinks.forEach((link) => link.classList.toggle('active', link.getAttribute('href') === `#${id}`));
      }
    });
  }, { rootMargin: '-45% 0px -50% 0px' });
  sections.forEach((s) => observer.observe(s));
})();

// ===== Product category enquiry pre-fill =====
(function productEnquiry() {
  document.querySelectorAll('.product-card[data-enquiry]').forEach((card) => {
    card.addEventListener('click', () => {
      const topic = document.getElementById('fTopic');
      const msg = document.getElementById('fMsg');
      if (topic) topic.value = 'Safety products';
      if (msg) msg.value = `I'm interested in ${card.dataset.enquiry}. Please share pricing and availability.`;
    });
  });
})();

// ===== Course enquiry pre-fill =====
(function courseEnquiry() {
  document.querySelectorAll('.course-card[data-enquiry]').forEach((card) => {
    card.addEventListener('click', () => {
      const topic = document.getElementById('fTopic');
      const msg = document.getElementById('fMsg');
      if (topic) topic.value = card.dataset.enquiry;
      if (msg) msg.value = `I'm interested in enrolling in ${card.dataset.enquiry}. Please share the next batch dates.`;
    });
  });
})();

// ===== Corporate training enquiry pre-fill =====
(function corporateEnquiry() {
  document.querySelectorAll('.corporate-tag[data-enquiry]').forEach((tag) => {
    tag.addEventListener('click', () => {
      const topic = document.getElementById('fTopic');
      const msg = document.getElementById('fMsg');
      if (topic) topic.value = 'Corporate training';
      if (msg) msg.value = `I'd like to schedule ${tag.dataset.enquiry} for our team. Please share availability and pricing.`;
    });
  });
})();

// ===== Contact form =====
(function contactForm() {
  const form = document.getElementById('contactForm');
  const success = document.getElementById('formSuccess');
  const resetBtn = document.getElementById('resetForm');
  const nameInput = document.getElementById('fName');
  const phoneInput = document.getElementById('fPhone');
  const nameError = document.getElementById('fNameError');
  const phoneError = document.getElementById('fPhoneError');

  function validate(input, errorEl, message) {
    if (!input.checkValidity()) {
      errorEl.textContent = message;
      return false;
    }
    errorEl.textContent = '';
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
    success.hidden = false;
  });

  resetBtn.addEventListener('click', () => {
    form.reset();
    nameError.textContent = '';
    phoneError.textContent = '';
    success.hidden = true;
    form.hidden = false;
  });
})();

// ===== Footer year =====
document.getElementById('year').textContent = new Date().getFullYear();
