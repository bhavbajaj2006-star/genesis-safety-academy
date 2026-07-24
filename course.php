<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';
$stmt = db()->prepare('SELECT * FROM courses WHERE slug = :slug LIMIT 1');
$stmt->execute(['slug' => $slug]);
$course = $stmt->fetch();

if (!$course) {
    http_response_code(404);
    $pageTitle = 'Course Not Found | Genesis Safety Academy';
    require __DIR__ . '/includes/site-header.php';
    echo '<section class="page-header"><div class="container"><h1>Course Not Found</h1></div></section>';
    echo '<section class="course-detail"><p>Sorry, we couldn\'t find that course. <a href="courses.php">Back to Courses</a></p></section>';
    require __DIR__ . '/includes/site-footer.php';
    exit;
}

$pageTitle = h($course['name']) . ' | Genesis Safety Academy';
$pageDescription = $course['lead_text'] ?: $course['name'];
require __DIR__ . '/includes/site-header.php';
?>

<!-- ══ PAGE HEADER ══ -->
<section class="page-header">
  <div class="container">
    <span class="eyebrow"><?= h($course['tag']) ?> Course</span>
    <h1><?= h($course['name']) ?></h1>
  </div>
</section>

<!-- ══ COURSE DETAIL ══ -->
<section class="course-detail">
  <div class="container course-detail-grid">
    <div class="course-detail-media">
      <img src="<?= h($course['image_path'] ?: 'images/brand/genesis-logo.png') ?>" alt="<?= h($course['name']) ?>" />
      <span class="course-detail-tag<?= $course['tag'] === 'Diploma' ? ' course-detail-tag-diploma' : '' ?>"><?= h($course['tag']) ?></span>
    </div>
    <div>
      <a href="courses.php" class="course-detail-back">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 18l-6-6 6-6"/></svg>
        Back to all courses
      </a>
      <h2><?= h($course['name']) ?></h2>
      <?php if (!empty($course['lead_text'])): ?>
        <p class="course-detail-lead"><?= h($course['lead_text']) ?></p>
      <?php endif; ?>
      <?php if (!empty($course['duration_text'])): ?>
        <p class="course-detail-lead"><strong><?= h($course['duration_text']) ?></strong></p>
      <?php endif; ?>

      <div class="course-modules">
        <h4>Course Modules</h4>
        <?php if (!empty($course['modules_text'])): ?>
          <div><?= $course['modules_text'] /* trusted HTML entered by the logged-in admin only */ ?></div>
        <?php else: ?>
          <p class="course-modules-placeholder">Module-by-module syllabus for this course will be published here shortly. Contact us for the full curriculum right now.</p>
        <?php endif; ?>
      </div>

      <div class="course-item-actions">
        <a href="enquiry.html" class="btn btn-flame">Enquire About This Course
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
        <a href="courses.php" class="course-back-link">View all courses</a>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
