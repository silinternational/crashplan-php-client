<?php return [
    'baseUrl' => 'https://www.crashplan.com',
    'apiVersion' => 'api',
    'operations' => [
        'ListUsers' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/User',
            'responseModel' => 'User',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'email' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'username' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
            ]
        ],
        'GetUser' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/User/{userId}',
            'responseModel' => 'User',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'userId' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
            ]
        ],
        'GetCurrentUser' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/User/my',
            'responseModel' => 'User',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
            ]
        ],
        'AddUser' => [
            'httpMethod' => 'POST',
            'uri' => '/{ApiVersion}/User',
            'responseModel' => 'User',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'orgId' => [
                    'required' => true,
                    'type' => 'integer',
                    'location' => 'json'
                ],
                'username' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'json'
                ],
                'email' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'json'
                ],
                'firstName' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'json'
                ],
                'lastName' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'json'
                ],
                'password' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'json'
                ],
                'emailPromo' => [
                    'required' => false,
                    'type' => 'boolean',
                    'location' => 'json'
                ],
            ]
        ],
        'UpdateUser' => [
            'httpMethod' => 'PUT',
            'uri' => '/{ApiVersion}/User/{userId}',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'userId' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'orgId' => [
                    'required' => true,
                    'type' => 'integer',
                    'location' => 'json'
                ],
                'username' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'json'
                ],
                'email' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'json'
                ],
                'firstName' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'json'
                ],
                'lastName' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'json'
                ],
                'password' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'json'
                ],
                'emailPromo' => [
                    'required' => false,
                    'type' => 'boolean',
                    'location' => 'json'
                ],
                'quotaInBytes' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'json'
                ]
            ]
        ],
        'DeactivateUser' => [
            'httpMethod' => 'PUT',
            'uri' => '/{ApiVersion}/UserDeactivation/{userId}',
            'responseModel' => 'User',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'userId' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'blockUser' => [
                    'required' => false,
                    'type' => 'boolean',
                    'location' => 'json',
                ],
            ]
        ],
        'ActivateUser' => [
            'httpMethod' => 'DELETE',
            'uri' => '/{ApiVersion}/UserDeactivation/{userId}',
            'responseModel' => 'User',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'userId' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'unblockUser' => [
                    'required' => false,
                    'type' => 'boolean',
                    'location' => 'json',
                ],
            ]
        ],
    ],
    'models' => [
        'User' => [
            'type' => 'object',
            'properties' => [
                'statusCode' => ['location' => 'statusCode']
            ],
            'additionalProperties' => [
                'location' => 'json'
            ]
        ],
        'Result' => [
            'type' => 'object',
            'additionalProperties' => [
                'location' => 'json'
            ]
        ]
    ]

];