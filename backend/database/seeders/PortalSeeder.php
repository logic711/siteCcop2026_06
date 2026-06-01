<?php

return [
    'roles' => [
        ['name' => 'administrator', 'scope' => 'global'],
        ['name' => 'user', 'scope' => 'global'],
        ['name' => 'moderator_about', 'scope' => 'about'],
        ['name' => 'moderator_helpdesk', 'scope' => 'helpdesk'],
        ['name' => 'moderator_services', 'scope' => 'services'],
        ['name' => 'moderator_guides', 'scope' => 'guides'],
        ['name' => 'moderator_booking', 'scope' => 'booking'],
        ['name' => 'moderator_life', 'scope' => 'life'],
        ['name' => 'moderator_security', 'scope' => 'security'],
        ['name' => 'moderator_support', 'scope' => 'support'],
    ],
    'pages' => [
        ['slug' => 'about', 'title' => 'О портале', 'description' => 'Описание задач Центра цифровой оптимизации процессов.'],
        ['slug' => 'helpdesk', 'title' => 'Helpdesk РИУ', 'description' => 'Обращения пользователей и управление заявками.'],
        ['slug' => 'services', 'title' => 'Сервисы ЦЦОП', 'description' => 'Каталог сервисов и цифровых инструментов.'],
        ['slug' => 'guides', 'title' => 'Инструкции', 'description' => 'Методические материалы и инструкции для пользователей.'],
        ['slug' => 'booking', 'title' => 'Бронирование аудиторий для ВКС', 'description' => 'Регламент бронирования и доступность аудиторий.'],
        ['slug' => 'life', 'title' => 'Жизнь РИУ', 'description' => 'Новости, события, объявления и голосования.'],
        ['slug' => 'security', 'title' => 'Политика безопасности', 'description' => 'Требования к безопасности и защите данных.'],
        ['slug' => 'support', 'title' => 'Техническая поддержка', 'description' => 'Каналы технической поддержки и контакты.'],
    ],
    'users' => [
        [
            'login' => 'admin',
            'last_name' => 'Суперпользователь',
            'first_name' => 'ЦЦОП',
            'middle_name' => null,
            'phone' => '+70000000000',
            'email' => 'admin@ccop.local',
            'password' => 'admin12345#12345#',
            'role' => 'administrator',
        ],
        [
            'login' => 'bulov.a.n@yandex.ru',
            'last_name' => 'Булов',
            'first_name' => 'А.',
            'middle_name' => 'Н.',
            'phone' => '+70000000001',
            'email' => 'bulov.a.n@yandex.ru',
            'password' => 'Sdk7sdk7sdk7#',
            'role' => 'administrator',
        ],
    ],
];
