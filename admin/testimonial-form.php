<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

$id = isset($_GET['id']) ? (int) $_GET['id'] : (isset($_POST['id']) ? (int) $_POST['id'] : null);
$t = ['type' => 'corporate', 'quote' => '', 'author_name' => '', 'author_meta' => '', 'avatar_initials' => '', 'logo_path' => '', 'sort_order' => 0];
if ($id) {
    $stmt = db()->prepare('SELECT * FROM testimonials WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $found = $stmt->fetch();
    if (!$found) { flash_set('Testimonial not found.', 'error'); redirect('testimonials.php'); }
    $t = $found;
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = ($_POST['type'] ?? 'corporate') === 'student' ? 'student' : 'corporate';
    $quote = trim($_POST['quote'] ?? '');
    $authorName = trim($_POST['author_name'] ?? '');
    $authorMeta = trim($_POST['author_meta'] ?? '');
    $avatarInitials = trim($_POST['avatar_initials'] ?? '');
    $sortOrder = (int) ($_POST['sort_order'] ?? 0);

    if ($quote === '' || $authorName === '') {
        $error = 'Quote and author name are required.';
    } else {
        $logoPath = handle_image_upload('logo', 'testimonials');
        if ($logoPath === false) {
            $error = upload_error();
        } else {
            $pdo = db();
            if ($id) {
                $sql = 'UPDATE testimonials SET type=:type, quote=:quote, author_name=:author_name, author_meta=:author_meta, avatar_initials=:avatar_initials, sort_order=:sort_order' .
                       ($logoPath ? ', logo_path=:logo_path' : '') . ' WHERE id=:id';
                $params = ['type' => $type, 'quote' => $quote, 'author_name' => $authorName, 'author_meta' => $authorMeta, 'avatar_initials' => $avatarInitials, 'sort_order' => $sortOrder, 'id' => $id];
                if ($logoPath) $params['logo_path'] = $logoPath;
            } else {
                $sql = 'INSERT INTO testimonials (type, quote, author_name, author_meta, avatar_initials, sort_order, logo_path) VALUES (:type, :quote, :author_name, :author_meta, :avatar_initials, :sort_order, :logo_path)';
                $params = ['type' => $type, 'quote' => $quote, 'author_name' => $authorName, 'author_meta' => $authorMeta, 'avatar_initials' => $avatarInitials, 'sort_order' => $sortOrder, 'logo_path' => $logoPath ?: null];
            }
            $pdo->prepare($sql)->execute($params);
            flash_set($id ? 'Testimonial updated.' : 'Testimonial created.', 'success');
            redirect('testimonials.php');
        }
    }
}

$pageTitle = $id ? 'Edit Testimonial' : 'New Testimonial';
$activeNav = 'testimonials';
require __DIR__ . '/includes/layout-top.php';
?>
<div class="admin-topbar"><h1><?= $id ? 'Edit Testimonial' : 'New Testimonial' ?></h1></div>
<div class="card">
  <?php if ($error): ?><div class="alert alert-error"><?= h($error) ?></div><?php endif; ?>
  <form method="post" enctype="multipart/form-data" class="form-grid">
    <input type="hidden" name="id" value="<?= h((string)$id) ?>" />
    <div class="field">
      <label for="type">Type</label>
      <select id="type" name="type">
        <option value="corporate" <?= $t['type'] === 'corporate' ? 'selected' : '' ?>>Corporate</option>
        <option value="student" <?= $t['type'] === 'student' ? 'selected' : '' ?>>Student</option>
      </select>
    </div>
    <div class="field">
      <label for="quote">Quote</label>
      <textarea id="quote" name="quote" required style="min-height:90px; font-family:inherit; font-size:14px;"><?= h($t['quote']) ?></textarea>
    </div>
    <div class="field">
      <label for="author_name">Author Name / Role <span class="hint">(e.g. "HSE Manager" or a course name)</span></label>
      <input type="text" id="author_name" name="author_name" required value="<?= h($t['author_name']) ?>" />
    </div>
    <div class="field">
      <label for="author_meta">Company / Location <span class="hint">(e.g. "TVS Warehouse, Chennai")</span></label>
      <input type="text" id="author_meta" name="author_meta" value="<?= h($t['author_meta']) ?>" />
    </div>
    <div class="field">
      <label for="avatar_initials">Avatar Initials <span class="hint">(shown if no logo is uploaded, max 4 characters)</span></label>
      <input type="text" id="avatar_initials" name="avatar_initials" maxlength="4" value="<?= h($t['avatar_initials']) ?>" />
    </div>
    <div class="field">
      <label for="logo">Company Logo <span class="hint">(optional — corporate testimonials only, JPG/PNG/WEBP/SVG)</span></label>
      <?php if (!empty($t['logo_path'])): ?>
        <div class="current-image"><img src="../<?= h($t['logo_path']) ?>" alt="" style="object-fit:contain;" /><span class="hint">Current logo — upload a new one to replace it</span></div>
      <?php endif; ?>
      <input type="file" id="logo" name="logo" accept="image/*" />
    </div>
    <div class="field">
      <label for="sort_order">Display Order</label>
      <input type="number" id="sort_order" name="sort_order" value="<?= (int)$t['sort_order'] ?>" />
    </div>
    <div>
      <button type="submit" class="btn btn-primary">Save Testimonial</button>
      <a href="testimonials.php" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>
<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
