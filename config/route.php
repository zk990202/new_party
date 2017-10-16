<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 2017/7/17
 * Time: 下午3:25
 */

/**
 * routes auto generate file
 */

return [

    /**
     * define the name of route file which will be generated in routes directory
     */
    'web'   => [
        /**
         *
         */
        'use'       =>      [

        ],

        'module'    =>      [
            [
                'method'        =>      'get',
                'action'        =>      '/index',
                'url'           =>  [
                    'uses'          =>  'IndexController@index',
                    'as'            =>  'index'
                ]
            ],
            [
                'group'         =>      [
                    'prefix'        =>      'manager',
                    'namespace'     =>      'Manager',
                ],
                'desc'          =>      '管理组路由',
                'sub_route'     =>      [
                    [
                        'group'     =>  [
                            'prefix'    =>  'party-build'
                        ],
                        'desc'      => '党建专项模块， 路由为 /manager/party-build/{action}, 命名空间 \\App\\Http\\Controllers\\Manager\\',
                        'sub_route' =>  [
                            [
                                'method'        =>      'get',
                                'action'        =>      'list',
                                'url'           =>  [
                                    'uses'          =>  'PartyBuildController@lists',
                                    'as'            =>  'manager-party-build-list'
                                ]
                            ],
                            [
                                'method'        =>      'patch',
                                'action'        =>      '{id}/hide',
                                'url'           =>  [
                                    'uses'          =>  'PartyBuildController@hide',
                                    'as'            =>  'manager-party-build-hide'
                                ]
                            ]
                        ]
                    ]
                ]
            ]

        ]
    ]



];