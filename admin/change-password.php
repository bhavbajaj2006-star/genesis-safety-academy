<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    $stmt = db()->prepare('SELECT password_hash FROM admin_users WHERE id = :id');
    $stmt->execute(['id' => $_SESSION['admin_id']]);
    $row = $stmt->fetch();

    if (!$row || !password_verify($current, $row['password_hash'])) {
        $error = 'Current password is incorrect.';
    } elseif (strlen($new) < 8) {
        $error = 'New password must be at least 8 characters.';
    } elseif ($new !== $confirm) {
        $error = 'New passwords do not match.';
    } else {
        $hash = password_hash($new, PASSWORD_DEFAULT);
        $upd = db()->prepare('UPDATE admin_users SET password_hash = :h WHERE id = :id');
        $upd->execute(['h' => $hash, 'id' => $_SESSION['admin_id']]);
        flash_set('Password updated.', 'success');
        redirect('index.php');
    }
}

$pageTitle = 'Change Password';
$activeNav = '';
require __DIR__ . '/includes/layout-top.php';
?>
<div class="admin-topbar"><h1>Change Password</h1></div>
<div class="card" style="max-width:480px">
  <?php if ($error): ?><div class="alert alert-error"><?= h($error) ?></div><?php endif; ?>
  <form method="post" class="form-grid">
    <div class="field">
      <label for="current_password">Current Password</label>
      <input type="password" id="current_password" name="current_password" required />
    </div>
    <div class="field">
      <label for="new_password">New Password</label>
      <input type="password" id="new_password" name="new_password" required minlength="8" />
    </div>
    <div class="field">
      <label for="confirm_password">Confirm New Password</label>
      <input type="password" id="confirm_password" name="confirm_password" required minlength="8" />
    </div>
    <button type="submit" class="btn btn-primary">Update Password</button>
  </form>
</div>
<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
