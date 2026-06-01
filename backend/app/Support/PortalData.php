<?php

namespace App\Support;

final class PortalData
{
    public static function adminCredentials(): array
    {
        return [
            'admin' => [
                'password' => 'admin12345#12345#',
                'email' => 'admin@ccop.local',
                'full_name' => 'Суперпользователь ЦЦОП',
            ],
            'bulov.a.n@yandex.ru' => [
                'password' => 'Sdk7sdk7sdk7#',
                'email' => 'bulov.a.n@yandex.ru',
                'full_name' => 'Булов А. Н.',
            ],
        ];
    }

    public static function roles(): array
    {
        return [
            'administrator' => 'Администратор',
            'user' => 'Пользователь',
            'moderator_about' => 'Модератор страницы "О портале"',
            'moderator_helpdesk' => 'Модератор страницы "Helpdesk РИУ"',
            'moderator_services' => 'Модератор страницы "Сервисы ЦЦОП"',
            'moderator_guides' => 'Модератор страницы "Инструкции"',
            'moderator_booking' => 'Модератор страницы "Бронирование аудиторий для ВКС"',
            'moderator_life' => 'Модератор страницы "Жизнь РИУ"',
            'moderator_security' => 'Модератор страницы "Политика безопасности"',
            'moderator_support' => 'Модератор страницы "Техническая поддержка"',
        ];
    }

    public static function pages(): array
    {
        return [
            [
                'slug' => 'about',
                'title' => 'О портале',
                'moderator_role' => 'moderator_about',
            ],
            [
                'slug' => 'helpdesk',
                'title' => 'Helpdesk РИУ',
                'moderator_role' => 'moderator_helpdesk',
            ],
            [
                'slug' => 'services',
                'title' => 'Сервисы ЦЦОП',
                'moderator_role' => 'moderator_services',
            ],
            [
                'slug' => 'guides',
                'title' => 'Инструкции',
                'moderator_role' => 'moderator_guides',
            ],
            [
                'slug' => 'booking',
                'title' => 'Бронирование аудиторий для ВКС',
                'moderator_role' => 'moderator_booking',
            ],
            [
                'slug' => 'life',
                'title' => 'Жизнь РИУ',
                'moderator_role' => 'moderator_life',
            ],
            [
                'slug' => 'security',
                'title' => 'Политика безопасности',
                'moderator_role' => 'moderator_security',
            ],
            [
                'slug' => 'support',
                'title' => 'Техническая поддержка',
                'moderator_role' => 'moderator_support',
            ],
        ];
    }

    public static function resolveRoleByIdentifier(string $identifier): string
    {
        $normalized = strtolower($identifier);

        return match (true) {
            array_key_exists($normalized, self::adminCredentials()) => 'administrator',
            str_starts_with($normalized, 'admin@') => 'administrator',
            str_contains($normalized, 'about') => 'moderator_about',
            str_contains($normalized, 'helpdesk') => 'moderator_helpdesk',
            str_contains($normalized, 'service') => 'moderator_services',
            str_contains($normalized, 'guide'), str_contains($normalized, 'instr') => 'moderator_guides',
            str_contains($normalized, 'booking'), str_contains($normalized, 'vks') => 'moderator_booking',
            str_contains($normalized, 'life'), str_contains($normalized, 'news') => 'moderator_life',
            str_contains($normalized, 'security') => 'moderator_security',
            str_contains($normalized, 'support') => 'moderator_support',
            default => 'user',
        };
    }
}
