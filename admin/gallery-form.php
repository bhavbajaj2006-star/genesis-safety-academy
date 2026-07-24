<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

$id = isset($_GET['id']) ? (int) $_GET['id'] : (isset($_POST['id']) ? (int) $_POST['id'] : null);
$photo = ['company_name' => '', 'location' => 'Chennai, India', 'image_path' => '', 'sort_order' => 0];
if ($id) {
    $stmt = db()->prepare('SELECT * FROM gallery_photos WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $found = $stmt->fetch();
    if (!$found) { flash_set('Photo not found.', 'error'); redirect('gallery.php'); }
    $photo = $found;
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $companyName = trim($_POST['company_name'] ?? '');
    $location = trim($_POST['location'] ?? 'Chennai, India');
    $sortOrder = (int) ($_POST['sort_order'] ?? 0);

    if ($companyName === '') {
        $error = 'Company name is required.';
    } elseif (!$id && (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE)) {
        $error = 'Please choose a photo to upload.';
    } else {
        $imagePath = handle_image_upload('image', 'gallery');
        if ($imagePath === false) {
            $error = upload_error();
        } else {
            $pdo = db();
            if ($id) {
                $sql = 'UPDATE gallery_photos SET company_name=:company_name, location=:location, sort_order=:sort_order' .
                       ($imagePath ? ', image_path=:image_path' : '') . ' WHERE id=:id';
                $params = ['company_name' => $companyName, 'location' => $location, 'sort_order' => $sortOrder, 'id' => $id];
                if ($imagePath) $params['image_path'] = $imagePath;
            } else {
                $sql = 'INSERT INTO gallery_photos (company_name, location, sort_order, image_path) VALUES (:company_name, :location, :sort_order, :image_path)';
                $params = ['company_name' => $companyName, 'location' => $location, 'sort_order' => $sortOrder, 'image_path' => $imagePath];
            }
            $pdo->prepare($sql)->execute($params);
            flash_set($id ? 'Photo updated.' : 'Photo added.', 'success');
            redirect('gallery.php');
        }
    }
}

$pageTitle = $id ? 'Edit Photo' : 'New Photo';
$activeNav = 'gallery';
require __DIR__ . '/includes/layout-top.php';
?>
<div class="admin-topbar"><h1><?= $id ? 'Edit Photo' : 'New Gallery Photo' ?></h1></div>
<div class="card">
  <?php if ($error): ?><div class="alert alert-error"><?= h($error) ?></div><?php endif; ?>
  <form method="post" enctype="multipart/form-data" class="form-grid">
    <input type="hidden" name="id" value="<?= h((string)$id) ?>" />
    <div class="field">
      <label for="company_name">Company Name</label>
      <input type="text" id="company_name" name="company_name" required value="<?= h($photo['company_name']) ?>" />
    </div>
    <div class="field">
      <label for="location">Location</label>
      <input type="text" id="location" name="location" value="<?= h($photo['location']) ?>" />
    </div>
    <div class="field">
      <label for="image">Photo <span class="hint">(JPG/PNG/WEBP, max 5MB)</span></label>
      <?php if (!empty($photo['image_path'])): ?>
        <div class="current-image"><img src="../<?= h($photo['image_path']) ?>" alt="" /><span class="hint">Current photo — upload a new one to replace it</span></div>
      <?php endif; ?>
      <input type="file" id="image" name="image" accept="image/*" <?= $id ? '' : 'required' ?> />
    </div>
    <div class="field">
      <label for="sort_order">Display Order</label>
      <input type="number" id="sort_order" name="sort_order" value="<?= (int)$photo['sort_order'] ?>" />
    </div>
    <div>
      <button type="submit" class="btn btn-primary">Save Photo</button>
      <a href="gallery.php" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>
<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
