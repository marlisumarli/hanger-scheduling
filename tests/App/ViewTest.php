<?php

namespace Subjig\Report\App;

use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function testRender()
    {
        View::render('Admin/Dashboard/index', [

        ]);

        $this->expectOutputRegex('[Marleess]');
    }
}
