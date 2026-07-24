<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

$id = isset($_GET['id']) ? (int) $_GET['id'] : (isset($_POST['id']) ? (int) $_POST['id'] : null);
$course = ['name' => '', 'tag' => 'Certificate', 'duration_text' => '', 'lead_text' => '', 'modules_text' => '', 'image_path' => '', 'featured' => 0, 'sort_order' => 0];
if ($id) {
    $stmt = db()->prepare('SELECT * FROM courses WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $found = $stmt->fetch();
    if (!$found) { flash_set('Course not found.', 'error'); redirect('courses.php'); }
    $course = $found;
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $tag = trim($_POST['tag'] ?? 'Certificate');
    $duration = trim($_POST['duration_text'] ?? '');
    $lead = trim($_POST['lead_text'] ?? '');
    $modules = trim($_POST['modules_text'] ?? '');
    $featured = isset($_POST['featured']) ? 1 : 0;
    $sortOrder = (int) ($_POST['sort_order'] ?? 0);

    if ($name === '') {
        $error = 'Course name is required.';
    } else {
        $imagePath = handle_image_upload('image', 'courses');
        if ($imagePath === false) {
            $error = upload_error();
        } else {
            $pdo = db();
            $slug = $id ? $course['slug'] : unique_slug($pdo, 'courses', $name, $id);
            if ($id) {
                $sql = 'UPDATE courses SET name=:name, slug=:slug, tag=:tag, duration_text=:duration_text, lead_text=:lead_text, modules_text=:modules_text, featured=:featured, sort_order=:sort_order' .
                       ($imagePath ? ', image_path=:image_path' : '') . ' WHERE id=:id';
                $params = compact('name', 'slug', 'tag', 'duration', 'lead', 'modules', 'featured', 'sortOrder', 'id');
                $params = ['name' => $name, 'slug' => $slug, 'tag' => $tag, 'duration_text' => $duration, 'lead_text' => $lead, 'modules_text' => $modules, 'featured' => $featured, 'sort_order' => $sortOrder, 'id' => $id];
                if ($imagePath) $params['image_path'] = $imagePath;
            } else {
                $sql = 'INSERT INTO courses (name, slug, tag, duration_text, lead_text, modules_text, featured, sort_order, image_path) VALUES (:name, :slug, :tag, :duration_text, :lead_text, :modules_text, :featured, :sort_order, :image_path)';
                $params = ['name' => $name, 'slug' => $slug, 'tag' => $tag, 'duration_text' => $duration, 'lead_text' => $lead, 'modules_text' => $modules, 'featured' => $featured, 'sort_order' => $sortOrder, 'image_path' => $imagePath ?: null];
            }
            $pdo->prepare($sql)->execute($params);
            flash_set($id ? 'Course updated.' : 'Course created.', 'success');
            redirect('courses.php');
        }
    }
}

$pageTitle = $id ? 'Edit Course' : 'New Course';
$activeNav = 'courses';
require __DIR__ . '/includes/layout-top.php';
?>
<div class="admin-topbar"><h1><?= $id ? 'Edit Course' : 'New Course' ?></h1></div>
<div class="card">
  <?php if ($error): ?><div class="alert alert-error"><?= h($error) ?></div><?php endif; ?>
  <form method="post" enctype="multipart/form-data" class="form-grid">
    <input type="hidden" name="id" value="<?= h((string)$id) ?>" />
    <div class="field">
      <label for="name">Course Name</label>
      <input type="text" id="name" name="name" required value="<?= h($course['name']) ?>" />
    </div>
    <div class="field">
      <label for="tag">Type</label>
      <select id="tag" name="tag">
        <option value="Certificate" <?= $course['tag'] === 'Certificate' ? 'selected' : '' ?>>Certificate</option>
        <option value="Diploma" <?= $course['tag'] === 'Diploma' ? 'selected' : '' ?>>Diploma</option>
      </select>
    </div>
    <div class="field">
      <label for="duration_text">Duration Text</label>
      <input type="text" id="duration_text" name="duration_text" placeholder="e.g. 45 hrs total · 2.5 hrs/day · 3 days/week" value="<?= h($course['duration_text']) ?>" />
    </div>
    <div class="field">
      <label for="image">Course Image <span class="hint">(JPG/PNG/WEBP, max 5MB)</span></label>
      <?php if (!empty($course['image_path'])): ?>
        <div class="current-image"><img src="../<?= h($course['image_path']) ?>" alt="" /><span class="hint">Current image — upload a new one to replace it</span></div>
      <?php endif; ?>
      <input type="file" id="image" name="image" accept="image/*" />
    </div>
    <div class="field">
      <label for="lead_text">Lead / Modules Description</label>
      <textarea id="lead_text" name="lead_text" style="min-height:90px; font-family:inherit; font-size:14px;"><?= h($course['lead_text']) ?></textarea>
    </div>
    <div class="field">
      <label for="modules_text">Full Syllabus / Modules <span class="hint">optional — use the toolbar to format</span></label>
      <textarea id="modules_text" name="modules_text" data-rich-editor><?= h($course['modules_text']) ?></textarea>
    </div>
    <div class="field">
      <label for="sort_order">Display Order <span class="hint">(lower numbers show first)</span></label>
      <input type="number" id="sort_order" name="sort_order" value="<?= (int)$course['sort_order'] ?>" />
    </div>
    <div class="field">
      <label><input type="checkbox" name="featured" <?= $course['featured'] ? 'checked' : '' ?> style="width:auto; margin-right:8px;" />Feature this course (highlighted styling on the courses page)</label>
    </div>
    <div>
      <button type="submit" class="btn btn-primary">Save Course</button>
      <a href="courses.php" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>
<?php require __DIR__ . '/includes/layout-bottom.php'; ?>
