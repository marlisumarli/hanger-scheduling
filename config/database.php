<?php

function getDataBaseConfig(): array
{
    return [
        "database" => [
            'test' => [
                "url" => "mysql:host=localhost;dbname=subjig_report_test",
                "user" => "root",
                "password" => "marleess771",
            ],
            'prod' => [
                "url" => "mysql:host=localhost;dbname=subjig_report",
                "user" => "root",
                "password" => "marleess771",
            ]
        ]
    ];
}
