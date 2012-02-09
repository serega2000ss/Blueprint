<fieldset>

    <?php echo($form->renderHiddenFields()) ?>
    <?php echo($form->renderGlobalErrors()) ?>

    <dl>
        <?php include_partial('registration/field', array('field' => $form['password'])) ?>
        <?php include_partial('registration/field', array('field' => $form['password_again'])) ?>
    <dl>

</fieldset>
