<?php
namespace Drupal\hover_card;

/**
 * Default controller for the hover_card module.
 */
class DefaultController extends ControllerBase {

  public function hover_card(\Drupal\user\UserInterface $user = []) {
    $picture = [];
    $name = $mail = $roles = "";

    if (!$user->getUsername() && $user->getUsername()) {
      $name = $user->getUsername();
    }

    if (!$user->getEmail() && $user->getEmail() && \Drupal::config('hover_card.settings')->get('hover_card_user_email_display_status')) {
      $mail = $user->getEmail();
    }

    if (isset($user->picture->uri) && !empty($user->picture->uri)) {
      // @FIXME
// theme() has been renamed to _theme() and should NEVER be called directly.
// Calling _theme() directly can alter the expected output and potentially
// introduce security issues (see https://www.drupal.org/node/2195739). You
// should use renderable arrays instead.
// 
// 
// @see https://www.drupal.org/node/2195739
// $picture  = theme('image_style', array(
//       'style_name' => 'thumbnail',
//       'path' => $user->picture->uri,
//      )
//     );

    }

    foreach ($user->roles as $value) {
      $roles = $value;
    }

    $user_data = [
      'name' => \Drupal\Component\Utility\SafeMarkup::checkPlain($name),
      'mail' => \Drupal\Component\Utility\SafeMarkup::checkPlain($mail),
      'picture' => $picture,
      'roles' => \Drupal\Component\Utility\SafeMarkup::checkPlain($roles),
    ];

    // @FIXME
    // theme() has been renamed to _theme() and should NEVER be called directly.
    // Calling _theme() directly can alter the expected output and potentially
    // introduce security issues (see https://www.drupal.org/node/2195739). You
    // should use renderable arrays instead.
    // 
    // 
    // @see https://www.drupal.org/node/2195739
    // return theme('hover_card_template', array('details' => $user_data));

  }

}
