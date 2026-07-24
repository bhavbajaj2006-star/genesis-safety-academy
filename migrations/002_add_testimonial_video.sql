-- Run this once against an existing database that was created before
-- video_path was added to testimonials.
ALTER TABLE testimonials ADD COLUMN video_path VARCHAR(255) DEFAULT NULL AFTER logo_path;
