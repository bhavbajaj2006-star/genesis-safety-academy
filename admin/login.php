<?php
require_once __DIR__ . '/../includes/auth.php';

if (is_logged_in()) {
    redirect('index.php');
}

if (!admin_account_exists()) {
    redirect('setup.php');
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if (attempt_login($username, $password)) {
        redirect('index.php');
    }
    $error = 'Incorrect username or password.';
}
$justCreated = isset($_GET['created']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Admin Login | Genesis Safety Academy</title>
<link rel="stylesheet" href="admin.css" />
</head>
<body class="login-page">
  <div class="login-card">
    <h1>Admin Login</h1>
    <p class="muted">Genesis Safety Academy content admin.</p>
    <?php if ($justCreated): ?><div class="alert alert-success">Account created. Please log in.</div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-error"><?= h($error) ?></div><?php endif; ?>
    <form method="post">
      <div class="field">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required autofocus />
      </div>
      <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
      </div>
      <button type="submit" class="btn btn-primary">Log In</button>
    </form>
  </div>
</body>
</html>
