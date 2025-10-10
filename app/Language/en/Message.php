<?php 

return [
    'access' => [
        'denied' => 'Accès denied! {role}',
        'role' => [
            'admin' => 'For administrators only',
            'msp' => 'For MSPs only.',
            'client' => 'For customers, admins, or MSPs only.'
        ],
        'tenant' => 'to this user'
    ],
    'token' => [
        'missing' => 'Token missing',
        'found' => 'Token found',
        'failed' => [
            'format' => 'Invalid token'
        ],
        'otp' => [
            'verify' => 'Verification code',
            'active_account' => 'Activation successful. Your account is now secure and operational.'
        ]
    ],
    'forms' => [
        'failed' => [
            'type' => 'Invalid form type {type}',
            'field' => 'Field not found for form {form}'
        ]
    ],
    'tables' => [
        'failed' => [
            'exist' => 'The table {table} does not exist in database'
        ]
    ],
    'email' => [
        'sent' => 'A verification code has just been sent to you by email.<br>Enter this code to activate your account.',
        'active' => 'Your account has been successfully activated.'
    ],
    'copyright' => [
        'title' => 'All rights reserved'
    ]
];