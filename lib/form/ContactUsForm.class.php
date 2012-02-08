<?php

class ContactUsForm extends BaseForm
{
    public function setup()
    {
        $this->setWidgets(array(
            'name'      => new sfWidgetFormInputText(),
            'from'      => new sfWidgetFormInputText(),
            'subject'   => new sfWidgetFormInputText(),
            'body'      => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'name'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'from'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'subject'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'body'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
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

        $this->widgetSchema['body'] = new sfWidgetFormTextarea(array('label' => "Text Message:"));

        $this->setValidators(array(
            'name' => new sfValidatorString(array('max_length' => 255, 'required' => false)),

            'from' => new sfValidatorEmail(array(),array(
                'required'   => 'Email field can\'t be empty.',
                'invalid'    => 'Please provide a valid email address. You can use only one email.'
            )),

            'body' => new sfValidatorString(array('max_length' => 255, 'required' => true),array(
                'required'   => 'Message field can\'t be empty'
            )),

            'subject'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->validatorSchema['from']->setOption('required', true);

        $this->widgetSchema['captcha'] = new sfWidgetCaptchaGD();
        $this->validatorSchema['captcha'] = new sfCaptchaGDValidator(array('length' => 4));

    }
}
