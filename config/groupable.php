<?php

// Config for yuges/groupable

return [
    /*
     * FQCN (Fully Qualified Class Name) of the models to use for groups
     */
    'models' => [
        'group' => [
            'key' => Yuges\Package\Enums\KeyType::BigInteger,
            'table' => 'groups',
            'class' => Yuges\Groupable\Models\Group::class,
            'observer' => Yuges\Groupable\Observers\GroupObserver::class,
        ],
        'groupable' => [
            'table' => 'groupables',
            'key' => Yuges\Package\Enums\KeyType::BigInteger,
            'class' => Yuges\Groupable\Models\Groupable::class,
            'allowed' => [
                'classes' => [
                    # models...
                ],
            ],
            'relation' => [
                'name' => 'groupable',
            ],
            'observer' => Yuges\Groupable\Observers\GroupableObserver::class,
        ],
        'grouperator' => [
            'key' => Yuges\Package\Enums\KeyType::BigInteger,
            'default' => [
                'class' => \App\Models\User::class,
            ],
            'allowed' => [
                'classes' => [
                    \App\Models\User::class,
                ],
            ],
            'relation' => [
                'name' => 'grouperator',
            ],
        ],
    ],

    'permissions' => [
        'anonymous' => false,
    ],

    'actions' => [
        'sync' => Yuges\Groupable\Actions\SyncGroupsAction::class,
        'attach' => Yuges\Groupable\Actions\AttachGroupsAction::class,
        'detach' => Yuges\Groupable\Actions\DetachGroupsAction::class,
    ],
];
