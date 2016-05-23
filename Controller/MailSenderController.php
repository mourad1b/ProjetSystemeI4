<?php
/**
 * MailSenderController.php
 */

namespace nsNewsletter\Controller;

class MailSenderController
{
    public function send($subject, $message, $mail_destinataire,  $params = null)
    {
        require '../Lib/PHPMailer/PHPMailerAutoload.php';
        $mail = new \PHPMailer();

        //$mail->SMTPDebug = 3;                                                 // Enable verbose debug output

        $mail->isSMTP();                                                        // Set mailer to use SMTP
        $mail->Host = 'smtp.live.com';                                          // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                                                 // Enable SMTP authentication
        $mail->Username = 'news.projet@hotmail.com';                            // SMTP username
        $mail->Password = 'Epsi2015';                                           // SMTP password
        $mail->SMTPSecure = 'tls';                                              // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // 587   465                                         // TCP port to connect to

        $mail->setFrom('news.projet@hotmail.com', 'Projet Service Newsletter');
        //$mail->addAddress('news.projet@hotmail.com', 'Mourad');               // Add a recipient

        if(!empty($mail_destinataire)){
            $mail->addAddress($mail_destinataire);                                  // Name is optional
        }

        if(!empty($params['users'])) {
            foreach ($params['users'] as $mailUser) {
                $mail->addAddress($mailUser);
            }
        }

        $mail->addReplyTo('news.projet@hotmail.com', 'Information - Service Newsletter');

        $mail->isHTML(true);                                                    // Set email format to HTML

        $mail->Subject = $subject;                                              // 'Here is the subject';
        $mail->Body    = $message;                                              //'This is the HTML message body <b>in bold!</b>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

}

