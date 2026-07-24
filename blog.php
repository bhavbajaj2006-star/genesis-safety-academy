<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$posts = db()->query('SELECT * FROM blog_posts ORDER BY post_date DESC')->fetchAll();

$pageTitle = 'Blog | Genesis Safety Academy';
$pageDescription = 'Safety tips and insights from Genesis Safety Academy.';
require __DIR__ . '/includes/site-header.php';
?>

<!-- ══ PAGE HEADER ══ -->
<section class="page-header">
  <div class="container">
    <span class="eyebrow">Genesis Safety Academy</span>
    <h1>Safety Tips &amp; Insights</h1>
  </div>
</section>

<!-- ══ BLOG LIST ══ -->
<section class="blog">
  <div class="container">
    <?php if (!$posts): ?>
      <p class="section-note" style="text-align:center; margin:0 auto;">No blog posts published yet. Check back soon.</p>
    <?php else: ?>
    <div class="blog-grid">
      <?php foreach ($posts as $post): ?>
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
    <?php endif; ?>
  </div>
</section>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
