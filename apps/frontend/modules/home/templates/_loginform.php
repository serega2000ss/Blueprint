<?php use_helper('I18N') ?>


<?php
    if(!$user->isAuthenticated()):
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
        Hello, <?php echo $user->getUsername(); ?>!
        <a href="<?php echo url_for('@profile') ?>">profile</a>
        <a href="<?php echo url_for('@sf_guard_signout') ?>">logout</a>
<?php
    endif;
?>