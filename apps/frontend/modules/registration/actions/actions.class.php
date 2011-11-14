<?php

/**
 * registration actions.
 *
 * @package    blueprint
 * @subpackage registration
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class registrationActions extends sfActions
{
    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {
        $this->form = new RegistrationForm();

        if($request->isMethod("post"))
        {
            $this->form->bind($request->getParameter($this->form->getName()));
            if($this->form->isValid())
            {
                $this->form->save();

                if($this->sendActivationLink($this->form)) {
                    $this->getUser()->setFlash('notice', ' Please check your email to finish registration.');
                } else {
                    $this->form->getObject()->delete();
                    $this->getUser()->setFlash('error', 'Registration error.');
                }

                $this->redirect("@registration_proceed");
            }
            else
            {
                $this->getUser()->setFlash('error', 'The form is invalid', false);
            }
        }

    }

    public function executeRegistrationProceed(sfWebRequest $request)
    {
    }

    public function executeActivate(sfWebRequest $request)
    {
        $code = $request->getUrlParameter('code', null);

        if($code != null)
        {
            if($user = sfGuardUserTable::getUserByCode($code))
            {
                $user->activateWithCode();
                $this->getUser()->setFlash('notice', 'You account was activated.');
            }
            else
            {
                $this->getUser()->setFlash('error', 'Activation code is invalid.');
            }
        }
    }

    protected function sendActivationLink(sfForm $form)
    {

        $message = $this->getMailer()->compose(
            array(sfConfig::get('app_email_notification_from_email', 'blueprint@admin.com') => sfConfig::get('app_email_notification_from_name', 'Blueprint')),
            $form->getValue('email_address'),
            sfConfig::get('app_email_notification_title', 'Registration notification'),
            $this->_filterMessage(sfConfig::get('app_email_notification_message', ''), $form)
        );

        try {
            $this->getMailer()->send($message);
            return true;
        } catch (Exception $e) {
            return false;
        }

    }

    private function _filterMessage($message, sfForm $form)
    {
        sfContext::getInstance()->getConfiguration()->loadHelpers('Url');

        $code = $form->getObject()->getActivationCode()->getCode();

        $filter_array = array(
            "%password%"        => $form->getValue('password'),
            "%activation_link%" => url_for("@registration_activate?code=$code", true)
        );

        foreach($filter_array as $search => $replace){
            $message = str_replace($search, $replace, $message);
        }

        return $message;
    }

}
