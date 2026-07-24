<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

$id = isset($_GET['id']) ? (int) $_GET['id'] : (isset($_POST['id']) ? (int) $_POST['id'] : null);
$program = ['name' => '', 'modules_text' => '', 'sort_order' => 0];
if ($id) {
    $stmt = db()->prepare('SELECT * FROM corporate_programs WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $found = $stmt->fetch();
    if (!$found) { flash_set('Program not found.', 'error'); redirect('corporate.php'); }
    $program = $found;
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $modules = trim($_POST['modules_text'] ?? '');
    $sortOrder = (int) ($_POST['sort_order'] ?? 0);

    if ($name === '') {
        $error = 'Program name is required.';
    } else {
        $pdo = db();
        if ($id) {
            $stmt = $pdo->prepare('UPDATE corporate_programs SET name=:name, modules_text=:modules_text, sort_order=:sort_order WHERE id=:id');
            $stmt->execute(['name' => $name, 'modules_text' => $modules, 'sort_order' => $sortOrder, 'id' => $id]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO corporate_programs (name, modules_text, sort_order) VALUES (:name, :modules_text, :sort_order)');
            $stmt->execute(['name' => $name, 'modules_text' => $modules, 'sort_order' => $sortOrder]);
        }
        flash_set($id ? 'Program updated.' : 'Program created.', 'success');
        redirect('corporate.php');
    }
}

$pageTitle = $id ? 'Edit Program' : 'New Program';
$activeNav = 'corporate';
require __DIR__ . '/includes/layout-top.php';
?>
<div class="admin-topbar"><h1><?= $id ? 'Edit Program' : 'New Corporate Program' ?></h1></div>
<div class="card">
  <?php if ($error): ?><div class="alert alert-error"><?= h($error) ?></div><?php endif; ?>
  <form method="post" class="form-grid">
    <input type="hidden" name="id" value="<?= h((string)$id) ?>" />
    <div class="field">
      <label for="name">Program Name</label>
      <input type="text" id="name" name="name" required value="<?= h($program['name']) ?>" />
    </div>
    <div class="field">
      <label for="modules_text">Training Modules <span class="hint">optional — shown when expanded, use the toolbar to format</span></label>
      <textarea id="modules_text" name="modules_text" data-rich-editor><?= h($program['modules_text']) ?></textarea>
    </div>
    <div class="field">
      <label for="sort_order">Display Order <span class="hint">(lower numbers show first)</span></label>
      <input type="number" id="sort_order" name="sort_order" value="<?= (int)$program['sort_order'] ?>" />
    </div>
    <div>
      <button type="submit" class="btn btn-primary">Save Program</button>
      <a href="corporate.php" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>
<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
