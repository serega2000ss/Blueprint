<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ss
 * Date: 9/22/11
 * Time: 10:20 AM
 * To change this template use File | Settings | File Templates.
 */
 
class PasswordForm extends BasesfGuardUserAdminForm
{
    /**
     * @see sfForm
     */
    public function setup()
    {
        parent::setup();

        unset(
          $this['username'],
          $this['first_name'],
          $this['last_name'],
          $this['email_address'],
          $this['is_active'],
          $this['is_super_admin'],
          $this['groups_list'],
          $this['permissions_list']
        );
    }
}