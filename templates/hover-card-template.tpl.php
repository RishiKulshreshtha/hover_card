<?php

/**
 * @file
 * This template handles the layout of Hover Card.
 *
 * Variables available:
 * - $details: An array of user details.
 * - $details['name']: Use this to display the name of the user.
 * - $details['mail']: Use this to display the registered e-mail of the user.
 * - $details['picture']: Array which can be used to display picture of the user
 * - $details['role']: Use this to display the role of the user.
 */
?>

<div class="user-details">
  <div class="user-image">
  <?php
  $user_picture = $details['picture'];
  !empty($user_picture) ?	print_r($user_picture) : "";
  ?>
  </div>
    <div class="user-name"><strong>Username: </strong><?php print $details['name']; ?></div>
    <div class="user-mail"><strong>Email: </strong><?php print $details['mail']; ?></div>
    <div class="user-role"><strong>Roles: </strong><?php print $details['roles']; ?></div>
</div>
<?php drupal_exit(); ?>
