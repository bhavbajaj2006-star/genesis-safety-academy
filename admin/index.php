<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

$counts = [
    'blogs' => db()->query('SELECT COUNT(*) c FROM blog_posts')->fetch()['c'],
    'courses' => db()->query('SELECT COUNT(*) c FROM courses')->fetch()['c'],
    'corporate' => db()->query('SELECT COUNT(*) c FROM corporate_programs')->fetch()['c'],
    'testimonials' => db()->query('SELECT COUNT(*) c FROM testimonials')->fetch()['c'],
    'gallery' => db()->query('SELECT COUNT(*) c FROM gallery_photos')->fetch()['c'],
];

$pageTitle = 'Dashboard';
$activeNav = 'dashboard';
require __DIR__ . '/includes/layout-top.php';
?>
<div class="admin-topbar">
  <h1>Dashboard</h1>
  <span class="muted">Logged in as <?= h(current_admin_username()) ?></span>
</div>

<div class="stat-grid">
  <div class="stat-card">
    <div class="num"><?= (int)$counts['blogs'] ?></div>
    <div class="label">Blog Posts</div>
    <a href="blogs.php">Manage &rarr;</a>
  </div>
  <div class="stat-card">
    <div class="num"><?= (int)$counts['courses'] ?></div>
    <div class="label">Courses</div>
    <a href="courses.php">Manage &rarr;</a>
  </div>
  <div class="stat-card">
    <div class="num"><?= (int)$counts['corporate'] ?></div>
    <div class="label">Corporate Programs</div>
    <a href="corporate.php">Manage &rarr;</a>
  </div>
  <div class="stat-card">
    <div class="num"><?= (int)$counts['testimonials'] ?></div>
    <div class="label">Testimonials</div>
    <a href="testimonials.php">Manage &rarr;</a>
  </div>
  <div class="stat-card">
    <div class="num"><?= (int)$counts['gallery'] ?></div>
    <div class="label">Gallery Photos</div>
    <a href="gallery.php">Manage &rarr;</a>
  </div>
</div>

<div class="card">
  <h2>Quick tips</h2>
  <ul style="padding-left:20px; display:grid; gap:8px; font-size:14px; color:#333f4d;">
    <li>Changes you make here show up on the live site immediately — there's no separate "publish" step.</li>
    <li>Image uploads are limited to JPG, PNG, WEBP or SVG, up to 5MB.</li>
    <li>Deleting an item removes it from the live site right away and can't be undone.</li>
  </ul>
</div>
<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
