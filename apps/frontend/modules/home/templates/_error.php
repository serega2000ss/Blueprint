<?php if ($sf_user->hasFlash('error')): ?>
    <div class="flash-error">
        <?php echo $sf_user->getFlash('error') ?>
    </div>
<?php endif; ?>