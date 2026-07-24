<?php
/** @var string $pageTitle */
/** @var string $activeNav */
$activeNav = $activeNav ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?= h($pageTitle ?? 'Admin') ?> | Genesis Safety Academy Admin</title>
<link rel="stylesheet" href="admin.css" />
</head>
<body>
<div class="admin-shell">
  <aside class="admin-sidebar">
    <div class="admin-brand">Genesis Safety Academy<span>Content Admin</span></div>
    <nav class="admin-nav">
      <a href="index.php" class="<?= $activeNav === 'dashboard' ? 'active' : '' ?>">Dashboard</a>
      <a href="blogs.php" class="<?= $activeNav === 'blogs' ? 'active' : '' ?>">Blog Posts</a>
      <a href="courses.php" class="<?= $activeNav === 'courses' ? 'active' : '' ?>">Courses</a>
      <a href="corporate.php" class="<?= $activeNav === 'corporate' ? 'active' : '' ?>">Corporate Programs</a>
      <a href="testimonials.php" class="<?= $activeNav === 'testimonials' ? 'active' : '' ?>">Testimonials</a>
      <a href="gallery.php" class="<?= $activeNav === 'gallery' ? 'active' : '' ?>">Gallery Photos</a>
    </nav>
    <div class="admin-nav-footer">
      <a href="../index.php" target="_blank">View live site &rarr;</a><br />
      <a href="change-password.php">Change password</a><br />
      <a href="logout.php">Log out (<?= h(current_admin_username()) ?>)</a>
    </div>
  </aside>
  <main class="admin-main">
    <?php $flash = flash_get(); if ($flash): ?>
      <div class="alert alert-<?= h($flash['type']) ?>"><?= h($flash['message']) ?></div>
    <?php endif; ?>
