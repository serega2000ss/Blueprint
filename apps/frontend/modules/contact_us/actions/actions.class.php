<?php

/**
 * contact_us actions.
 *
 * @package    blueprint
 * @subpackage contact_us
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contact_usActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {
        $this->form = new ContactUsForm();

        if ($request->isMethod(sfRequest::POST)){
            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid()){
                if($this->executeEmailSend($this->form))
                {
                    $this->getUser()->setFlash('notice', "Your post was successfully sent");
                } else {
                    $this->getUser()->setFlash('notice', "Sorry but your post was not sent");
                }
                $this->redirect('@contact_approv');
            }
        }
    }

    protected function executeEmailSend(sfForm $form)
    {
        $message = $this->getMailer()->compose(
            array($form->getValue('email_address') => ($form->getValue('username') != "" ? $form->getValue('username')  : sfConfig::get('app_contact_us_default_username', 'Guest'))),
            array(sfConfig::get('app_email_notification_from_email', 'blueprint@admin.com') => sfConfig::get('app_email_notification_from_name', 'Blueprint')),
            ($form->getValue('subject') != "" ? $form->getValue('subject')  : sfConfig::get('app_contact_us_default_subject', 'Contact Us Message')),
            $form->getValue('message')
        );

        try {
            $this->getMailer()->send($message);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function executeEmailApprov()
    {
    }
}
