<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

$id = isset($_GET['id']) ? (int) $_GET['id'] : (isset($_POST['id']) ? (int) $_POST['id'] : null);
$post = ['title' => '', 'category' => '', 'post_date' => date('Y-m-d'), 'excerpt' => '', 'seo_keywords' => '', 'body' => '', 'image_path' => ''];
if ($id) {
    $stmt = db()->prepare('SELECT * FROM blog_posts WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $found = $stmt->fetch();
    if (!$found) { flash_set('Blog post not found.', 'error'); redirect('blogs.php'); }
    $post = $found;
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $postDate = $_POST['post_date'] ?? date('Y-m-d');
    $excerpt = trim($_POST['excerpt'] ?? '');
    $seoKeywords = trim($_POST['seo_keywords'] ?? '');
    $body = trim($_POST['body'] ?? '');

    if ($title === '' || $body === '') {
        $error = 'Title and body content are required.';
    } else {
        $imagePath = handle_image_upload('image', 'blog');
        if ($imagePath === false) {
            $error = upload_error();
        } else {
            $pdo = db();
            $slug = $id ? $post['slug'] : unique_slug($pdo, 'blog_posts', $title, $id);
            if ($id) {
                $sql = 'UPDATE blog_posts SET title=:title, slug=:slug, category=:category, post_date=:post_date, excerpt=:excerpt, seo_keywords=:seo_keywords, body=:body' .
                       ($imagePath ? ', image_path=:image_path' : '') . ' WHERE id=:id';
                $params = ['title' => $title, 'slug' => $slug, 'category' => $category, 'post_date' => $postDate, 'excerpt' => $excerpt, 'seo_keywords' => $seoKeywords, 'body' => $body, 'id' => $id];
                if ($imagePath) $params['image_path'] = $imagePath;
            } else {
                $sql = 'INSERT INTO blog_posts (title, slug, category, post_date, excerpt, seo_keywords, body, image_path) VALUES (:title, :slug, :category, :post_date, :excerpt, :seo_keywords, :body, :image_path)';
                $params = ['title' => $title, 'slug' => $slug, 'category' => $category, 'post_date' => $postDate, 'excerpt' => $excerpt, 'seo_keywords' => $seoKeywords, 'body' => $body, 'image_path' => $imagePath ?: null];
            }
            $pdo->prepare($sql)->execute($params);
            flash_set($id ? 'Blog post updated.' : 'Blog post created.', 'success');
            redirect('blogs.php');
        }
    }
}

$pageTitle = $id ? 'Edit Blog Post' : 'New Blog Post';
$activeNav = 'blogs';
require __DIR__ . '/includes/layout-top.php';
?>
<div class="admin-topbar"><h1><?= $id ? 'Edit Blog Post' : 'New Blog Post' ?></h1></div>
<div class="card">
  <?php if ($error): ?><div class="alert alert-error"><?= h($error) ?></div><?php endif; ?>
  <form method="post" enctype="multipart/form-data" class="form-grid">
    <input type="hidden" name="id" value="<?= h((string)$id) ?>" />
    <div class="field">
      <label for="title">Title</label>
      <input type="text" id="title" name="title" required value="<?= h($post['title']) ?>" />
    </div>
    <div class="field">
      <label for="category">Category</label>
      <input type="text" id="category" name="category" placeholder="e.g. Fire Safety" value="<?= h($post['category']) ?>" />
    </div>
    <div class="field">
      <label for="post_date">Date</label>
      <input type="date" id="post_date" name="post_date" required value="<?= h($post['post_date']) ?>" />
    </div>
    <div class="field">
      <label for="image">Cover Image <span class="hint">(JPG/PNG/WEBP, max 5MB)</span></label>
      <?php if (!empty($post['image_path'])): ?>
        <div class="current-image"><img src="../<?= h($post['image_path']) ?>" alt="" /><span class="hint">Current image — upload a new one to replace it</span></div>
      <?php endif; ?>
      <input type="file" id="image" name="image" accept="image/*" />
    </div>
    <div class="field">
      <label for="excerpt">Excerpt <span class="hint">(shown on the blog listing / homepage teaser)</span></label>
      <textarea id="excerpt" name="excerpt" style="min-height:70px; font-family:inherit; font-size:14px;"><?= h($post['excerpt']) ?></textarea>
    </div>
    <div class="field">
      <label for="seo_keywords">SEO Keywords <span class="hint">(comma-separated, used in the page's meta keywords &amp; description)</span></label>
      <input type="text" id="seo_keywords" name="seo_keywords" placeholder="e.g. fire safety tips, workplace safety, chennai" value="<?= h($post['seo_keywords']) ?>" />
    </div>
    <div class="field">
      <label for="body">Body Content <span class="hint">(HTML allowed — e.g. &lt;p&gt;, &lt;h3&gt;, &lt;ul&gt;&lt;li&gt;, &lt;strong&gt;)</span></label>
      <textarea id="body" name="body" required><?= h($post['body']) ?></textarea>
    </div>
    <div>
      <button type="submit" class="btn btn-primary">Save Post</button>
      <a href="blogs.php" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>
<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
