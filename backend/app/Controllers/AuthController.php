<?php

namespace App\Controllers;

use App\Support\PortalData;
use App\Support\Response;

final class AuthController
{
    public function login(array $payload): void
    {
        $identifier = (string) ($payload['login'] ?? $payload['email'] ?? '');
        $password = (string) ($payload['password'] ?? '');

        if ($identifier === '' || $password === '') {
            Response::json([
                'message' => 'Для авторизации необходимо передать логин или email и пароль.',
            ], 422);
            return;
        }

        $normalized = strtolower(trim($identifier));
        $admins = PortalData::adminCredentials();
        $knownAdmin = $admins[$normalized] ?? null;

        if ($knownAdmin !== null && $knownAdmin['password'] !== $password) {
            Response::json([
                'message' => 'Неверный логин/email или пароль.',
            ], 401);
            return;
        }

        $role = PortalData::resolveRoleByIdentifier($identifier);

        Response::json([
            'message' => 'Авторизация выполнена.',
            'user' => [
                'login' => $identifier,
                'email' => $knownAdmin['email'] ?? $identifier,
                'role' => $role,
                'role_label' => PortalData::roles()[$role],
            ],
        ]);
    }

    public function register(array $payload): void
    {
        foreach (['phone', 'email', 'password', 'password_confirmation', 'captcha', 'captcha_expected'] as $field) {
            if (empty($payload[$field])) {
                Response::json([
                    'message' => "Поле {$field} обязательно для заполнения.",
                ], 422);
                return;
            }
        }

        if ($payload['captcha'] !== $payload['captcha_expected']) {
            Response::json([
                'message' => 'Неверно введено слово с картинки.',
            ], 422);
            return;
        }

        if (($payload['consent'] ?? false) !== true) {
            Response::json([
                'message' => 'Необходимо согласие на обработку персональных данных.',
            ], 422);
            return;
        }

        if ($payload['password'] !== $payload['password_confirmation']) {
            Response::json([
                'message' => 'Пароль и подтверждение не совпадают.',
            ], 422);
            return;
        }

        Response::json([
            'message' => 'Регистрация принята. На указанный email будет отправлено письмо для подтверждения.',
        ], 201);
    }
}
