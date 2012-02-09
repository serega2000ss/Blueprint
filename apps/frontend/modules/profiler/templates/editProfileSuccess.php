<h2>Edit Profile</h2>

<?php include_partial('home/notice', array()) ?>
<?php include_partial('home/error', array()) ?>

<form  name="<?php echo($form->getName()) ?>" method="post" action="<?php echo url_for("@edit_profile") ?>">
    <?php include_partial('profiler/profile_form', array('form' => $form)) ?>
    <input type="submit" value="Edit Profile"/>
    <input type="button" value="Cancel" onClick="parent.location='profile'"/>
</form>