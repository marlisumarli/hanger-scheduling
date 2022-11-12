<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;

class HomeController
{
    public function index(): void
    {
        $home = [
            'title' => 'Home'
        ];
        View::render('Home/index', compact('home'));
    }
}