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
                $this->getUser()->setFlash('notice', 'You have been successfully registered.', false);

                $this->redirect("@homepage");
            }
            else
            {
                $this->getUser()->setFlash('error', 'The form is invalid', false);
            }
        }

    }
}
