<?php
require_once __DIR__ . '/../includes/auth.php';

// This page only works if no admin account exists yet.
// Once you create your account it locks itself automatically.
if (admin_account_exists()) {
    die('Setup has already been completed. Go to <a href="login.php">login.php</a> to sign in. '
      . 'If you are locked out, ask your developer to remove the admin_users row in the database '
      . 'and reload this page to create a new one.');
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if ($username === '' || strlen($username) < 3) {
        $error = 'Username must be at least 3 characters.';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = db()->prepare('INSERT INTO admin_users (username, password_hash) VALUES (:u, :p)');
        $stmt->execute(['u' => $username, 'p' => $hash]);
        redirect('login.php?created=1');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Create Admin Account | Genesis Safety Academy</title>
<link rel="stylesheet" href="admin.css?v=2" />
</head>
<body class="login-page">
  <div class="login-card">
    <h1>Create Your Admin Account</h1>
    <p class="muted">This runs once. Choose your one login for the whole site — there is no separate signup afterwards.</p>
    <?php if ($error): ?><div class="alert alert-error"><?= h($error) ?></div><?php endif; ?>
    <form method="post">
      <div class="field">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required autofocus />
      </div>
      <div class="field">
        <label for="password">Password <span class="hint">(min. 8 characters)</span></label>
        <input type="password" id="password" name="password" required minlength="8" />
      </div>
      <div class="field">
        <label for="confirm">Confirm Password</label>
        <input type="password" id="confirm" name="confirm" required minlength="8" />
      </div>
      <button type="submit" class="btn btn-primary">Create Account &amp; Continue</button>
    </form>
  </div>
</body>
</html>
