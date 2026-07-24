<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

$courses = db()->query('SELECT * FROM courses ORDER BY sort_order ASC, id ASC')->fetchAll();

$pageTitle = 'Courses';
$activeNav = 'courses';
require __DIR__ . '/includes/layout-top.php';
?>
<div class="admin-topbar">
  <h1>Courses</h1>
  <a href="course-form.php" class="btn btn-primary">+ New Course</a>
</div>
<div class="card">
  <table>
    <thead><tr><th></th><th>Name</th><th>Tag</th><th>Order</th><th></th></tr></thead>
    <tbody>
      <?php if (!$courses): ?>
        <tr class="empty-row"><td colspan="5">No courses yet. Click "New Course" to add one.</td></tr>
      <?php endif; ?>
      <?php foreach ($courses as $c): ?>
        <tr>
          <td><img class="table-thumb" src="../<?= h($c['image_path'] ?: 'images/brand/genesis-logo.png') ?>" alt="" /></td>
          <td><?= h($c['name']) ?><?= $c['featured'] ? ' <span class="hint">(featured)</span>' : '' ?></td>
          <td><?= h($c['tag']) ?></td>
          <td><?= (int)$c['sort_order'] ?></td>
          <td class="table-actions">
            <a class="btn btn-secondary btn-sm" href="../course.php?slug=<?= urlencode($c['slug']) ?>" target="_blank">View</a>
            <a class="btn btn-secondary btn-sm" href="course-form.php?id=<?= $c['id'] ?>">Edit</a>
            <form method="post" action="course-delete.php" onsubmit="return confirm('Delete this course? This cannot be undone.');" style="display:inline">
              <input type="hidden" name="id" value="<?= $c['id'] ?>" />
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
