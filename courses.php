<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$courses = db()->query('SELECT * FROM courses ORDER BY sort_order ASC, id ASC')->fetchAll();

$pageTitle = 'Courses | Genesis Safety Academy';
$pageDescription = 'Certificate and diploma safety courses at Genesis Safety Academy, Chennai.';
require __DIR__ . '/includes/site-header.php';
?>

<!-- ══ PAGE HEADER ══ -->
<section class="page-header">
  <div class="container">
    <span class="eyebrow">Genesis Safety Academy Courses</span>
    <h1><?= count($courses) ?> certified &amp; diploma courses, built for real job readiness.</h1>
  </div>
</section>

<!-- ══ COURSE LIST ══ -->
<section class="course-list-section">
  <div class="container">
    <div class="section-head-center">
      <span class="eyebrow eyebrow-flame">Full Course Catalogue</span>
      <h2>Certificate &amp; Diploma Courses</h2>
      <p class="section-note" style="margin:0 auto">Click any course to view its full details and modules.</p>
    </div>

    <div class="course-search">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.35-4.35"/></svg>
      <input type="search" id="courseSearch" class="course-search-input" placeholder="Search courses by name…" aria-label="Search courses" autocomplete="off" />
    </div>
    <p class="course-search-empty" id="courseSearchEmpty" hidden>No courses match your search.</p>

    <div class="course-card2-grid" id="courseGrid">
      <?php if (!$courses): ?>
        <p class="section-note">No courses published yet.</p>
      <?php endif; ?>
      <?php foreach ($courses as $c): ?>
        <a href="course.php?slug=<?= urlencode($c['slug']) ?>" class="course-card2<?= $c['featured'] ? ' course-card2-featured' : '' ?>" data-course-name="<?= h(strtolower($c['name'])) ?>">
          <span class="course-card2-thumb">
            <img src="<?= h($c['image_path'] ?: 'images/brand/genesis-logo.png') ?>" alt="<?= h($c['name']) ?>" />
            <span class="course-card2-tag<?= $c['tag'] === 'Diploma' ? ' course-card2-tag-diploma' : '' ?>"><?= h($c['tag']) ?></span>
          </span>
          <span class="course-card2-info">
            <span class="course-card2-name"><?= h($c['name']) ?></span>
            <span class="course-card2-meta">
              <span class="course-card2-hours"><?= h($c['duration_text'] ?: 'Batch dates on request') ?></span>
              <span class="course-card2-link">View details
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </span>
            </span>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
