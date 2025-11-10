<?php

return [
    'incrementalCode' => [
        'default' => 0,
        'name' => 'iform::incrementalCode',
        'dynamicField' => [
            'type' => 'input',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'iform::settings.incrementalCode',
                'type' => 'number'
            ]
        ]
    ],
    'formCode' => [
        'default' => "xx",
        'name' => 'iform::formCode',
        'dynamicField' => [
            'type' => 'input',
            'colClass' => 'col-12 col-md-6',
            'props' => [
                'label' => 'iform::settings.formCode'
            ]
        ]
    ],
];
