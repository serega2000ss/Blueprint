<h2>Contact Us</h2>

<?php include_partial('home/notice', array()) ?>
<?php include_partial('home/error', array()) ?>

<form  name="<?php echo($form->getName()) ?>" method="post" action="<?php echo url_for("@contact_us") ?>">
    <?php include_partial('contact_us/form', array('form' => $form)) ?>
    <input type="submit" value="Send Post"/>
</form>
