<?php if ($sf_user->isAuthenticated()): ?>

    Logged In as <a href="<?php echo url_for('@profile') ?>"><?php echo $sf_user->getGuardUser()->getUserName(); ?></a>
    <a href="<?php echo url_for('@sf_guard_signout') ?>">Log Out ›</a>

    <div> <?php echo $sf_user->getFlash('notice') ?> </div>

    <h2>My profile</h2>
    <fieldset>
        <?php include_partial('profiler/profile', array('user' => $user))?>
    </fieldset>

    <input type="button" value="Edit My Profile" onClick="parent.location='edit_profile'" />
    <input type="button" value="Change Password" onClick="parent.location='pass_change'" />

<?php else: ?>
    <?php echo "You need to ".link_to('login', '@sf_guard_signin')." for viewering settings" ?>
<?php endif; ?>