<?php

return <<<'SQL'
CREATE TABLE users (
    id BIGSERIAL PRIMARY KEY,
    login VARCHAR(120) UNIQUE NOT NULL,
    last_name VARCHAR(120) NOT NULL,
    first_name VARCHAR(120) NOT NULL,
    middle_name VARCHAR(120),
    phone VARCHAR(32) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id BIGINT REFERENCES roles(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
SQL;
