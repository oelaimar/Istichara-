<?php
namespace services;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer{

    public static function sendWelcomeEmail($email, $name, $role)
    {
        $mail = new PHPMailer(true);

        try {
            // Configuration SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'safaachtaoui@gmail.com'; // email expéditeur
            $mail->Password   = 'mdp'; // PAS ton vrai mdp
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Expéditeur & destinataire
            $mail->setFrom('safaachtaoui@gmail.com', 'Plateforme Juridique');
            $mail->addAddress($email, $name);

            // Contenu
            $mail->isHTML(true);
            $mail->Subject = 'Inscription réussie';
            $mail->Body    = "
                <h3>Bienvenue $name</h3>
                <p>Votre inscription en tant que <strong>$role</strong> a été effectuée avec succès.</p>
                <p>Notre équipe validera votre compte prochainement.</p>
            ";

            $mail->send();
        } catch (Exception $e) {
            error_log('Erreur email : ' . $mail->ErrorInfo);
        }
    }
}
