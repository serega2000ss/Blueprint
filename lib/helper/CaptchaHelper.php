<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ss
 * Date: 4/20/11
 * Time: 5:19 PM
 * To change this template use File | Settings | File Templates.
 */
function render_captcha_image()
{
    $context = sfContext::getInstance();
    $url = $context->getRouting()->generate("sf_captchagd");

    return "<a href='' onClick='return false' title='".__("Reload image")."'><img src='$url?".time()."' onClick='this.src=\"$url?r=\" + Math.random() + \"&amp;reload=1\"' border='0' class='captcha' /></a>";
}