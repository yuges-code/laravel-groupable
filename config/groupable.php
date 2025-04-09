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
            'observer' => Yuges\Groupable\Observers\GroupableObserver::class,
        ],
    ],

    'permissions' => [],

    'actions' => [
        // 'sync' => Yuges\Topicable\Actions\SyncTopicAction::class,
        // 'attach' => Yuges\Topicable\Actions\AttachTopicAction::class,
        // 'detach' => Yuges\Topicable\Actions\DetachTopicAction::class,
    ],
];
