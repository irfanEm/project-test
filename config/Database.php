<?php

function getConfig(): array
{
    return [
        "database" => [
            "test" => [
                "url" => "mysql:host=localhost:3306;dbname=test_project_test",
                "username" => "root",
                "password" => ""
            ],
            "prod" => [
                "url" => "mysql:host=localhost:3306;dbname=project_test",
                "username" => "root",
                "password" => ""
            ]
        ]
    ];
}