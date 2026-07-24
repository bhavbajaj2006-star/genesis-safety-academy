<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

$programs = db()->query('SELECT * FROM corporate_programs ORDER BY sort_order ASC, id ASC')->fetchAll();

$pageTitle = 'Corporate Programs';
$activeNav = 'corporate';
require __DIR__ . '/includes/layout-top.php';
?>
<div class="admin-topbar">
  <h1>Corporate Training Programs</h1>
  <a href="corporate-form.php" class="btn btn-primary">+ New Program</a>
</div>
<div class="card">
  <table>
    <thead><tr><th>#</th><th>Program Name</th><th>Order</th><th></th></tr></thead>
    <tbody>
      <?php if (!$programs): ?>
        <tr class="empty-row"><td colspan="4">No corporate programs yet. Click "New Program" to add one.</td></tr>
      <?php endif; ?>
      <?php foreach ($programs as $i => $p): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= h($p['name']) ?></td>
          <td><?= (int)$p['sort_order'] ?></td>
          <td class="table-actions">
            <a class="btn btn-secondary btn-sm" href="corporate-form.php?id=<?= $p['id'] ?>">Edit</a>
            <form method="post" action="corporate-delete.php" onsubmit="return confirm('Delete this program? This cannot be undone.');" style="display:inline">
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
