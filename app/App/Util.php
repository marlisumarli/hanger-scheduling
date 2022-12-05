<?php

namespace Subjig\Report\App;

class Util
{
    public static function nameSplitter(string $name): string
    {
        $name = explode(" ", $name);
        $name = array_map(function ($name) {
            return $name[0];
        }, $name);
        return implode("", $name);
    }
}