<dt><?php echo $field->renderLabel() ?></dt>
<dd><?php echo render_captcha_image() ?></dd>
<dt></dt>
<dd>
    <?php echo $field->render() ?>
    <?php echo $field->renderError() ?>
</dd>
