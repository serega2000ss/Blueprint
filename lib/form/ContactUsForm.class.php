<?php

class ContactUsForm extends BaseForm
{
    public function setup()
    {
        $this->setWidgets(array(
            'username'      => new sfWidgetFormInputText(),
            'email_address' => new sfWidgetFormInputText(),
            'subject'       => new sfWidgetFormInputText(),
            'message'       => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'username'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'email_address' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'subject'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'message'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('contact_us[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        parent::setup();
    }

    public function getModelName()
    {
        return 'Contact_Us';
    }

    public function configure()
    {
        parent::configure();

        $this->setValidators(array(
            'username' => new sfValidatorString(array('max_length' => 255, 'required' => false)),

            'email_address' => new sfValidatorEmail(array(),array(
                'required'   => 'Email field can\'t be empty.',
                'invalid'    => 'Please provide a valid email address. You can use only one email.'
            )),

            'message' => new sfValidatorString(array('max_length' => 255, 'required' => true),array(
                'required'   => 'Message field can\'t be empty'
            )),

            'subject'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->widgetSchema['message'] = new sfWidgetFormTextarea(array('label' => "Text Message:"));

        $this->widgetSchema['captcha'] = new sfWidgetCaptchaGD();
        $this->validatorSchema['captcha'] = new sfCaptchaGDValidator(array('length' => 4));

    }
}
