<?php 

return [
    'success' => [
        'login' => 'Connexion réussie',
        'logout' => 'Déconnexion réussie'
    ],
    'failed' => [
        'fullname' => 'Utilisateur inconnu',
        'email' => [
            'incorrect' => 'Adresse e-mail incorrecte',
            'required' => 'Adresse e-mail obligatoire',
            'valid_email' => 'Adresse e-mail invalide'
        ],
        'password' => [
            'required' => 'Mot de passe obligatoire',
            'length' => 'Email ou mot de passe incorrect',
            'incorrect' => 'Oups ! Mot de passe invalide.'
        ],
        'account' => [
            'verify' => ["redirect" => "/{key}"],
            'active' => 'Votre compte est déjà activé',
            'inactivated' => 'Votre compte est inactif. Merci de contacter l’administrateur.',
            // 'inactivated' => 'Oups ! Votre compte est bloqué. Contactez l’administrateur pour résoudre le problème.',
            'unknown' => 'Statut de compte inconnu {status}. Veuillez contacter le support.',
            'blocked' => 'Votre compte est suspendu ou bloqué. Merci de contacter l’administrateur.'
        ],
        'otp' => [
            'required' => 'Code obligatoire',
            'not_found' => 'Code invalide',
            'invalid' => 'Code expiré',
            'wait_before_resend' => 'Veuillez patienter {min} minutes avant de demander un nouveau code.'
        ]
    ]
];