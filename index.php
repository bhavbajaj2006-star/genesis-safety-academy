<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$courses = db()->query('SELECT * FROM courses ORDER BY sort_order ASC, id ASC')->fetchAll();
$corporateTestimonials = db()->query("SELECT * FROM testimonials WHERE type='corporate' ORDER BY sort_order ASC, id ASC")->fetchAll();
$studentTestimonials = db()->query("SELECT * FROM testimonials WHERE type='student' ORDER BY sort_order ASC, id ASC")->fetchAll();
$latestPosts = db()->query('SELECT * FROM blog_posts ORDER BY post_date DESC LIMIT 3')->fetchAll();

function render_course_card(array $c, bool $duplicate = false): void {
    $hidden = $duplicate ? ' aria-hidden="true" tabindex="-1"' : '';
    $alt = $duplicate ? '' : h($c['name']);
    ?>
    <a href="course.php?slug=<?= urlencode($c['slug']) ?>" class="blueprint course-card<?= $c['featured'] ? ' course-card-featured' : '' ?>"<?= $hidden ?>><span class="duotone course-thumb"><img src="<?= h($c['image_path'] ?: 'images/brand/genesis-logo.png') ?>" alt="<?= $alt ?>" /></span><span class="course-body"><span class="course-tag"><?= h($c['tag']) ?></span><span class="course-name"><?= h($c['name']) ?></span><span class="course-desc"><?= h($c['duration_text'] ?: 'Batch dates on request') ?></span><span class="course-link">View details<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
    <?php
}

function render_home_testimonial(array $t): void {
    $videoAttr = !empty($t['video_path']) ? ' data-video="' . h($t['video_path']) . '"' : '';
    ?>
    <div class="blueprint testimonial-card"<?= $videoAttr ?>>
      <p>"<?= h($t['quote']) ?>"</p>
      <div class="testimonial-author">
        <?php if (!empty($t['logo_path'])): ?>
          <span class="avatar avatar-logo"><img src="<?= h($t['logo_path']) ?>" alt="<?= h($t['author_meta']) ?> logo" /></span>
        <?php else: ?>
          <span class="avatar"><?= h($t['avatar_initials'] ?: '?') ?></span>
        <?php endif; ?>
        <span>
          <span class="author-name"><?= h($t['author_name']) ?></span>
          <span class="author-city"><?= h($t['author_meta']) ?></span>
        </span>
      </div>
    </div>
    <?php
}

$pageTitle = 'Genesis Safety Academy | Build a Career That Protects Lives';
require __DIR__ . '/includes/site-header.php';
?>

<!-- ══ FIRST FOLD — Band 1 + Band 2 (both fully visible on load) ══ -->
<div class="first-fold">

  <!-- ══ BAND 1 — Corporate Training photo | program links ══ -->
  <section class="band1">
    <div class="container band1-inner">
      <div class="band1-photo" id="band1Slideshow">
        <img class="band1-slide active" src="images/hero/banner-1.png" alt="Genesis Safety Academy corporate training session in progress" />
        <img class="band1-slide" src="images/hero/banner-2.png" alt="Genesis Safety Academy corporate training session in progress" />
        <img class="band1-slide" src="images/hero/banner-3.png" alt="Genesis Safety Academy corporate training session in progress" />
      </div>
      <div class="band1-programs">
        <span class="band1-programs-eyebrow">What we offer</span>
        <a href="corporate.php" class="band1-program">
          <span class="band1-program-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 21h18M6 21V8l6-4 6 4v13M10 21v-5h4v5"/></svg></span>
          <span class="band1-program-title">CorporateTraining</span>
          <svg class="band1-program-arrow" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
        <a href="courses.php" class="band1-program">
          <span class="band1-program-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 2 3 6v6c0 5 4 8 9 10 5-2 9-5 9-10V6l-9-4Z"/></svg></span>
          <span class="band1-program-title">Safety Courses</span>
          <svg class="band1-program-arrow" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
        <a href="courses.php" class="band1-program">
          <span class="band1-program-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 15a5 5 0 1 0 0-10 5 5 0 0 0 0 10ZM9 14l-1 7 4-2 4 2-1-7"/></svg></span>
          <span class="band1-program-title">Safety Audit &amp; Certifications</span>
          <svg class="band1-program-arrow" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </div>
    </div>
  </section>

  <!-- ══ BAND 2 — A Hub for Skill Development + headline ══ -->
  <section class="band2">
    <div class="container band2-inner">
      <span class="band2-eyebrow">A Hub for Skill Development</span>
      <h1 class="band2-title">India's most preferred Safety Training, Certifications &amp; Safety Courses Institution</h1>
    </div>
  </section>

</div>

<!-- ══ BAND 3 — Vision & Mission Statement ══ -->
<section class="vm-band">
  <div class="container vm-band-inner">
    <div class="section-head-center">
      <span class="eyebrow eyebrow-flame">Who We Are</span>
      <h2>Vision &amp; Mission Statement</h2>
    </div>
    <div class="vm-blocks vm-blocks-home">
      <div class="vm-block vm-blue">
        <span class="vm-label">Vision Statement</span>
        <span class="vm-text">To be a trusted leader in cultivating a culture of safety by delivering excellence in work place, environmental and fire safety education, empowering individuals and organizations to protect lives, preserve the environment and build resilient communities.</span>
      </div>
      <div class="vm-block vm-flame">
        <span class="vm-label">Mission Statement</span>
        <span class="vm-text">Our mission is to help Students, Professionals, Workers, Unemployed Youth and Housewives by skilling and upskilling them to get employed and grow in their professional career for fulfilling their dreams.</span>
      </div>
    </div>
    <div class="vm-band-cta">
      <a href="about.html" class="btn btn-blue">Know More About Us
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- ══ BAND 4 — Corporate Training photos scrolling with company names ══ -->
<section class="training-band">
  <div class="container">
    <div class="section-head-center">
      <span class="eyebrow eyebrow-flame">Corporate Training</span>
      <h2>Trusted by leading companies</h2>
    </div>
  </div>
  <div class="marquee">
    <div class="marquee-track training-track">
      <figure class="training-card"><img src="images/gallery/photo-1.jpg" alt="Genesis Safety Academy corporate training session" /><figcaption>Ascendas Vinplex</figcaption></figure>
      <figure class="training-card"><img src="images/gallery/photo-2.jpg" alt="Genesis Safety Academy corporate training session" /><figcaption>Bontaz Hira</figcaption></figure>
      <figure class="training-card"><img src="images/gallery/photo-4.jpg" alt="Genesis Safety Academy corporate training session" /><figcaption>BYD</figcaption></figure>
      <figure class="training-card"><img src="images/gallery/photo-5.jpg" alt="Genesis Safety Academy corporate training session" /><figcaption>DLF</figcaption></figure>
      <figure class="training-card"><img src="images/gallery/photo-6.jpg" alt="Genesis Safety Academy corporate training session" /><figcaption>TVS</figcaption></figure>
      <figure class="training-card"><img src="images/gallery/photo-7.jpg" alt="Genesis Safety Academy corporate training session" /><figcaption>SRF</figcaption></figure>
      <figure class="training-card"><img src="images/gallery/photo-8.jpg" alt="Genesis Safety Academy corporate training session" /><figcaption>Denix</figcaption></figure>
      <figure class="training-card"><img src="images/gallery/photo-9.jpg" alt="Genesis Safety Academy corporate training session" /><figcaption>Hindustan Inst. of Tech &amp; Science</figcaption></figure>
      <figure class="training-card"><img src="images/about/training-session.jpg" alt="Genesis Safety Academy corporate training session" /><figcaption>Arudra Engineers</figcaption></figure>
      <figure class="training-card"><img src="images/gallery/photo-3.jpg" alt="Genesis Safety Academy corporate training session" /><figcaption>NortonLifeLock</figcaption></figure>
      <!-- duplicate set for seamless loop -->
      <figure class="training-card" aria-hidden="true"><img src="images/gallery/photo-1.jpg" alt="" /><figcaption>Ascendas Vinplex</figcaption></figure>
      <figure class="training-card" aria-hidden="true"><img src="images/gallery/photo-2.jpg" alt="" /><figcaption>Bontaz Hira</figcaption></figure>
      <figure class="training-card" aria-hidden="true"><img src="images/gallery/photo-4.jpg" alt="" /><figcaption>BYD</figcaption></figure>
      <figure class="training-card" aria-hidden="true"><img src="images/gallery/photo-5.jpg" alt="" /><figcaption>DLF</figcaption></figure>
      <figure class="training-card" aria-hidden="true"><img src="images/gallery/photo-6.jpg" alt="" /><figcaption>TVS</figcaption></figure>
      <figure class="training-card" aria-hidden="true"><img src="images/gallery/photo-7.jpg" alt="" /><figcaption>SRF</figcaption></figure>
      <figure class="training-card" aria-hidden="true"><img src="images/gallery/photo-8.jpg" alt="" /><figcaption>Denix</figcaption></figure>
      <figure class="training-card" aria-hidden="true"><img src="images/gallery/photo-9.jpg" alt="" /><figcaption>Hindustan Inst. of Tech &amp; Science</figcaption></figure>
      <figure class="training-card" aria-hidden="true"><img src="images/about/training-session.jpg" alt="" /><figcaption>Arudra Engineers</figcaption></figure>
      <figure class="training-card" aria-hidden="true"><img src="images/gallery/photo-3.jpg" alt="" /><figcaption>NortonLifeLock</figcaption></figure>
    </div>
  </div>
</section>

<!-- ══ CORPORATE TESTIMONIALS ══ -->
<section class="testimonials">
  <div class="section-head-center">
    <span class="eyebrow eyebrow-flame">What Corporates Say</span>
    <h2>Trusted by the teams we've trained</h2>
  </div>
  <div class="testimonial-carousel">
  <div class="testimonial-track" id="corpTestimonialTrack">
    <?php foreach ($corporateTestimonials as $t) render_home_testimonial($t); ?>
  </div>
  <div class="testimonial-nav-row">
    <button type="button" class="testimonial-nav-btn" data-dir="-1" aria-label="Previous testimonial">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M15 18l-6-6 6-6"/></svg>
    </button>
    <button type="button" class="testimonial-nav-btn" data-dir="1" aria-label="Next testimonial">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 18l6-6-6-6"/></svg>
    </button>
  </div>
  </div>
  <div class="testimonial-viewall">
    <a href="testimonials.php#corporate" class="btn btn-outline">View All Corporate Testimonials
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
    </a>
  </div>
</section>

<!-- ══ BAND 5 — Safety Courses scrolling ══ -->
<section class="courses">
  <div class="container">
    <div class="section-head">
      <div>
        <span class="eyebrow eyebrow-flame">Our Courses</span>
        <h2>Safety Courses</h2>
      </div>
      <a href="courses.php" class="section-cta">View all courses<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
    </div>
  </div>
  <div class="marquee">
    <div class="marquee-track course-track">
      <?php foreach ($courses as $c) render_course_card($c); ?>
      <!-- duplicate set for seamless loop -->
      <?php foreach ($courses as $c) render_course_card($c, true); ?>
    </div>
  </div>
  <div class="container">
    <p class="section-note course-note">All <?= count($courses) ?> certified &amp; diploma courses. <a href="courses.php">View full curriculum, batch dates &amp; enrolment →</a></p>
  </div>
</section>

<!-- ══ STUDENT TESTIMONIALS ══ -->
<section class="testimonials">
  <div class="section-head-center">
    <span class="eyebrow eyebrow-flame">What Students Say</span>
    <h2>Learners who built their career with us</h2>
  </div>
  <div class="testimonial-carousel">
  <div class="testimonial-track" id="studentTestimonialTrack">
    <?php foreach ($studentTestimonials as $t) render_home_testimonial($t); ?>
  </div>
  <div class="testimonial-nav-row">
    <button type="button" class="testimonial-nav-btn" data-dir="-1" aria-label="Previous testimonial">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M15 18l-6-6 6-6"/></svg>
    </button>
    <button type="button" class="testimonial-nav-btn" data-dir="1" aria-label="Next testimonial">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 18l6-6-6-6"/></svg>
    </button>
  </div>
  </div>
  <div class="testimonial-viewall">
    <a href="testimonials.php#students" class="btn btn-outline">View All Student Testimonials
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
    </a>
  </div>
</section>

<!-- ══ BAND 6 — Safety Products Offering scrolling ══ -->
<section class="products">
  <div class="container">
    <div class="section-head">
      <div>
        <span class="eyebrow eyebrow-flame">Our Safety Products Offering</span>
        <h2>Safety Products</h2>
      </div>
      <p class="section-note">Click any category to enquire — our team will share the full catalogue and pricing.</p>
    </div>
  </div>
  <div class="marquee">
    <div class="marquee-track product-track">
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="Fire Extinguishers"><span class="duotone product-thumb"><img src="images/products/fire-extinguishers.png" alt="Fire Extinguishers" /></span><span class="product-body"><span class="product-name">Fire Extinguishers</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="Fire Fighting Accessories"><span class="duotone product-thumb"><img src="images/products/fire-fighting-accessories.jpg" alt="Fire Fighting Accessories" /></span><span class="product-body"><span class="product-name">Fire Fighting Accessories</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="Smoke Detectors"><span class="duotone product-thumb"><img src="images/products/smoke-detectors.png" alt="Smoke Detectors" /></span><span class="product-body"><span class="product-name">Smoke Detectors</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="Fire Detection and Alarm Systems"><span class="duotone product-thumb"><img src="images/products/fire-detection-alarm.png" alt="Fire Detection and Alarm Systems" /></span><span class="product-body"><span class="product-name">Fire Detection and Alarm Systems</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="Escape Signages & Tapes"><span class="duotone product-thumb"><img src="images/products/escape-signages.png" alt="Escape Signages & Tapes" /></span><span class="product-body"><span class="product-name">Escape Signages &amp; Tapes</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="Emergency Lighting Systems"><span class="duotone product-thumb"><img src="images/products/emergency-light.png" alt="Emergency Lighting Systems" /></span><span class="product-body"><span class="product-name">Emergency Lighting Systems</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="CCTV"><span class="duotone product-thumb"><img src="images/products/cctv.png" alt="CCTV Security Camera" /></span><span class="product-body"><span class="product-name">CCTV</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="Burglary Alarm Systems"><span class="duotone product-thumb"><img src="images/products/burglary-alarm.png" alt="Burglary Alarm Systems" /></span><span class="product-body"><span class="product-name">Burglary Alarm Systems</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
      <!-- duplicate set for seamless loop -->
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="Fire Extinguishers" aria-hidden="true" tabindex="-1"><span class="duotone product-thumb"><img src="images/products/fire-extinguishers.png" alt="" /></span><span class="product-body"><span class="product-name">Fire Extinguishers</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="Fire Fighting Accessories" aria-hidden="true" tabindex="-1"><span class="duotone product-thumb"><img src="images/products/fire-fighting-accessories.jpg" alt="" /></span><span class="product-body"><span class="product-name">Fire Fighting Accessories</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="Smoke Detectors" aria-hidden="true" tabindex="-1"><span class="duotone product-thumb"><img src="images/products/smoke-detectors.png" alt="" /></span><span class="product-body"><span class="product-name">Smoke Detectors</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="Fire Detection and Alarm Systems" aria-hidden="true" tabindex="-1"><span class="duotone product-thumb"><img src="images/products/fire-detection-alarm.png" alt="" /></span><span class="product-body"><span class="product-name">Fire Detection and Alarm Systems</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="Escape Signages & Tapes" aria-hidden="true" tabindex="-1"><span class="duotone product-thumb"><img src="images/products/escape-signages.png" alt="" /></span><span class="product-body"><span class="product-name">Escape Signages &amp; Tapes</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="Emergency Lighting Systems" aria-hidden="true" tabindex="-1"><span class="duotone product-thumb"><img src="images/products/emergency-light.png" alt="" /></span><span class="product-body"><span class="product-name">Emergency Lighting Systems</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="CCTV" aria-hidden="true" tabindex="-1"><span class="duotone product-thumb"><img src="images/products/cctv.png" alt="" /></span><span class="product-body"><span class="product-name">CCTV</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
      <a href="enquiry.html" class="blueprint product-card" data-enquiry="Burglary Alarm Systems" aria-hidden="true" tabindex="-1"><span class="duotone product-thumb"><img src="images/products/burglary-alarm.png" alt="" /></span><span class="product-body"><span class="product-name">Burglary Alarm Systems</span><span class="product-link">Enquire<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span></span></a>
    </div>
  </div>
</section>

<!-- ══ BLOG ══ -->
<section class="blog">
  <div class="container">
    <div class="section-head">
      <div>
        <span class="eyebrow eyebrow-flame">From Our Blog</span>
        <h2>Safety Tips &amp; Insights</h2>
      </div>
      <a href="blog.php" class="section-cta">View all posts<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
    </div>
    <div class="blog-grid">
      <?php foreach ($latestPosts as $post): ?>
        <a href="blog-post.php?slug=<?= urlencode($post['slug']) ?>" class="blueprint blog-card">
          <span class="blog-thumb"><img src="<?= h($post['image_path'] ?: 'images/brand/genesis-logo.png') ?>" alt="<?= h($post['title']) ?>" /></span>
          <span class="blog-body">
            <span class="blog-date"><?= h(format_date_pretty($post['post_date'])) ?></span>
            <span class="blog-title"><?= h($post['title']) ?></span>
            <span class="blog-excerpt"><?= h($post['excerpt']) ?></span>
            <span class="blog-link">Read more<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══ BAND 7 — Numbers says it all / Why Choose Us ══ -->
<section class="stats">
  <div class="container">
    <div class="section-head-center stats-head">
      <span class="eyebrow" style="color:#cfdbe8">Numbers Says It All</span>
      <h2 style="color:#fff">Why Choose Us</h2>
    </div>
    <div class="stats-grid">
      <div class="stat"><div class="stat-num" data-count="36">0</div><div class="stat-label">Training Programs</div></div>
      <div class="stat"><div class="stat-num" data-count="9">0</div><div class="stat-label">Certified / Diploma Courses</div></div>
      <div class="stat"><div class="stat-num" data-count="95" data-suffix="%">0</div><div class="stat-label">Strike Rate</div></div>
      <div class="stat"><div class="stat-num" data-count="100" data-suffix="%">0</div><div class="stat-label">Satisfied Clients</div></div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
