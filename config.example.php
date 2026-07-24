<?php
/**
 * Copy this file to config.php and fill in your real database credentials.
 * config.php is gitignored on purpose — never commit real DB passwords.
 */
define('DB_HOST', 'localhost');
define('DB_NAME', 'genesis_safety');
define('DB_USER', 'your_db_username');
define('DB_PASS', 'your_db_password');

// Absolute site URL with no trailing slash, e.g. https://genesissafetyindia.com
// Used to build absolute links where needed. Leave blank to use relative paths.
define('SITE_URL', '');

// Max upload size for images, in bytes (default 5 MB)
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024);

// Max upload size for testimonial videos, in bytes (default 20 MB —
// keep this modest on free hosting, which often caps PHP uploads around 20-25MB)
define('MAX_VIDEO_UPLOAD_SIZE', 20 * 1024 * 1024);
