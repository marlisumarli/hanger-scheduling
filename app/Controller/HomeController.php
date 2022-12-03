<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;

class HomeController
{
    public function index(): void
    {
        $model = [
            'title' => 'Dashboard'
        ];
        View::render('Home/index', compact('model'));
    }
}