<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Axproo - {title}</title>
    <style>
        td.hTable-text {
            color: white;
            width: 70%;
        }

        .email-header {
            display: flex;
        }

        .email-header img {
            width: 80px;
            /* Taille du logo */
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 5px;
        }

        .footer a {
            color: #004d99;
            text-decoration: none;
        }

        .header-text {
            font-size: 26px;
            font-weight: bold;
            line-height: 1.3;
            padding-top: 10px;
        }

        .header-subtext {
            font-size: 16px;
            margin-top: 10px;
            padding: 10px;
            font-weight: normal;
            opacity: 0.85;
        }

        .security-alert {
            background-color: rgb(170, 169, 166);
            color: #333;
            font-weight: bold;
            padding: 15px;
            border-radius: 5px;
            margin-top: 30px;
            text-align: justify;
        }
    </style>
</head>

<body style="background-color: #f8f9fa; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
                    <tr>
                        <td align="center" style="padding: 0px;">
                            <img src="{image}" alt="Axproo Logo" width="100%">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px; font-family: Arial, sans-serif; color: #333333;" colspan="2">
                            <h2 style="margin-top: 0;">Votre code de vérification</h2>
                            <p>Bonjour {name},</p>
                            <p style="text-align: justify; margin-bottom: 0px;">Merci pour votre inscription sur Axproo.</p>
                            <p style="text-align: justify; margin-top: 4px;">Pour finaliser votre inscription, veuillez entrer le code suivant dans notre application pour activer votre compte :</p>

                            <div style="text-align: center; margin: 30px 0;">
                                <span style="display: block; padding: 15px 30px; background-color: #28a745; color: #ffffff; font-size: 24px; border-radius: 8px; letter-spacing: 2px;">
                                    {code}
                                </span>
                            </div>
                            
                            <div class="footer">
                                <p>Utilisez ce code pour activer votre compte. Ce code expirera dans 15 minutes.</p>
                                <p><a href="https://www.axproo.fr/abus">Si vous n'avez pas demandé cette vérification, vous pouvez ignorer cet email.</a></p>
                            </div>

                            <div class="security-alert">
                                <p><strong>Alerte sécurité !</strong></p>
                                <p>Ne communiquez jamais votre identifiant compte, votre code personnel ou tout autre code de sécurité par téléphone ou par email. Aucun interlocuteur se présentant comme un collaborateur du Groupe Axproo ou l’un de ses prestataires n’est autorisé à vous contacter pour vous demander vos données de connexion ou vos informations de type identifiant, mot de passe ou code de validation.</p>
                            </div>

                            <p style="margin-top: 30px;">Cordialement,<br><b>L'équipe Axproo</b></p>
                        </td>
                    </tr>
                    <tr style="background-color: #f1f1f1;">
                        <td align="center" style="padding: 20px; font-family: Arial, sans-serif; font-size: 12px; color: #777777;" colspan="2">
                            © {year} Axproo. {copyright}.
                            <br>{submessage}.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>