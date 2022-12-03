<?php

namespace Subjig\Report\App;

class Util
{
    public static function nameSplitter(string $name): string
    {
        $nameSlice = explode(' ', $name);
        $nameSlice = array_filter($nameSlice);
        $initials = (isset($nameSlice[0][0])) ? strtoupper($nameSlice[0][0]) : '';
        $initials .= (isset($nameSlice[ count($nameSlice) - 1 ][0])) ? strtoupper($nameSlice[ count($nameSlice) - 1 ][0]) : '';

        return $initials;
    }

    public function getMonth(string $date): string
    {
        $dateTime = new \DateTime($date, new \DateTimeZone('Asia/Jakarta'));
        return $dateTime->format('F');
    }
}