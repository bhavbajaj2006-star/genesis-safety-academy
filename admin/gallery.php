<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

$photos = db()->query('SELECT * FROM gallery_photos ORDER BY sort_order ASC, id ASC')->fetchAll();

$pageTitle = 'Gallery Photos';
$activeNav = 'gallery';
require __DIR__ . '/includes/layout-top.php';
?>
<div class="admin-topbar">
  <h1>Gallery Photos</h1>
  <a href="gallery-form.php" class="btn btn-primary">+ New Photo</a>
</div>
<div class="card">
  <table>
    <thead><tr><th></th><th>Company</th><th>Location</th><th>Order</th><th></th></tr></thead>
    <tbody>
      <?php if (!$photos): ?>
        <tr class="empty-row"><td colspan="5">No gallery photos yet. Click "New Photo" to add one.</td></tr>
      <?php endif; ?>
      <?php foreach ($photos as $p): ?>
        <tr>
          <td><img class="table-thumb" src="../<?= h($p['image_path']) ?>" alt="" /></td>
          <td><?= h($p['company_name']) ?></td>
          <td><?= h($p['location']) ?></td>
          <td><?= (int)$p['sort_order'] ?></td>
          <td class="table-actions">
            <a class="btn btn-secondary btn-sm" href="gallery-form.php?id=<?= $p['id'] ?>">Edit</a>
            <form method="post" action="gallery-delete.php" onsubmit="return confirm('Delete this photo? This cannot be undone.');" style="display:inline">
              <input type="hidden" name="id" value="<?= $p['id'] ?>" />
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
