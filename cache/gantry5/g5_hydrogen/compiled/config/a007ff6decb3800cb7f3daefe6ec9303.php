<?php
return [
    '@class' => 'Gantry\\Component\\Config\\CompiledConfig',
    'timestamp' => 1449843814,
    'checksum' => '2daf2a139fa3fb4d026d31fa61ceb576',
    'files' => [
        'templates/g5_hydrogen/custom/config/10' => [
            'index' => [
                'file' => 'templates/g5_hydrogen/custom/config/10/index.yaml',
                'modified' => 1449790708
            ],
            'layout' => [
                'file' => 'templates/g5_hydrogen/custom/config/10/layout.yaml',
                'modified' => 1449790708
            ],
            'page/assets' => [
                'file' => 'templates/g5_hydrogen/custom/config/10/page/assets.yaml',
                'modified' => 1449843814
            ],
            'page/body' => [
                'file' => 'templates/g5_hydrogen/custom/config/10/page/body.yaml',
                'modified' => 1449843814
            ],
            'particles/logo' => [
                'file' => 'templates/g5_hydrogen/custom/config/10/particles/logo.yaml',
                'modified' => 1449790708
            ],
            'styles' => [
                'file' => 'templates/g5_hydrogen/custom/config/10/styles.yaml',
                'modified' => 1449790708
            ]
        ],
        'templates/g5_hydrogen/custom/config/default' => [
            'index' => [
                'file' => 'templates/g5_hydrogen/custom/config/default/index.yaml',
                'modified' => 1449790708
            ]
        ],
        'templates/g5_hydrogen/config/default' => [
            'page' => [
                'file' => 'templates/g5_hydrogen/config/default/page.yaml',
                'modified' => 1449790708
            ],
            'particles/logo' => [
                'file' => 'templates/g5_hydrogen/config/default/particles/logo.yaml',
                'modified' => 1449790708
            ]
        ]
    ],
    'data' => [
        'page' => [
            'assets' => [
                'in_footer' => false,
                'favicon' => 'gantry-media://favico.svg'
            ],
            'body' => [
                'doctype' => 'html',
                'attribs' => [
                    'class' => 'gantry'
                ],
                'layout' => [
                    'sections' => '2'
                ],
                'class' => 'gantry',
                'body_bottom' => '<script>
jQuery(document).ready(function() {
    jQuery(\'#fullpage\').fullpage({
      \'navigation\': true,
      \'navigationPosition\': \'right\',
  });
});
</script>'
            ],
            'doctype' => 'html'
        ],
        'styles' => [
            'accent' => [
                'color-1' => '#439A86',
                'color-2' => '#8F4DAE'
            ],
            'base' => [
                'background' => '#ffffff',
                'text-color' => '#666666',
                'body-font' => 'family=Actor',
                'heading-font' => 'roboto, sans-serif'
            ],
            'breakpoints' => [
                'large-desktop-container' => '75rem',
                'desktop-container' => '60rem',
                'tablet-container' => '48rem',
                'large-mobile-container' => '30rem',
                'mobile-menu-breakpoint' => '48rem'
            ],
            'feature' => [
                'background' => '#ffffff',
                'text-color' => '#666666'
            ],
            'footer' => [
                'background' => '#ffffff',
                'text-color' => '#666666'
            ],
            'header' => [
                'background' => '#2A816D',
                'text-color' => '#ffffff'
            ],
            'main' => [
                'background' => '#ffffff',
                'text-color' => '#666666'
            ],
            'menu' => [
                'col-width' => '180px',
                'animation' => 'g-fade'
            ],
            'navigation' => [
                'background' => 'rgba(0, 0, 0, 0.35)',
                'text-color' => '#ffffff',
                'overlay' => 'rgba(0, 0, 0, 0.4)'
            ],
            'offcanvas' => [
                'background' => '#354D59',
                'text-color' => '#ffffff',
                'width' => '17rem',
                'toggle-color' => '#ffffff'
            ],
            'showcase' => [
                'background' => '#354D59',
                'image' => '',
                'text-color' => '#ffffff'
            ],
            'subfeature' => [
                'background' => '#f0f0f0',
                'text-color' => '#666666'
            ],
            'preset' => 'preset1'
        ],
        'particles' => [
            'analytics' => [
                'enabled' => true,
                'ua' => [
                    'anonym' => false,
                    'ssl' => false,
                    'debug' => false
                ]
            ],
            'assets' => [
                'enabled' => true,
                'in_footer' => false
            ],
            'branding' => [
                'enabled' => true,
                'content' => 'Powered by <a href="http://www.gantry.org/" title="Gantry Framework" class="g-powered-by">Gantry Framework</a>',
                'css' => [
                    'class' => 'branding'
                ]
            ],
            'content' => [
                'enabled' => true
            ],
            'copyright' => [
                'enabled' => true,
                'date' => [
                    'start' => 'now',
                    'end' => 'now'
                ]
            ],
            'custom' => [
                'enabled' => true
            ],
            'date' => [
                'enabled' => true,
                'css' => [
                    'class' => 'date'
                ],
                'date' => [
                    'formats' => 'l, F d, Y'
                ]
            ],
            'logo' => [
                'enabled' => '1',
                'url' => '',
                'image' => 'gantry-media://NeoAcu_logo.png',
                'text' => 'Gantry 5',
                'class' => 'gantry-logo'
            ],
            'menu' => [
                'enabled' => true,
                'menu' => '',
                'base' => '/',
                'startLevel' => 1,
                'maxLevels' => 0,
                'renderTitles' => 0,
                'mobileTarget' => 0
            ],
            'messages' => [
                'enabled' => true
            ],
            'mobile-menu' => [
                'enabled' => true
            ],
            'module' => [
                'enabled' => true
            ],
            'position' => [
                'enabled' => true
            ],
            'social' => [
                'enabled' => true,
                'css' => [
                    'class' => 'social'
                ],
                'target' => '_blank'
            ],
            'spacer' => [
                'enabled' => true
            ],
            'totop' => [
                'enabled' => true,
                'css' => [
                    'class' => 'totop'
                ]
            ],
            'sample' => [
                'enabled' => true
            ]
        ],
        'index' => [
            'name' => 10,
            'timestamp' => 1449261144,
            'preset' => [
                'image' => 'gantry-admin://images/layouts/home.png',
                'name' => 'home',
                'timestamp' => 1448927385
            ],
            'positions' => [
                'newsletter-signup' => 'Module Position',
                'module-position-one' => 'Module Position',
                'footer' => 'Footer'
            ]
        ],
        'layout' => [
            'version' => 2,
            'preset' => [
                'image' => 'gantry-admin://images/layouts/home.png',
                'name' => 'home',
                'timestamp' => 1448927385
            ],
            'layout' => [
                '/header/' => [
                    
                ],
                '/navigation/' => [
                    0 => [
                        0 => 'logo-9865 12',
                        1 => 'position-position-5658 88'
                    ]
                ],
                '/showcase/' => [
                    
                ],
                '/feature/' => [
                    
                ],
                '/main/' => [
                    0 => [
                        0 => 'system-messages-6320'
                    ],
                    1 => [
                        0 => 'system-content-9472'
                    ],
                    2 => [
                        0 => 'position-position-1555'
                    ]
                ],
                '/subfeature/' => [
                    
                ],
                '/footer/' => [
                    0 => [
                        0 => 'position-footer'
                    ],
                    1 => [
                        0 => 'copyright-3055 50',
                        1 => 'social-9946 50'
                    ]
                ],
                'offcanvas' => [
                    0 => [
                        0 => 'mobile-menu-3298'
                    ]
                ]
            ],
            'structure' => [
                'header' => [
                    'attributes' => [
                        'boxed' => '0',
                        'class' => ''
                    ]
                ],
                'navigation' => [
                    'type' => 'section',
                    'attributes' => [
                        'boxed' => '2',
                        'class' => ''
                    ]
                ],
                'showcase' => [
                    'type' => 'section',
                    'attributes' => [
                        'boxed' => ''
                    ]
                ],
                'feature' => [
                    'type' => 'section',
                    'attributes' => [
                        'boxed' => ''
                    ]
                ],
                'main' => [
                    'attributes' => [
                        'boxed' => ''
                    ]
                ],
                'subfeature' => [
                    'type' => 'section',
                    'attributes' => [
                        'class' => 'flush',
                        'boxed' => ''
                    ]
                ],
                'footer' => [
                    'attributes' => [
                        'boxed' => ''
                    ]
                ]
            ],
            'content' => [
                'logo-9865' => [
                    'title' => 'Logo / Image',
                    'attributes' => [
                        'class' => 'gantry-logo kq-top-logo'
                    ]
                ],
                'position-position-5658' => [
                    'title' => 'Module Position',
                    'attributes' => [
                        'key' => 'newsletter-signup'
                    ],
                    'block' => [
                        'class' => 'kq-nav'
                    ]
                ],
                'position-position-1555' => [
                    'title' => 'Module Position',
                    'attributes' => [
                        'key' => 'module-position-one'
                    ]
                ],
                'position-footer' => [
                    'attributes' => [
                        'key' => 'footer'
                    ]
                ],
                'social-9946' => [
                    'attributes' => [
                        'css' => [
                            'class' => 'social-items'
                        ],
                        'items' => [
                            0 => [
                                'icon' => 'fa fa-twitter',
                                'text' => 'Twitter',
                                'link' => 'http://twitter.com/rockettheme',
                                'name' => 'Twitter'
                            ],
                            1 => [
                                'icon' => 'fa fa-facebook',
                                'text' => 'Facebook',
                                'link' => 'http://facebook.com/rockettheme',
                                'name' => 'Facebook'
                            ],
                            2 => [
                                'icon' => 'fa fa-google',
                                'text' => 'Google',
                                'link' => 'http://plus.google.com/+rockettheme',
                                'name' => 'Google'
                            ],
                            3 => [
                                'icon' => 'fa fa-rss',
                                'text' => 'RSS',
                                'link' => 'http://www.rockettheme.com/product-updates?rss',
                                'name' => 'RSS'
                            ]
                        ]
                    ],
                    'block' => [
                        'variations' => 'center'
                    ]
                ],
                'mobile-menu-3298' => [
                    'title' => 'Mobile Menu'
                ]
            ]
        ]
    ]
];
