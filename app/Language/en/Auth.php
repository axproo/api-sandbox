<?php 

return [
    'success' => [
        'login' => 'Connection successful',
        'logout' => 'Successful logout'
    ],
    'failed' => [
        'fullname' => 'Unknown user',
        'email' => [
            'incorrect' => 'Incorrect email',
            'required' => 'Email required',
            'valid_email' => 'Invalid email'
        ],
        'password' => [
            'required' => 'Password required',
            'length' => 'Incorrect email or password',
            'incorrect' => 'Oops! Invalid password.'
        ],
        'account' => [
            'verify' => ["redirect" => "/{key}"],
            'active' => 'Your account is already activated',
            'inactivated' => 'Your account is inactive. Please contact the administrator.',
            // 'inactivated' => 'Account suspended or blocked, please contact the administrator',
            'unknown' => 'Account status unknown {status}. Please contact support.',
            'blocked' => 'Your account has been suspended or blocked. Please contact the administrator.'
        ],
        'otp' => [
            'required' => 'Required code',
            'not_found' => 'Invalid code',
            'invalid' => 'Expired code',
            'wait_before_resend' => 'Please wait {min} minutes before requesting a new code.'
        ]
    ]
];