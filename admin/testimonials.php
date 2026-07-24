<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

$testimonials = db()->query('SELECT * FROM testimonials ORDER BY type ASC, sort_order ASC, id ASC')->fetchAll();

$pageTitle = 'Testimonials';
$activeNav = 'testimonials';
require __DIR__ . '/includes/layout-top.php';
?>
<div class="admin-topbar">
  <h1>Testimonials</h1>
  <a href="testimonial-form.php" class="btn btn-primary">+ New Testimonial</a>
</div>
<div class="card">
  <table>
    <thead><tr><th></th><th>Type</th><th>Quote</th><th>Author</th><th></th></tr></thead>
    <tbody>
      <?php if (!$testimonials): ?>
        <tr class="empty-row"><td colspan="5">No testimonials yet. Click "New Testimonial" to add one.</td></tr>
      <?php endif; ?>
      <?php foreach ($testimonials as $t): ?>
        <tr>
          <td>
            <?php if (!empty($t['logo_path'])): ?>
              <img class="table-thumb" src="../<?= h($t['logo_path']) ?>" alt="" style="object-fit:contain; background:#eef2f7;" />
            <?php else: ?>
              <span class="table-thumb" style="display:grid; place-items:center; background:#051733; color:#fff; font-weight:700;"><?= h($t['avatar_initials'] ?: '?') ?></span>
            <?php endif; ?>
          </td>
          <td><?= h(ucfirst($t['type'])) ?></td>
          <td style="max-width:340px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"><?= h($t['quote']) ?></td>
          <td><?= h($t['author_name']) ?><br /><span class="hint"><?= h($t['author_meta']) ?></span></td>
          <td class="table-actions">
            <a class="btn btn-secondary btn-sm" href="testimonial-form.php?id=<?= $t['id'] ?>">Edit</a>
            <form method="post" action="testimonial-delete.php" onsubmit="return confirm('Delete this testimonial? This cannot be undone.');" style="display:inline">
              <input type="hidden" name="id" value="<?= $t['id'] ?>" />
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
