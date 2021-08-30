<?php

namespace Blog;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
      'service_manager' => [
        'aliases' => [
          Model\PostCommandInterface::class => Model\PostCommand::class,
          Model\PostRepositoryInterface::class => Model\LaminasDbSqlRepository::class,
        ],
        'factories' => [
          Model\PostCommand::class => InvokableFactory::class,
          Model\PostRepository::class => InvokableFactory::class,
          Model\LaminasDbSqlRepository::class => Factory\LaminasDbSqlRepositoryFactory::class,
        ],
      ],
      
      'controllers' => [
          'factories' => [
          // Controller\ListController::class => InvokableFactory::class,
          Controller\ListController::class => Factory\ListControllerFactory::class,
          // add this
          Controller\WriteController::class => Factory\WriteControllerFactory::class,
          ],
      ],
      
      // This lines opens the configuration for the RouteManager
      'router' => [
        // Open configuration for all possible routes
        'routes' => [
          // Define a new route called "blog"
          'blog' => [
            // Define a "literal" route type:
            'type' => Literal::class,
            // Configure the route itself
            'options' => [
              // Listen to "/blog" as uri:
              'route' => '/blog',
              // Define default controller and action to be called when
              // this route is matched
              'defaults' => [
                'controller' => Controller\ListController::class,
                'action'     => 'index',
              ],
            ],
            'may_terminate' => true,
              'child_routes'  => [
                'detail' => [
                  'type' => Segment::class,
                  'options' => [
                    'route'    => '/:id',
                    'defaults' => [
                        'action' => 'detail',
                    ],
                    'constraints' => [
                         'id' => '\d+',//'[1-9]\d*',
                    ],
                  ],
                ],
//add this
                'add' => [
                  'type' => Literal::class,
                  'options' => [
                    'route'    => '/add',
                    'defaults' => [
                      'controller' => Controller\WriteController::class,
                      'action'     => 'add',
                    ],
                  ],
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




// return [

//   'controllers' => [
//       'factories' => [
//           Controller\ListController::class => InvokableFactory::class,
//       ],
//   ],

   

  
// ];



?>