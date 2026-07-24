-- Run this once against an existing database that was created before
-- seo_keywords was added to blog_posts (schema.sql alone won't add it,
-- since CREATE TABLE IF NOT EXISTS is a no-op on an existing table).
ALTER TABLE blog_posts ADD COLUMN seo_keywords VARCHAR(400) DEFAULT NULL AFTER excerpt;
