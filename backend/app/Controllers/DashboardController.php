<?php

namespace App\Controllers;

use App\Support\PortalData;
use App\Support\Response;

final class DashboardController
{
    public function show(array $query): void
    {
        $role = $query['role'] ?? 'user';
        $pages = array_values(array_filter(
            PortalData::pages(),
            static fn (array $page): bool => $role === 'administrator' || $page['moderator_role'] === $role
        ));

        Response::json([
            'role' => $role,
            'role_label' => PortalData::roles()[$role] ?? PortalData::roles()['user'],
            'managed_pages' => $pages,
        ]);
    }
}
