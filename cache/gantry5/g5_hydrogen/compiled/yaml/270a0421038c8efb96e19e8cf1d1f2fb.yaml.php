<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/opt/lampp/htdocs/neoacu/templates/g5_hydrogen/blueprints/styles/subfeature.yaml',
    'modified' => 1449752706,
    'data' => [
        'name' => 'Subfeature Colors',
        'description' => 'Subfeature colors for the Hydrogen theme',
        'type' => 'section',
        'form' => [
            'fields' => [
                'background' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Background',
                    'default' => '#f0f0f0'
                ],
                'text-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Text',
                    'default' => '#666666'
                ]
            ]
        ]
    ]
];
