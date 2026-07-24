<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';
$stmt = db()->prepare('SELECT * FROM blog_posts WHERE slug = :slug LIMIT 1');
$stmt->execute(['slug' => $slug]);
$post = $stmt->fetch();

if (!$post) {
    http_response_code(404);
    $pageTitle = 'Post Not Found | Genesis Safety Academy';
    require __DIR__ . '/includes/site-header.php';
    echo '<section class="page-header"><div class="container"><h1>Post Not Found</h1></div></section>';
    echo '<section class="blog-article-section"><p>Sorry, we couldn\'t find that blog post. <a href="blog.php">Back to Blog</a></p></section>';
    require __DIR__ . '/includes/site-footer.php';
    exit;
}

$pageTitle = h($post['title']) . ' | Genesis Safety Academy Blog';
$pageDescription = $post['excerpt'] ?: $post['title'];
$pageKeywords = $post['seo_keywords'] ?? '';
require __DIR__ . '/includes/site-header.php';
?>

<!-- ══ PAGE HEADER ══ -->
<section class="page-header">
  <div class="container">
    <span class="eyebrow">Genesis Safety Academy Blog</span>
    <h1><?= h($post['title']) ?></h1>
  </div>
</section>

<!-- ══ ARTICLE ══ -->
<article class="blog-article-section">
  <a href="blog.php" class="blog-back-link">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
    Back to Blog
  </a>
  <?php if (!empty($post['image_path'])): ?>
  <div class="blog-article-media">
    <img src="<?= h($post['image_path']) ?>" alt="<?= h($post['title']) ?>" />
  </div>
  <?php endif; ?>
  <div class="blog-article-meta">
    <?php if (!empty($post['category'])): ?><span class="blog-article-tag"><?= h($post['category']) ?></span><?php endif; ?>
    <span class="blog-article-date"><?= h(format_date_pretty($post['post_date'])) ?></span>
  </div>
  <div class="blog-article-body">
    <?= $post['body'] /* trusted HTML entered by the logged-in admin only */ ?>
    <div class="blog-article-cta">
      <a href="enquiry.html" class="btn btn-flame">Enquire With Us
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
  </div>
</article>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
