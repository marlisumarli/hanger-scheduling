<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;

class AdminHomeController
{
    public function index(): void
    {
        View::render('Admin/Home/index', [
            'title' => 'Dashboard'
        ]);
    }
}