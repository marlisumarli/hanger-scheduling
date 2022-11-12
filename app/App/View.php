<?php

namespace Subjig\Report\App;

use Jenssegers\Blade\Blade;

class View
{

    public static function redirect(string $url): void
    {
        header("Location: $url");
        if (getenv("mode") != "test") {
            exit();
        }
    }

    private static function returnView(string $view, array $model = [])
    {
        $blade = new Blade(__DIR__ . '/../View/', __DIR__ . '/../../storage/cache');
        $file = __DIR__ . '/../View/' . $view . '.blade.php';

        if (!file_exists($file)) {
            throw new \Exception('View doesnt exist');
        }
        return $blade->render($view, $model);
    }

    public static function render(string $view, array $model = [])
    {
        echo self::returnView($view, $model);
    }
}