<?php

function h(?string $value): string {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function slugify(string $text): string {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    $text = trim($text, '-');
    return $text !== '' ? $text : 'item-' . time();
}

function unique_slug(PDO $pdo, string $table, string $baseSlug, ?int $excludeId = null): string {
    $slug = slugify($baseSlug);
    $original = $slug;
    $i = 2;
    while (true) {
        $sql = "SELECT id FROM {$table} WHERE slug = :slug" . ($excludeId ? " AND id != :id" : "");
        $stmt = $pdo->prepare($sql);
        $params = ['slug' => $slug];
        if ($excludeId) $params['id'] = $excludeId;
        $stmt->execute($params);
        if (!$stmt->fetch()) return $slug;
        $slug = $original . '-' . $i;
        $i++;
    }
}

/**
 * Handles an <input type="file"> upload for an image field.
 * Returns the relative path to store in the DB, or null if no new file
 * was uploaded, or false on error (check upload_error() after calling).
 */
function handle_image_upload(string $fieldName, string $subdir): string|false|null {
    if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] === UPLOAD_ERR_NO_FILE) {
        return null; // no new file selected — keep existing image
    }
    $file = $_FILES[$fieldName];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $GLOBALS['_upload_error'] = 'Upload failed (error code ' . $file['error'] . ').';
        return false;
    }
    if ($file['size'] > MAX_UPLOAD_SIZE) {
        $GLOBALS['_upload_error'] = 'Image is too large. Max size is ' . round(MAX_UPLOAD_SIZE / 1024 / 1024) . 'MB.';
        return false;
    }
    $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/svg+xml' => 'svg'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    if (!isset($allowed[$mime])) {
        $GLOBALS['_upload_error'] = 'Only JPG, PNG, WEBP or SVG images are allowed.';
        return false;
    }
    $ext = $allowed[$mime];
    $filename = bin2hex(random_bytes(8)) . '.' . $ext;
    $destDir = __DIR__ . '/../uploads/' . $subdir;
    if (!is_dir($destDir)) mkdir($destDir, 0755, true);
    $destPath = $destDir . '/' . $filename;
    if (!move_uploaded_file($file['tmp_name'], $destPath)) {
        $GLOBALS['_upload_error'] = 'Could not save the uploaded file.';
        return false;
    }
    return 'uploads/' . $subdir . '/' . $filename;
}

function upload_error(): ?string {
    return $GLOBALS['_upload_error'] ?? null;
}

function redirect(string $url): void {
    header('Location: ' . $url);
    exit;
}

function flash_set(string $message, string $type = 'success'): void {
    $_SESSION['flash'] = ['message' => $message, 'type' => $type];
}

function flash_get(): ?array {
    if (empty($_SESSION['flash'])) return null;
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function format_date_pretty(string $dateStr): string {
    $ts = strtotime($dateStr);
    return $ts ? date('d M Y', $ts) : $dateStr;
}
