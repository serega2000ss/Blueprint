<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardUserAdminForm extends BasesfGuardUserAdminForm
{
  /**
   * @see sfForm
   */
    public function configure()
    {
        unset(
          $this['groups_list'],
          $this['permissions_list']
        );

        if($this->isNew()) {
            $this->widgetSchema['send_email'] = new sfWidgetFormInputCheckbox();
            $this->validatorSchema['send_email'] = new sfValidatorBoolean(array('required' => false));
            $this->widgetSchema['send_email']->setLabel('Send email with credentials');
        }
    }
}
