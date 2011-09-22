<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ss
 * Date: 9/22/11
 * Time: 10:20 AM
 * To change this template use File | Settings | File Templates.
 */
 
class RegistrationForm extends BasesfGuardUserAdminForm
{
    /**
     * @see sfForm
     */
    public function setup()
    {
        parent::setup();

        unset(
          $this['is_active'],
          $this['is_super_admin'],
          $this['groups_list'],
          $this['permissions_list']
        );
    }
}