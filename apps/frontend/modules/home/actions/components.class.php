<?php
/**
 * components.class.php
 * User: prof
 * Date: 09.02.12
 * Time: 17:34
 */

  class homeComponents extends sfComponents
  {
      public function executeLoginform(sfWebRequest $request)
      {
          //do something
          $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
          $this->form = new $class();
          $this->user_isAuthenticated = $this->getUser()->isAuthenticated();
      }
  }