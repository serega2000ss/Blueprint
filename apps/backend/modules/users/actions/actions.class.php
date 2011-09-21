<?php

require_once dirname(__FILE__).'/../lib/usersGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/usersGeneratorHelper.class.php';

/**
 * users actions.
 *
 * @package    blueprint
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usersActions extends autoUsersActions
{

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $sf_guard_user = $form->save();
            } catch (Doctrine_Validator_Exception $e) {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
                foreach ($errorStack as $field => $errors) {
                    $message .= "$field (" . implode(", ", $errors) . "), ";
                }
                $message = trim($message, ', ');

                $this->getUser()->setFlash('error', $message);
                return sfView::SUCCESS;
            }

            $this->sendNotification($form);

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $sf_guard_user)));

            if ($request->hasParameter('_save_and_add'))
            {
                $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

                $this->redirect('@users_new');
            }
            else
            {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'users_edit', 'sf_subject' => $sf_guard_user));
            }
        }
        else
        {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }


    protected function sendNotification(sfForm $form)
    {
        if($form->getValue('send_email')) {

            $message = $this->getMailer()->compose(
                array(sfConfig::get('app_email_notification_from_email', 'blueprint@admin.com') => sfConfig::get('app_email_notification_from_name', 'Blueprint')),
                $form->getValue('email_address'),
                sfConfig::get('app_email_notification_title', 'Registration notification'),
                $this->_filterMessage(sfConfig::get('app_email_notification_message', ''), $form)
            );

            try {
                $this->getMailer()->send($message);
                $this->getUser()->setFlash('notice', 'Email notification have been sent.');
            } catch (Exception $e) {
                $this->getUser()->setFlash('error', 'Error sending mail: '.$e->getMessage());
            }

        }
    }

    private function _filterMessage($message, sfForm $form)
    {
        $filter_array = array(
            "%password%" => $form->getValue('password')
        );

        foreach($filter_array as $search => $replace){
            $message = str_replace($search, $replace, $message);
        }

        return $message;
    }


}
