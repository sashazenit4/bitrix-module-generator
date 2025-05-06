<?php
include './vendor/autoload.php';

$template = new \Sashazenit4\BitrixModuleGenerator\Services\TemplateGenerator();
$template->generateModule(
    [
        'DIV' => 'crm',
        'TAB' => "{{GM('EMPTY_CONFIG_TITLE')}}",
        'ICON' => 'dis_settings',
        'TITLE' => "{{GM('EMPTY_CONFIG_TITLE')}}",
        'OPTIONS' => [
            [
                'EMPTY_CONFIG',
                "{{GM('EMPTY_CONFIG_TITLE')}}",
                '',
                [
                    'text',
                    50,
                ],
            ],
        ]
    ],
    [
        'module_sort' => 100,
        'version_id' => '1.0.0',
        'version_date' => '2025-05-06',
        'module_id' => 'test.module',
    ]
);
