<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$programs = db()->query('SELECT * FROM corporate_programs ORDER BY sort_order ASC, id ASC')->fetchAll();

$pageTitle = 'Corporate Trainings | Genesis Safety Academy';
$pageDescription = 'Genesis Safety Academy corporate training programs — safety training and industrial safety audits delivered on-site.';
require __DIR__ . '/includes/site-header.php';
?>

<!-- ══ PAGE HEADER ══ -->
<section class="page-header">
  <div class="container">
    <span class="eyebrow">Genesis Safety Academy</span>
    <h1>Corporate Company Safety Training &amp; Industrial Safety Audit</h1>
  </div>
</section>

<!-- ══ INTRO / WHY SAFETY MATTERS ══ -->
<section class="corp-intro">
  <span class="eyebrow eyebrow-flame">Why It Matters</span>
  <h2>Workplace safety is a business fundamental, not a checkbox.</h2>
  <p>In today's fast-paced corporate environment, protecting employee well-being is more than a regulatory obligation — it's core to how a responsible business operates. Our Corporate Safety Training and Industrial Safety Audit services help organisations maintain a secure workplace, comply with industry standards, and build a genuine culture of safety at every level.</p>
  <p>Accidents and hazards disrupt operations, drive up costs and damage reputation. Proactive training and regular audits let you identify and fix risks before they become costly incidents.</p>
</section>

<!-- ══ OUR SERVICES ══ -->
<section class="service-grid">
  <div class="service-card">
    <div class="service-card-icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <h3>Corporate Safety Training</h3>
    <p>Tailored training programs that equip employees at every level — from entry-level staff to senior management — with the knowledge to prevent accidents and respond effectively to emergencies.</p>

    <h4>Training Methods</h4>
    <ul class="service-list">
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>In-person instructor-led sessions</li>
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>Online interactive courses</li>
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>Blended learning (in-person + online)</li>
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>On-site, role-specific training for your industry</li>
    </ul>

    <h4>Benefits</h4>
    <ul class="service-list">
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>Reduced workplace accidents &amp; injuries</li>
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>Increased employee awareness &amp; accountability</li>
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>Enhanced productivity &amp; operational efficiency</li>
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>Compliance with industry regulations &amp; standards</li>
    </ul>
  </div>

  <div class="service-card">
    <div class="service-card-icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m9 11 3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
    </div>
    <h3>Industrial Safety Audit</h3>
    <p>A thorough, on-site review of your company's safety protocols, processes and infrastructure — identifying hazards and gaps so you can build a safer working environment.</p>

    <h4>Key Elements</h4>
    <ul class="service-list">
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>On-site inspection of facilities, equipment &amp; processes</li>
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>Review of safety policies, procedures &amp; documentation</li>
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>Gap analysis against OSHA, ISO &amp; other standards</li>
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>Detailed audit report with actionable recommendations</li>
    </ul>

    <h4>Our Process</h4>
    <ul class="service-list">
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>Pre-audit consultation on your operations &amp; concerns</li>
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>On-site assessment of facilities &amp; practices</li>
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>Data analysis &amp; audit report delivery</li>
      <li><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="m5 12 4 4 10-10"/></svg>Follow-up support implementing corrective actions</li>
    </ul>
  </div>
</section>

<!-- ══ INDUSTRIES WE SERVE ══ -->
<section class="industry-section">
  <div class="section-head-center">
    <span class="eyebrow eyebrow-flame">Who We Work With</span>
    <h2>Industries We Serve</h2>
  </div>
  <div class="industry-grid">
    <div class="industry-chip">
      <span class="industry-chip-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 20h20M4 20V10l5-4v4l5-4v4l5-4v14"/></svg></span>
      <span>Manufacturing &amp; Production</span>
    </div>
    <div class="industry-chip">
      <span class="industry-chip-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 21h19M4 21V9l7-5 7 5v12M9 21v-6h4v6"/></svg></span>
      <span>Construction &amp; Engineering</span>
    </div>
    <div class="industry-chip">
      <span class="industry-chip-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="7" width="15" height="12" rx="1"/><path d="M16 11h4l3 4v4h-7z"/><circle cx="5.5" cy="19.5" r="1.5"/><circle cx="17.5" cy="19.5" r="1.5"/></svg></span>
      <span>Warehousing &amp; Logistics</span>
    </div>
    <div class="industry-chip">
      <span class="industry-chip-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2v6M9 5h6M6 22V12a6 6 0 0 1 12 0v10"/></svg></span>
      <span>Oil &amp; Gas Industry</span>
    </div>
    <div class="industry-chip">
      <span class="industry-chip-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M19 14c1.5-2 2-4 2-6a5 5 0 0 0-9-3 5 5 0 0 0-9 3c0 5 6.5 9.5 9 11 1-.6 2.1-1.4 3.2-2.3"/><path d="M15 15h4M17 13v4"/></svg></span>
      <span>Healthcare &amp; Medical Facilities</span>
    </div>
    <div class="industry-chip">
      <span class="industry-chip-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 9h18v11H3zM3 9l2-5h14l2 5M9 13v3M15 13v3"/></svg></span>
      <span>Retail &amp; Commercial Businesses</span>
    </div>
    <div class="industry-chip">
      <span class="industry-chip-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="4" y="2" width="16" height="20" rx="1"/><path d="M9 9h1M14 9h1M9 13h1M14 13h1M9 17h6"/></svg></span>
      <span>Corporate Offices &amp; IT Workspaces</span>
    </div>
    <div class="industry-chip">
      <span class="industry-chip-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 2 3 3 6 3s6-1 6-3v-5"/></svg></span>
      <span>Educational Institutes</span>
    </div>
  </div>
</section>

<!-- ══ WHY CHOOSE US ══ -->
<section class="reason-section">
  <div class="section-head-center">
    <span class="eyebrow eyebrow-flame">Why Choose Us</span>
    <h2>What sets Genesis apart</h2>
  </div>
  <div class="reason-grid">
    <div class="reason-card">
      <div class="reason-card-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2 4 6v6c0 5 3.4 8.7 8 10 4.6-1.3 8-5 8-10V6z"/></svg></div>
      <h4>Industry Expertise</h4>
      <p>Our trainers and auditors bring extensive hands-on industry experience, so training stays relevant and audits stay thorough.</p>
    </div>
    <div class="reason-card">
      <div class="reason-card-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg></div>
      <h4>Custom Solutions</h4>
      <p>Every training and audit program is tailored to your specific industry and business operations — not one-size-fits-all.</p>
    </div>
    <div class="reason-card">
      <div class="reason-card-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 12l2 2 4-4M21 12c0 4.4-3.5 8.5-9 10-5.5-1.5-9-5.6-9-10V6l9-4 9 4z"/></svg></div>
      <h4>Regulatory Compliance</h4>
      <p>We stay current with OSHA, ISO and other regulatory standards to help you meet every compliance requirement.</p>
    </div>
    <div class="reason-card">
      <div class="reason-card-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/></svg></div>
      <h4>Ongoing Support</h4>
      <p>Support doesn't end at training or audit — we help implement recommendations and track progress over time.</p>
    </div>
  </div>
</section>

<!-- ══ CORPORATE TRAININGS ══ -->
<section class="training-list-section">
  <div class="container">
    <div class="section-head-center">
      <span class="eyebrow eyebrow-flame">Categorized Industry Wise</span>
      <h2><?= count($programs) ?> On-Site Safety Training Programs</h2>
      <p class="section-note" style="margin:0 auto">Click any program to view its training modules. All programs are delivered on-site, tailored to your industry.</p>
    </div>

    <div class="training-download-note">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v12m0 0 4-4m-4 4-4-4M4 21h16"/></svg>
      Looking for a downloadable brochure listing all programs? <a href="enquiry.html">Request one via Enquiry →</a>
    </div>

    <div class="training-accordion">
      <?php if (!$programs): ?>
        <p class="section-note">No corporate programs published yet.</p>
      <?php endif; ?>
      <?php foreach ($programs as $i => $p): ?>
        <details class="training-item">
          <summary class="training-item-summary">
            <span class="training-item-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
            <span class="training-item-title"><?= h($p['name']) ?></span>
            <svg class="training-item-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
          </summary>
          <div class="training-item-body">
            <div class="course-modules">
              <h4>Training Modules</h4>
              <?php if (!empty($p['modules_text'])): ?>
                <div><?= $p['modules_text'] /* trusted HTML entered by the logged-in admin only */ ?></div>
              <?php else: ?>
                <p class="course-modules-placeholder">Module-by-module syllabus for this program will be published here shortly. Contact us for the full curriculum right now.</p>
              <?php endif; ?>
            </div>
            <div class="course-item-actions">
              <a href="enquiry.html" class="btn btn-flame">Enquire About This Program
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </a>
            </div>
          </div>
        </details>
      <?php endforeach; ?>
    </div>

    <div class="corporate-cta">
      <a href="enquiry.html" class="btn btn-flame">Book a Corporate Training
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/site-footer.php'; ?>
