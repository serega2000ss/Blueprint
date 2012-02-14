<form action="<?php echo url_for('@search') ?>" method="get" class="search-controls">
  <?php echo $form['query'] ?>
  <input type="submit" name="commit" accesskey="s" value="<?php echo __('Search') ?>" />
</form>