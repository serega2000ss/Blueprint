<h2>Change Password</h2>

<?php include_partial('home/notice', array()) ?>
<?php include_partial('home/error', array()) ?>

<form  name="<?php echo($form->getName()) ?>" method="post" action="<?php echo url_for("@pass_change") ?>">
    <?php include_partial('profiler/password_form', array('form' => $form)) ?>
    <input type="submit" value="Change Password"/>
    <input type="button" value="Cancel" onClick="parent.location='profile'"/>
</form>