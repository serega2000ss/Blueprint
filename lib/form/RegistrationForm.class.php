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

        $this->widgetSchema['captcha'] = new sfWidgetCaptchaGD();
        $this->validatorSchema['captcha'] = new sfCaptchaGDValidator(array('length' => 4));
    }

    protected function doSave($con = null)
    {
        $this->getObject()->setIsActive(false);

        parent::doSave($con);

        $activation_code = new ActivationCode();
        $activation_code->setUserId($this->getObject()->getId());
        $activation_code->setCode(md5((string) time()));
        $activation_code->save();
    }
}