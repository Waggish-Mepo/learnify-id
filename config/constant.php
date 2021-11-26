<?php

use App\Models\User;

return [
    'user' => [
        'roles' => [
            User::ADMIN,
            User::TEACHER,
            User::STUDENT,
        ]
    ]
];
