<dl>
    <dt>First Name:</dt>
    <dd class="bold"><?php echo $user->getFirstName(); ?></dd>
</dl>

<dl>
    <dt>Last Name:</dt>
    <dd class="bold"><?php echo $user->getLastName(); ?></dd>
</dl>

<dl class="email">
  <dt>Contact E-mail:</dt>
  <dd><?php echo $user->getEmailAddress(); ?></dd>
</dl>

