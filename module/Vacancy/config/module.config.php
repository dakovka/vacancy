<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Vacancy\Controller\Vacancy' => 'Vacancy\Controller\VacancyController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'vacancy' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/vacancy[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Vacancy\Controller\Vacancy',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'album' => dirname(__DIR__ ) . '/view',
        ),
    ),

    'doctrine' => array(
        'eventmanager' => array(
            'orm_default' => array(
                'subscribers' => array(
                    'Gedmo\Translatable\TranslatableListener',
                ),
            ),
        ),

        'driver' => array(
            'vacancy_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(dirname(__DIR__ ) . '/src/Vacancy/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Vacancy\Entity' => 'vacancy_annotation_driver'
                )
            )
        )
    )
);
 