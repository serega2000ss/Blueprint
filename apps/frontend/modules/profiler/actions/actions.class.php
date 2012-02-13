<?php

/**
 * profiler actions.
 *
 * @package    blueprint
 * @subpackage profiler
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profilerActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */

    public function executeIndex(sfWebRequest $request)
    {
        $this->user = $this->getUser()->getGuardUser();
    }

    public function executeEditProfile(sfWebRequest $request)
    {
        $this->form = new ProfileForm($this->getUser()->getGuardUser());
        if ($request->isMethod(sfRequest::POST))
        {
            $this->form->bind($request->getParameter($this->form->getName()));
            if($this->form->isValid())
            {
                $this->form->save();
                $this->getUser()->setFlash('notice', "You successfully update your profile");
                $this->redirect('profile');
            }
        }
    }

    public function executePassChange(sfWebRequest $request)
    {
        $this->form = new PasswordForm();
        if ($request->isMethod(sfRequest::POST))
        {
            $this->form->bind($request->getParameter($this->form->getName()));
            if($this->form->isValid())
            {
                $user = Doctrine_Core::getTable('sfGuardUser')->find(1);
                $user->setPassword($this->form->getValue('password'));
                $user->save();

                $this->executeEmailNotification($this->form);

                $this->getUser()->setFlash('notice', "You successfully change your password");
                $this->redirect('profile');
            }
        }
    }

    protected function executeEmailNotification(sfForm $form)
    {
        $message = $this->getMailer()->compose(
            array(sfConfig::get('app_email_notification_from_email', 'blueprint@admin.com') => sfConfig::get('app_email_notification_from_name', 'Blueprint')),
            $this->getUser()->getGuardUser()->getEmailAddress(),
            sfConfig::get('app_password_notification_title', 'Password change notification'),
            $this->_filterMessage(sfConfig::get('app_password_notification_message', ''), $form)
        );

        try {
            $this->getMailer()->send($message);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function _filterMessage($message, $form)
    {
        sfContext::getInstance()->getConfiguration()->loadHelpers('Url');

        $filter_array = array(
            "%password%"        => $form->getValue('password'),
        );

        foreach($filter_array as $search => $replace){
            $message = str_replace($search, $replace, $message);
        }

        return $message;
    }
}
