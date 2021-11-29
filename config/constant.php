<?php

use App\Models\Activity;
use App\Models\Content;
use App\Models\User;

return [
    'user' => [
        'roles' => [
            User::ADMIN,
            User::TEACHER,
            User::STUDENT,
        ],
    ],
    'activity' => [
        'type' => [
            Activity::EXERCISE,
            Activity::EXAM,
        ],
        'status' => [
            Activity::PUBLISHED,
            Activity::DRAFT,
        ],
    ],
    'content' => [
        'status' => [
            Content::PUBLISHED,
            Content::DRAFT,
        ]
    ]
];
