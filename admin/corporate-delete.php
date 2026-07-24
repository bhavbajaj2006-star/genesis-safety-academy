<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $stmt = db()->prepare('DELETE FROM corporate_programs WHERE id = :id');
    $stmt->execute(['id' => (int) $_POST['id']]);
    flash_set('Program deleted.', 'success');
}
redirect('corporate.php');
