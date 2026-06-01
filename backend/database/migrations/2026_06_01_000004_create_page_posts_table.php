<?php

return <<<'SQL'
CREATE TABLE page_posts (
    id BIGSERIAL PRIMARY KEY,
    portal_page_id BIGINT REFERENCES portal_pages(id) ON DELETE CASCADE,
    author_id BIGINT REFERENCES users(id) ON DELETE SET NULL,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
SQL;
