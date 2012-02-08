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
              $data = $request->getPostParameter($this->form->getName());

              $result = Mailer::sendEmail(array($data['from']), ($data['name'] != '' ? $data['name'] : 'guest'), $data['subject'], $data['body'], '');
              if($result)
              {
                  $this->getUser()->setFlash('notice', "Your post was successfully sent");
              } else {
                  $this->getUser()->setFlash('notice', "Sorry but your post was not sent");
              }

              $this->redirect('@contact_approv');
          }
      }
  }

  public function executeEmailApprov()
  {

  }

}
