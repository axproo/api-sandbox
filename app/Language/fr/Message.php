<?php 

return [
    'access' => [
        'denied' => 'Accès refusé! {role}',
        'role' => [
            'admin' => 'Réservé aux administrateurs',
            'msp' => 'Réservé aux MSP.',
            'client' => 'Réservé aux clients, admin ou MSP.'
        ],
        'tenant' => 'à cet utilisateur'
    ],
    'token' => [
        'missing' => 'Jeton manquant',
        'found' => 'Jeton trouvé',
        'failed' => [
            'format' => 'Jeton invalide'
        ],
        'otp' => [
            'verify' => 'Code de vérification',
            'active_account' => 'Activation réussie. Votre compte est désormais sécurisé et opérationnel.'
        ]
    ],
    'forms' => [
        'failed' => [
            'type' => 'Type de formulaire invalide {type}',
            'field' => 'Champs introuvable pour le formulaire {form}'
        ]
    ],
    'tables' => [
        'failed' => [
            'exist' => 'La table {table} n\'existe pas dans la base de données.'
        ]
    ],
    'email' => [
        'sent' => 'Un code de vérification vient de vous être envoyé par e-mail.<br>Saisissez ce code pour activer votre compte.',
        'active' => 'Votre compte a été activé avec succès'
    ],
    'copyright' => [
        'title' => 'Tous droits réservés'
    ]
];