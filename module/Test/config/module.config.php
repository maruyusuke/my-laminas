<?php

namespace Test;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
  'router' => [
    'routes' => [
        'album' => [
            'type'    => Literal::class,
            'options' => [
                'route' => '/Test',
                'defaults' => [
                  'controller' => Controller\IndexController::class,
                  'action'     => 'index',
                ],
                
            ],
        ],
      ],
  ],
  
  'view_manager' => [
    'template_path_stack' => [
      __DIR__ . '/../view',
    ],
  ],
];