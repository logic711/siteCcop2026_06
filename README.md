# Портал ЦЦОП

Проект подготовлен в требуемой структуре:

- `frontend` - Vue 3 + TypeScript + Vite.
- `backend` - PHP backend в Laravel-ориентированной структуре.
- `db` - PostgreSQL и начальная схема.
- `nginx` - конфигурация веб-сервера.
- `docker-compose.yml` - контейнеризация всего проекта.

## Что реализовано

- шапка и подвал, которые доступны на всех страницах;
- личный кабинет с ролевой логикой и блоком админ-панели;
- авторизация, восстановление пароля и регистрация;
- модальное окно согласия на обработку персональных данных;
- cookie-уведомление;
- разделы портала и базовые права модераторов;
- backend API-заготовки и схема БД под роли, страницы и публикации.

## Локальный запуск

```bash
docker compose up --build
```

После старта:

- frontend dev server: `http://localhost:5174`
- общий вход через nginx: `http://localhost:8081`

## CI/CD

Для проекта добавлен GitHub Actions pipeline в [.github/workflows/ci-cd.yml](/C:/Users/user/Documents/Codex/2026-06-01/files-mentioned-by-the-user-txt/.github/workflows/ci-cd.yml).

Pipeline делает следующее:

- запускается автоматически на `push` и `pull_request`;
- выполняет lint-проверку;
- параллельно проверяет сборку на `ubuntu-latest`, `windows-latest` и `macos-latest`;
- поднимает staging-среду через Docker Compose;
- выполняет дополнительные smoke/integration тесты;
- при успешном прохождении деплоит на production через self-hosted runner для веток `main` и `master`.

## Ubuntu VM Deploy

Для переноса проекта на Ubuntu Server 24 подготовлен production-набор:

- [docker-compose.prod.yml](/C:/Users/user/Documents/Codex/2026-06-01/files-mentioned-by-the-user-txt/docker-compose.prod.yml)
- [nginx/Dockerfile.prod](/C:/Users/user/Documents/Codex/2026-06-01/files-mentioned-by-the-user-txt/nginx/Dockerfile.prod)
- [nginx/prod.conf](/C:/Users/user/Documents/Codex/2026-06-01/files-mentioned-by-the-user-txt/nginx/prod.conf)
- [.env.production.example](/C:/Users/user/Documents/Codex/2026-06-01/files-mentioned-by-the-user-txt/.env.production.example)
- [deploy/ansible/deploy.yml](/C:/Users/user/Documents/Codex/2026-06-01/files-mentioned-by-the-user-txt/deploy/ansible/deploy.yml)

Целевой адрес портала на виртуальной машине по умолчанию:

- `http://192.168.2.137:8081`
