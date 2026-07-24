<?php
/**
 * Shared site header/nav, included by every dynamic .php page.
 * Expects (optional): $pageTitle, $pageDescription, $cssVersion, $jsVersion
 */
$pageTitle = $pageTitle ?? 'Genesis Safety Academy';
$pageDescription = $pageDescription ?? "Genesis Safety Academy, Chennai — Fire, Industrial, Construction, Chemical & Environmental Safety courses, corporate training, certifications and safety products.";
$cssVersion = $cssVersion ?? '70';
$jsVersion = $jsVersion ?? '12';
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?= h($pageTitle) ?></title>
<meta name="description" content="<?= h($pageDescription) ?>" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles.css?v=<?= h($cssVersion) ?>" />
</head>
<body>

<!-- ══ UTILITY BAR ══ -->
<div class="utility-bar">
  <div class="container utility-inner">
    <a href="mailto:info@genesissafetyindia.com" class="utility-link">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="4" width="20" height="16" rx="1"/><path d="m2 6 10 7L22 6"/></svg>
      info@genesissafetyindia.com
    </a>
    <span class="utility-link utility-phones">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8.1 9.6a16 16 0 0 0 6 6l1.1-1.1a2 2 0 0 1 2.1-.5c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2Z"/></svg>
      <a href="tel:+919342670267">+91 93426 70267</a>
      <span class="utility-phone-sep">/</span>
      <a href="tel:+914431328393">044-31328393</a>
    </span>
    <div class="utility-right">
      <span class="utility-loc">Chennai, India</span>
      <span class="utility-social">
        <a href="https://www.facebook.com/people/Genesis-Safety-Academy/61566034935865/" target="_blank" rel="noopener" aria-label="Facebook"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M14 9h3V6h-3c-1.7 0-3 1.3-3 3v2H9v3h2v6h3v-6h2.5l.5-3H14V9Z"/></svg></a>
        <a href="https://in.linkedin.com/company/genesis-academy-chennai" target="_blank" rel="noopener" aria-label="LinkedIn"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M6.5 8A1.5 1.5 0 1 0 6.5 5a1.5 1.5 0 0 0 0 3ZM5 10h3v9H5v-9Zm5 0h3v1.3c.5-.8 1.5-1.5 2.8-1.5 2 0 3.2 1.3 3.2 3.7V19h-3v-4.6c0-1.1-.4-1.8-1.4-1.8s-1.6.7-1.6 1.8V19h-3v-9Z"/></svg></a>
        <a href="https://www.instagram.com/genesis.safety.academy/" target="_blank" rel="noopener" aria-label="Instagram"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg></a>
        <a href="https://www.youtube.com/@genesissafety" target="_blank" rel="noopener" aria-label="YouTube"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M22 8.2a3 3 0 0 0-2.1-2.1C18 5.6 12 5.6 12 5.6s-6 0-7.9.5A3 3 0 0 0 2 8.2 31 31 0 0 0 1.6 12 31 31 0 0 0 2 15.8a3 3 0 0 0 2.1 2.1c1.9.5 7.9.5 7.9.5s6 0 7.9-.5a3 3 0 0 0 2.1-2.1A31 31 0 0 0 22.4 12 31 31 0 0 0 22 8.2ZM10 15V9l5 3-5 3Z"/></svg></a>
      </span>
    </div>
  </div>
</div>

<!-- ══ HEADER ══ -->
<header class="site-header" id="siteHeader">
  <div class="container nav-inner">
    <div class="brand-group">
    <a href="index.php" class="logo">
      <img src="images/brand/genesis-logo.png?v=2" alt="Genesis Safety Academy" class="logo-img" />
    </a>
    <div class="header-badges">
      <span class="header-badges-label">Accreditations</span>
      <div class="header-badges-row">
      <img src="images/brand/accreditation-cvesd.jpg" alt="CVESD - Council for Vocational Education and Skill Development accreditation" class="header-badge-img" />
      <img src="images/brand/accreditation-iao.jpg" alt="IAO - International Accreditation Organization" class="header-badge-img" />
      </div>
    </div>
    </div>
    <nav class="main-nav" id="mainNav">
      <div class="mobile-nav-head">
        <img src="images/brand/genesis-logo.png?v=2" alt="Genesis Safety Academy" class="mobile-nav-logo" />
        <button class="nav-close" id="navClose" aria-label="Close menu">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
      </div>
      <div class="mobile-nav-links">
        <a href="index.php"><span>Home</span><svg class="nav-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 6l6 6-6 6"/></svg></a>
        <a href="about.html"><span>About Us</span><svg class="nav-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 6l6 6-6 6"/></svg></a>
        <a href="courses.php"><span>Courses</span><svg class="nav-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 6l6 6-6 6"/></svg></a>
        <a href="corporate.php"><span>Corporate Trainings</span><svg class="nav-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 6l6 6-6 6"/></svg></a>
        <a href="gallery.php"><span>Gallery</span><svg class="nav-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 6l6 6-6 6"/></svg></a>
        <a href="blog.php"><span>Blog</span><svg class="nav-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 6l6 6-6 6"/></svg></a>
        <a href="contact.html"><span>Contact Us</span><svg class="nav-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 6l6 6-6 6"/></svg></a>
      </div>
      <div class="mobile-nav-footer">
        <a href="enquiry.html" class="btn btn-flame full-width mobile-nav-cta">
          Enquire Now
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
        <div class="mobile-nav-contact">
          <a href="tel:+919342670267">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8.1 9.6a16 16 0 0 0 6 6l1.1-1.1a2 2 0 0 1 2.1-.5c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2Z"/></svg>
            +91 93426 70267 / 044-31328393
          </a>
          <a href="mailto:info@genesissafetyindia.com">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="4" width="20" height="16" rx="1"/><path d="m2 6 10 7L22 6"/></svg>
            info@genesissafetyindia.com
          </a>
        </div>
      </div>
    </nav>
    <a href="enquiry.html" class="btn btn-flame nav-cta">
      Enquire Now
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
    </a>
    <button class="hamburger" id="hamburger" aria-label="Toggle menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>
<div class="nav-backdrop" id="navBackdrop"></div>
