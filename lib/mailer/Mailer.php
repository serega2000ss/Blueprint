<?php
class Mailer extends sfActions
{
     public static function sendEmail($to_address, $name, $subject, $email_html, $email_text, $filename=''){
        $transport = Swift_SmtpTransport::newInstance(sfConfig::get('app_smtp_host'), sfConfig::get('app_smtp_port'));
        $mailer = Swift_Mailer::newInstance($transport);
        $message = Swift_Message::newInstance($subject);
        $ok = true;

        foreach ($to_address as $email_to){
          $mail_sent = true;
          $message->setFrom(array($email_to => $name));
          $message->setTo(array(sfConfig::get('app_email_notification_from_email') => sfConfig::get('app_email_notification_from_name')));
          $message->setBody($email_text);
          $message->addPart($email_html, 'text/html');

          if ($filename != '') {
            $message->attach(Swift_Attachment::fromPath(sfConfig::get('sf_web_dir').$filename));
          }
          $result = $mailer->send($message);
          
          if (!$result){
            $mail_sent = false;
          }
          $ok = $ok && $mail_sent;
        }
        return $ok;
     }
}
?>