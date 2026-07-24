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
 * Generic upload handler. Returns the relative path to store in the DB,
 * null if no new file was uploaded, or false on error (check upload_error()).
 */
function handle_file_upload(string $fieldName, string $subdir, array $allowedMimes, int $maxSize, string $kindLabel): string|false|null {
    if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] === UPLOAD_ERR_NO_FILE) {
        return null; // no new file selected — keep existing one
    }
    $file = $_FILES[$fieldName];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $GLOBALS['_upload_error'] = 'Upload failed (error code ' . $file['error'] . ').';
        return false;
    }
    if ($file['size'] > $maxSize) {
        $GLOBALS['_upload_error'] = ucfirst($kindLabel) . ' is too large. Max size is ' . round($maxSize / 1024 / 1024) . 'MB.';
        return false;
    }
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    if (!isset($allowedMimes[$mime])) {
        $GLOBALS['_upload_error'] = 'Unsupported ' . $kindLabel . ' format.';
        return false;
    }
    $ext = $allowedMimes[$mime];
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

/**
 * Handles an <input type="file"> upload for an image field.
 * Returns the relative path to store in the DB, or null if no new file
 * was uploaded, or false on error (check upload_error() after calling).
 */
function handle_image_upload(string $fieldName, string $subdir): string|false|null {
    $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/svg+xml' => 'svg'];
    return handle_file_upload($fieldName, $subdir, $allowed, MAX_UPLOAD_SIZE, 'image (JPG, PNG, WEBP or SVG)');
}

/**
 * Handles an <input type="file"> upload for a video field.
 * Returns the relative path to store in the DB, or null if no new file
 * was uploaded, or false on error (check upload_error() after calling).
 */
function handle_video_upload(string $fieldName, string $subdir): string|false|null {
    $allowed = ['video/mp4' => 'mp4', 'video/webm' => 'webm', 'video/ogg' => 'ogv'];
    $maxSize = defined('MAX_VIDEO_UPLOAD_SIZE') ? MAX_VIDEO_UPLOAD_SIZE : (20 * 1024 * 1024);
    return handle_file_upload($fieldName, $subdir, $allowed, $maxSize, 'video (MP4, WEBM or OGG)');
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
