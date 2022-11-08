<?php

namespace Subjig\Report\Middleware;

interface Middleware
{
    function before(): void;
}