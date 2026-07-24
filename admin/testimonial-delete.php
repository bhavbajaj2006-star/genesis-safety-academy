<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $stmt = db()->prepare('DELETE FROM testimonials WHERE id = :id');
    $stmt->execute(['id' => (int) $_POST['id']]);
    flash_set('Testimonial deleted.', 'success');
}
redirect('testimonials.php');
