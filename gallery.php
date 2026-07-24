<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$photos = db()->query('SELECT * FROM gallery_photos ORDER BY sort_order ASC, id ASC')->fetchAll();

$pageTitle = 'Gallery | Genesis Safety Academy';
$pageDescription = 'Genesis Safety Academy corporate training gallery — photos from on-site safety training programs delivered for our clients.';
require __DIR__ . '/includes/site-header.php';
?>

<!-- ══ PAGE HEADER ══ -->
<section class="page-header">
  <div class="container">
    <span class="eyebrow">Genesis Safety Academy</span>
    <h1>Corporate training, on site.</h1>
  </div>
</section>

<!-- ══ GALLERY ══ -->
<section class="gallery">
  <div class="section-head-center">
    <span class="eyebrow eyebrow-flame">Gallery</span>
    <h2>Training delivered for our clients</h2>
    <p class="section-note gallery-note" style="margin:0 auto">Click any photo to view it full-size. Locations reflect Genesis Safety Academy's Chennai base of operations.</p>
  </div>

  <div class="gallery-toolbar">
    <span class="gallery-count"><strong id="galleryCount"><?= count($photos) ?></strong> client sites shown</span>
    <span class="gallery-hint">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
      Click or tap a photo to enlarge
    </span>
  </div>

  <div class="gallery-grid">
    <?php if (!$photos): ?>
      <p class="section-note">No gallery photos yet.</p>
    <?php endif; ?>
    <?php foreach ($photos as $i => $p): ?>
      <button type="button" class="gallery-item" data-name="<?= h($p['company_name']) ?>" data-location="<?= h($p['location']) ?>">
        <img src="<?= h($p['image_path']) ?>" alt="Genesis Safety Academy training at <?= h($p['company_name']) ?>" <?= $i === 0 ? 'loading="eager"' : 'loading="lazy"' ?> />
        <span class="gallery-item-caption">
          <span class="gallery-item-name"><?= h($p['company_name']) ?></span>
          <span class="gallery-item-loc">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21s7-6.7 7-12a7 7 0 1 0-14 0c0 5.3 7 12 7 12ZM12 11a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/></svg>
            <?= h($p['location']) ?>
          </span>
        </span>
      </button>
    <?php endforeach; ?>
  </div>
</section>

<!-- ══ LIGHTBOX ══ -->
<div class="lightbox" id="lightbox" hidden>
  <button class="lightbox-close" id="lightboxClose" aria-label="Close">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18"/></svg>
  </button>
  <button class="lightbox-nav" id="lightboxPrev" aria-label="Previous photo">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
  </button>
  <div class="lightbox-content">
    <img class="lightbox-image" id="lightboxImage" src="" alt="" />
    <div class="lightbox-caption">
      <span class="lightbox-caption-name" id="lightboxName"></span>
      <span class="lightbox-caption-loc">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21s7-6.7 7-12a7 7 0 1 0-14 0c0 5.3 7 12 7 12ZM12 11a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/></svg>
        <span id="lightboxLoc"></span>
      </span>
    </div>
  </div>
  <button class="lightbox-nav" id="lightboxNext" aria-label="Next photo">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
  </button>
</div>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
