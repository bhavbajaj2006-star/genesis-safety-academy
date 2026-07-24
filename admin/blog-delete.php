<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $stmt = db()->prepare('DELETE FROM blog_posts WHERE id = :id');
    $stmt->execute(['id' => (int) $_POST['id']]);
    flash_set('Blog post deleted.', 'success');
}
redirect('blogs.php');
