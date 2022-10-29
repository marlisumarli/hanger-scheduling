<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Subjig\Report\App\Router;
use Subjig\Report\Config\Database;

Database::getConnection('prod');

//

Router::run();
