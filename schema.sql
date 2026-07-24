-- Genesis Safety Academy — CMS database schema
-- Import this file once via phpMyAdmin (or `mysql -u user -p dbname < schema.sql`)
-- on your shared hosting control panel before using the site or the admin panel.

SET NAMES utf8mb4;

-- ============================================================
-- Admins (single login — only one row should ever exist)
-- ============================================================
CREATE TABLE IF NOT EXISTS admin_users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(60) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- No admin account is created here on purpose (a hand-typed password hash
-- would be wrong and would lock you out). After importing this file, open
-- /admin/setup.php in your browser once — it will let you create the one
-- admin login (username + password) and then lock itself automatically.

-- ============================================================
-- Blog posts
-- ============================================================
CREATE TABLE IF NOT EXISTS blog_posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(160) NOT NULL UNIQUE,
  title VARCHAR(255) NOT NULL,
  category VARCHAR(80) DEFAULT NULL,
  post_date DATE NOT NULL,
  image_path VARCHAR(255) DEFAULT NULL,
  excerpt VARCHAR(400) DEFAULT NULL,
  body MEDIUMTEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- Courses (Certificate / Diploma listing)
-- ============================================================
CREATE TABLE IF NOT EXISTS courses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(160) NOT NULL UNIQUE,
  name VARCHAR(255) NOT NULL,
  tag VARCHAR(40) NOT NULL DEFAULT 'Certificate',
  duration_text VARCHAR(120) DEFAULT NULL,
  image_path VARCHAR(255) DEFAULT NULL,
  lead_text TEXT DEFAULT NULL,
  modules_text MEDIUMTEXT DEFAULT NULL,
  featured TINYINT(1) NOT NULL DEFAULT 0,
  sort_order INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- Corporate training programs
-- ============================================================
CREATE TABLE IF NOT EXISTS corporate_programs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  modules_text MEDIUMTEXT DEFAULT NULL,
  sort_order INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- Testimonials (corporate or student)
-- ============================================================
CREATE TABLE IF NOT EXISTS testimonials (
  id INT AUTO_INCREMENT PRIMARY KEY,
  type ENUM('corporate','student') NOT NULL,
  quote TEXT NOT NULL,
  author_name VARCHAR(160) NOT NULL,
  author_meta VARCHAR(160) DEFAULT NULL,
  avatar_initials VARCHAR(4) DEFAULT NULL,
  logo_path VARCHAR(255) DEFAULT NULL,
  sort_order INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- Gallery photos
-- ============================================================
CREATE TABLE IF NOT EXISTS gallery_photos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  image_path VARCHAR(255) NOT NULL,
  company_name VARCHAR(160) NOT NULL,
  location VARCHAR(160) DEFAULT 'Chennai, India',
  sort_order INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- Seed data — migrated from the existing static site
-- ============================================================

INSERT INTO courses (slug, name, tag, duration_text, image_path, lead_text, sort_order, featured) VALUES
('fire-safety', 'Certificate Course in Fire Safety', 'Certificate', '45 hrs total · 2.5 hrs/day · 3 days/week', 'images/courses/fire-safety.jpg', 'Module-by-module syllabus for this course will be published here shortly. Contact us for the full curriculum right now.', 1, 0),
('industrial-safety', 'Certificate Course in Industrial Safety', 'Certificate', '45 hrs total · 2.5 hrs/day · 3 days/week', 'images/courses/industrial-safety.jpg', 'Module-by-module syllabus for this course will be published here shortly. Contact us for the full curriculum right now.', 2, 0),
('construction-safety', 'Certificate Course in Construction Safety', 'Certificate', '45 hrs total · 2.5 hrs/day · 3 days/week', 'images/courses/construction-safety.jpg', 'Module-by-module syllabus for this course will be published here shortly. Contact us for the full curriculum right now.', 3, 0),
('chemical-biohazard-safety', 'Certificate Course in Chemical and Biohazard Safety', 'Certificate', '45 hrs total · 2.5 hrs/day · 3 days/week', 'images/courses/chemical-biohazard-safety.jpg', 'Module-by-module syllabus for this course will be published here shortly. Contact us for the full curriculum right now.', 4, 0),
('electrical-safety', 'Certificate Course in Electrical Safety at Construction Site', 'Certificate', '45 hrs total · 2.5 hrs/day · 3 days/week', 'images/courses/electrical-safety.jpg', 'Module-by-module syllabus for this course will be published here shortly. Contact us for the full curriculum right now.', 5, 0),
('environment-health-safety', 'Certificate Course in Environment, Health and Safety', 'Certificate', '45 hrs total · 2.5 hrs/day · 3 days/week', 'images/courses/environment-health-safety.jpg', 'Module-by-module syllabus for this course will be published here shortly. Contact us for the full curriculum right now.', 6, 0),
('health-impact-psychological', 'Certificate Course in Health Impact Psychological Hazards at Work Place', 'Certificate', '45 hrs total · 2.5 hrs/day · 3 days/week', 'images/courses/health-impact-psychological.jpg', 'Module-by-module syllabus for this course will be published here shortly. Contact us for the full curriculum right now.', 7, 0),
('disaster-management', 'Certificate Course in Disaster Management', 'Certificate', '45 hrs total · 2.5 hrs/day · 3 days/week', 'images/courses/disaster-management.jpg', 'Module-by-module syllabus for this course will be published here shortly. Contact us for the full curriculum right now.', 8, 0),
('adfise', 'Advance Diploma in Fire & Industrial Safety Engineering (ADFISE)', 'Diploma', '180 hrs total · 4 hrs/day · 5 days/week', 'images/courses/advance-diploma.jpg', 'Module-by-module syllabus for this course will be published here shortly. Contact us for the full curriculum right now.', 9, 1);

INSERT INTO corporate_programs (name, sort_order) VALUES
('Fire & Emergency Evacuation Training', 1),
('Behaviour Based Safety Training (BBST)', 2),
('First Aid Training', 3),
('Mock Drill Safety Training', 4),
('Accident Prevention Training', 5),
('Scaffolding Safety Training', 6),
('Working at Height Safety Training', 7),
('Crane Safety Training', 8),
('Fork Lift Safety Training', 9),
('Machinery Safety Training', 10),
('EOT Crane Safety Training', 11),
('Electrical Safety Training', 12),
('Lock Out Tag Out Safety Training (LOTO)', 13),
('Construction Safety Training', 14),
('Industrial Safety Training', 15),
('Ergonomics Safety Training', 16),
('Confined Space Working Safety', 17),
('Hazardous Identification Risk Assessment Training (HIRA)', 18),
('Permit to Work Safety', 19),
('Advanced Fire Fighting Safety Training', 20),
('Manual Handling Safety Training', 21),
('Material Handling Equipment Training', 22),
('HOT & COLD Work Safety Training', 23),
('Rigging and Lifting Safety Training', 24),
('Welding Safety Training', 25),
('Chemical Safety Training', 26),
('Accident Investigation Training', 27),
('Job Safety Analysis Training', 28),
('Industrial Hygiene Safety Training', 29),
('5S Japanese Work Place Discipline Training', 30);

INSERT INTO testimonials (type, quote, author_name, author_meta, avatar_initials, sort_order) VALUES
('corporate', 'The safety audit and on-site training our warehouse team received was thorough and practical. Incident reporting has improved noticeably since.', 'HSE Manager', 'TVS Warehouse, Chennai', 'TV', 1),
('corporate', 'Genesis tailored the fire and emergency evacuation program to our facility layout. The mock drill was the best our staff has been through.', 'Plant Safety Officer', 'BYD, Chennai', 'BY', 2),
('corporate', 'Professional trainers, clear documentation, and a report we could act on immediately. Exactly what we needed before our compliance review.', 'Operations Head', 'SRF, Chennai', 'SR', 3),
('corporate', 'Our machine operators went through the LOTO and machinery safety modules — practical, hands-on, and easy to follow even for new joinees.', 'Factory Manager', 'Bontaz Hira, Chennai', 'BH', 4),
('corporate', 'From the first consultation to the final audit report, the process was smooth and genuinely useful — not just a compliance checkbox.', 'Site Manager', 'DLF NortonLifeLock, Chennai', 'DN', 5),
('corporate', 'Genesis understood our construction site''s specific risks and delivered working-at-height and scaffolding training that our crew actually engaged with.', 'Project Engineer', 'Arudra Engineers, Chennai', 'AE', 6),
('student', 'The Fire Safety certificate course gave me practical, hands-on training I couldn''t find anywhere else. I got placed within a month of finishing.', 'Certificate Course in Fire Safety', 'Chennai', 'RK', 1),
('student', 'ADFISE covered everything from basics to advanced industrial safety engineering. The trainers made even the toughest topics easy to grasp.', 'Advance Diploma in Fire & Industrial Safety (ADFISE)', 'Chennai', 'SP', 2),
('student', 'Flexible batch timings meant I could complete my Industrial Safety course alongside my job. The mock tests really helped before my final exam.', 'Certificate Course in Industrial Safety', 'Chennai', 'MJ', 3),
('student', 'The construction safety course had real site visits, not just classroom theory. That practical exposure is what got me hired as a site supervisor.', 'Certificate Course in Construction Safety', 'Chennai', 'AV', 4),
('student', 'I switched careers into EHS after this course. The faculty''s real-world examples and job assistance support made all the difference.', 'Certificate Course in Environment, Health & Safety', 'Chennai', 'PN', 5),
('student', 'Small batch sizes meant the instructor actually knew each of us and gave feedback that helped. Would recommend Genesis to anyone starting out.', 'Certificate Course in Chemical & Biohazard Safety', 'Chennai', 'KD', 6);

INSERT INTO gallery_photos (image_path, company_name, location, sort_order) VALUES
('images/gallery/photo-1.jpg', 'Ascendas Vinpleex Logistic', 'Chennai, India', 1),
('images/gallery/photo-2.jpg', 'BYD', 'Chennai, India', 2),
('images/gallery/photo-3.jpg', 'Bontaz Hira', 'Chennai, India', 3),
('images/gallery/photo-4.jpg', 'Hindustan Engineering College', 'Chennai, India', 4),
('images/gallery/photo-5.jpg', 'DLF Norton Life Lock', 'Chennai, India', 5),
('images/gallery/photo-6.jpg', 'TVS Warehouse', 'Chennai, India', 6),
('images/gallery/photo-7.jpg', 'Arudra Engineers', 'Chennai, India', 7),
('images/gallery/photo-8.jpg', 'Denix', 'Chennai, India', 8),
('images/gallery/photo-9.jpg', 'SRF', 'Chennai, India', 9);

INSERT INTO blog_posts (slug, title, category, post_date, image_path, excerpt, body) VALUES
('industrial-safety-tips', '10 Safety Tips For Every Industrial Worker', 'Industrial Safety', '2025-10-12', 'images/blog/10-safety-tips.jpg',
 'Essential safety tips for every industrial worker to help prevent workplace accidents and ensure a secure working environment.',
 '<p>In this blog, we share 10 essential safety tips for every industrial worker to help prevent workplace accidents and ensure a secure working environment.</p>'),
('esg-importance', 'Why ESG Is So Important For Today''s Scenario?', 'Environment', '2025-06-28', 'images/courses/environment-health-safety.jpg',
 'Understanding global warming, carbon footprint and why Environmental, Social & Governance practices matter now more than ever.',
 '<p>ESG (Environmental, Social & Governance) practices are essential to combat global warming caused by our collective carbon footprint.</p>'),
('fire-safety-tips-home', '10 Fire Safety Tips At Home', 'Fire Safety', '2025-05-27', 'images/courses/fire-safety.jpg',
 'Simple steps — from smoke alarms to fire evacuation plans — that make a big difference in preventing and responding to home fires.',
 '<p>These are the 10 basic home fire safety measures that can help protect your family and property.</p>');
