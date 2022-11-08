<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;

class HomeController
{
    public function index(): void
    {
        View::render('Home/index', [
            'title' => 'Home'
        ]);
    }
}