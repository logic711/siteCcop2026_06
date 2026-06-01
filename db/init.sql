CREATE TABLE IF NOT EXISTS roles (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(120) UNIQUE NOT NULL,
    scope VARCHAR(120) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
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

CREATE TABLE IF NOT EXISTS portal_pages (
    id BIGSERIAL PRIMARY KEY,
    slug VARCHAR(120) UNIQUE NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS page_posts (
    id BIGSERIAL PRIMARY KEY,
    portal_page_id BIGINT REFERENCES portal_pages(id) ON DELETE CASCADE,
    author_id BIGINT REFERENCES users(id) ON DELETE SET NULL,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO roles (name, scope)
VALUES
    ('administrator', 'global'),
    ('user', 'global'),
    ('moderator_about', 'about'),
    ('moderator_helpdesk', 'helpdesk'),
    ('moderator_services', 'services'),
    ('moderator_guides', 'guides'),
    ('moderator_booking', 'booking'),
    ('moderator_life', 'life'),
    ('moderator_security', 'security'),
    ('moderator_support', 'support')
ON CONFLICT (name) DO NOTHING;

INSERT INTO portal_pages (slug, title, description)
VALUES
    ('about', 'О портале', 'Описывает цели, архитектуру и процессы работы ЦЦОП.'),
    ('helpdesk', 'Helpdesk РИУ', 'Точка входа для заявок и консультаций пользователей.'),
    ('services', 'Сервисы ЦЦОП', 'Каталог цифровых сервисов и регламентов доступа.'),
    ('guides', 'Инструкции', 'База инструкций и методических материалов.'),
    ('booking', 'Бронирование аудиторий для ВКС', 'Информация о доступных аудиториях и правилах бронирования.'),
    ('life', 'Жизнь РИУ', 'Новости, события, объявления и голосования института.'),
    ('security', 'Политика безопасности', 'Правила информационной безопасности и требования к данным.'),
    ('support', 'Техническая поддержка', 'Каналы связи и регламент обработки обращений.')
ON CONFLICT (slug) DO NOTHING;

INSERT INTO users (login, last_name, first_name, middle_name, phone, email, password, role_id)
SELECT
    'admin',
    'Суперпользователь',
    'ЦЦОП',
    NULL,
    '+70000000000',
    'admin@ccop.local',
    'admin12345#12345#',
    roles.id
FROM roles
WHERE roles.name = 'administrator'
ON CONFLICT (login) DO NOTHING;

INSERT INTO users (login, last_name, first_name, middle_name, phone, email, password, role_id)
SELECT
    'bulov.a.n@yandex.ru',
    'Булов',
    'А.',
    'Н.',
    '+70000000001',
    'bulov.a.n@yandex.ru',
    'Sdk7sdk7sdk7#',
    roles.id
FROM roles
WHERE roles.name = 'administrator'
ON CONFLICT (login) DO NOTHING;
