<h2>Registration</h2>

<?php include_partial('home/notice', array()) ?>
<?php include_partial('home/error', array()) ?>

<form  name="<?php echo($form->getName()) ?>" method="post" action="<?php echo url_for("@registration") ?>">
    <?php include_partial('registration/form', array('form' => $form)) ?>
    <input type="submit" value="Register"/>
</form>
