<?php

namespace App\Controllers;

use App\Support\PortalData;
use App\Support\Response;

final class PageController
{
    public function index(): void
    {
        Response::json([
            'pages' => PortalData::pages(),
        ]);
    }
}
