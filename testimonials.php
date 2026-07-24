<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$corporate = db()->query("SELECT * FROM testimonials WHERE type='corporate' ORDER BY sort_order ASC, id ASC")->fetchAll();
$students = db()->query("SELECT * FROM testimonials WHERE type='student' ORDER BY sort_order ASC, id ASC")->fetchAll();

function render_testimonial_card(array $t): void {
    ?>
    <div class="blueprint testimonial-card">
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

$pageTitle = 'Testimonials | Genesis Safety Academy';
$pageDescription = "What corporates and students say about Genesis Safety Academy's safety training and corporate safety audits.";
require __DIR__ . '/includes/site-header.php';
?>

<!-- ══ PAGE HEADER ══ -->
<section class="page-header">
  <div class="container">
    <span class="eyebrow">Genesis Safety Academy</span>
    <h1>Testimonials</h1>
  </div>
</section>

<!-- ══ CORPORATE TESTIMONIALS ══ -->
<section class="testimonials" id="corporate">
  <div class="section-head-center">
    <span class="eyebrow eyebrow-flame">What Corporates Say</span>
    <h2>Trusted by the teams we've trained</h2>
  </div>
  <div class="testimonial-grid">
    <?php if (!$corporate): ?>
      <p class="section-note">No corporate testimonials yet.</p>
    <?php endif; ?>
    <?php foreach ($corporate as $t) render_testimonial_card($t); ?>
  </div>
</section>

<!-- ══ STUDENT TESTIMONIALS ══ -->
<section class="testimonials" id="students">
  <div class="section-head-center">
    <span class="eyebrow eyebrow-flame">What Students Say</span>
    <h2>Learners who built their career with us</h2>
  </div>
  <div class="testimonial-grid">
    <?php if (!$students): ?>
      <p class="section-note">No student testimonials yet.</p>
    <?php endif; ?>
    <?php foreach ($students as $t) render_testimonial_card($t); ?>
  </div>
</section>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
