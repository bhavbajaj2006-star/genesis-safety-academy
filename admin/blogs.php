<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

$posts = db()->query('SELECT * FROM blog_posts ORDER BY post_date DESC')->fetchAll();

$pageTitle = 'Blog Posts';
$activeNav = 'blogs';
require __DIR__ . '/includes/layout-top.php';
?>
<div class="admin-topbar">
  <h1>Blog Posts</h1>
  <a href="blog-form.php" class="btn btn-primary">+ New Post</a>
</div>
<div class="card">
  <table>
    <thead><tr><th></th><th>Title</th><th>Category</th><th>Date</th><th></th></tr></thead>
    <tbody>
      <?php if (!$posts): ?>
        <tr class="empty-row"><td colspan="5">No blog posts yet. Click "New Post" to add one.</td></tr>
      <?php endif; ?>
      <?php foreach ($posts as $post): ?>
        <tr>
          <td><img class="table-thumb" src="../<?= h($post['image_path'] ?: 'images/brand/genesis-logo.png') ?>" alt="" /></td>
          <td><?= h($post['title']) ?></td>
          <td><?= h($post['category']) ?></td>
          <td><?= h(format_date_pretty($post['post_date'])) ?></td>
          <td class="table-actions">
            <a class="btn btn-secondary btn-sm" href="../blog-post.php?slug=<?= urlencode($post['slug']) ?>" target="_blank">View</a>
            <a class="btn btn-secondary btn-sm" href="blog-form.php?id=<?= $post['id'] ?>">Edit</a>
            <form method="post" action="blog-delete.php" onsubmit="return confirm('Delete this blog post? This cannot be undone.');" style="display:inline">
              <input type="hidden" name="id" value="<?= $post['id'] ?>" />
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
