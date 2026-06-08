# Deploy на Ubuntu VM

## Что подготовлено

- `docker-compose.prod.yml` - production compose для сервера;
- `nginx/Dockerfile.prod` и `nginx/prod.conf` - production nginx со встроенным frontend build;
- `.env.production.example` - пример production переменных;
- `deploy/ansible/deploy.yml` - playbook для выкладки на Ubuntu VM;
- `deploy/ansible/inventory.ini.example` - пример inventory.

## Быстрый сценарий

1. На своей машине скопируйте `inventory.ini.example` в `inventory.ini`.
2. При необходимости исправьте пользователя SSH:
   - в текущем случае уже подготовлен `user` и порт `22`.
3. При необходимости измените порт в `.env.production`.
4. Запустите ansible playbook:

```bash
ansible-galaxy collection install community.docker
ansible-playbook -i deploy/ansible/inventory.ini deploy/ansible/deploy.yml -k -K
```

Где:

- `-k` - запросить SSH-пароль пользователя `user`;
- `-K` - запросить `sudo` пароль, если он нужен для `become: true`.

## Что должно быть на VM

- Ubuntu Server 24;
- установлен Docker;
- установлен Docker Compose plugin;
- открыт SSH-доступ;
- пользователь должен иметь право запускать Docker.

## Какой адрес будет у портала

По умолчанию:

- `http://192.168.2.137:8081`

Если в `.env.production` поменять `PORTAL_HTTP_PORT`, то адрес изменится соответственно.
