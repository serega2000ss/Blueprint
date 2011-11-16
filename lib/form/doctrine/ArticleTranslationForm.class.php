<?php

/**
 * ArticleTranslation form.
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ArticleTranslationForm extends BaseArticleTranslationForm
{
    public function configure()
    {
        $this->widgetSchema['description'] = new isicsWidgetFormTinyMCE(array('tiny_options' => sfConfig::get('app_tiny_mce_my_settings_description', array())));
        $this->widgetSchema['content'] = new isicsWidgetFormTinyMCE(array('tiny_options' => sfConfig::get('app_tiny_mce_my_settings_content', array())));
    }
}
