<?php if ($sf_user->hasFlash('notice')): ?>
    <div class="flash-notice">
        <?php echo $sf_user->getFlash('notice') ?>
    </div>
<?php endif; ?>
