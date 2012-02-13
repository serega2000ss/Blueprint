<?php use_helper('I18N') ?>

<?php
    if(!$user_isAuthenticated):
?>
<div id="loginform">
    <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
        <p>
            <?php echo $form; ?>
        </p>
        <p>
            <input type="submit"/>
        </p>
    </form>
</div>
<?php
    else:
?>
        Hello, you are now logged in.
        <a href="<?php echo url_for('@sf_guard_signout') ?>">logut</a>
<?php
    endif;
?>