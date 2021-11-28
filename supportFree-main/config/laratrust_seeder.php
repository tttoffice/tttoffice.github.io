<?php

return [
    'role_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'modules'=>'c,r,u,d',
            'branches'=>'c,r,u,d',
            'projects'=>'c,r,u,d',
            'employees'=>'c,r,u,d',
            'Supportcalls'=>'c,r,u,d',
            'calls'=>'c,r,u,d',
            'profile'=>'c,r,u,d',

        ],
        'editor' => [],
        'employee' => [],


        /*
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'user' => [
            'profile' => 'r,u'
        ],*/
    ],
    /*'permission_structure' => [
        'cru_user' => [
            'profile' => 'c,r,u'
        ],
    ],*/
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
