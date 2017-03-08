<?php

/**
 * @file
 * Contains \Drupal\hover_card\Controller\DefaultController.
 */

namespace Drupal\hover_card\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Default controller for the hover_card module.
 */
class DefaultController extends ControllerBase {

  public function hover_card(\Drupal\user\UserInterface $user = NULL) {
    $name = $mail = $roles = $picture = "";
    $name = $user->getAccountName();

    if ($user->getEmail() && \Drupal::config('hover_card.settings')->get('email_display_status_value')) {
      $mail = $user->getEmail();
    }
//    if ($user->get('user_picture')->entity->url()) {
//      $user_picture = $user->get('user_picture')->entity->url();
//    }
    $uid = $user->id();
    if ($uid) {
      $user_load = \Drupal\user\Entity\User::load($uid);
      if (!empty($user_load->user_picture) && $user_load->user_picture->isEmpty() === FALSE) {
        $image = $user_load->user_picture->first();
        $rendered = \Drupal::service('renderer');
//        @todo: Fix this
//        Fatal error: Cannot use object of type Drupal\image\Plugin\Field\FieldType\ImageItem as array in C:\xampp\htdocs\drupal-8.2.5\core\lib\Drupal\Core\Render\Renderer.php on line 212
//        ->renderPlain($image);
      }
    }

    foreach ($user->getRoles() as $value) {
      $roles = $value;
    }

    $user_data = [
      'name' => \Drupal\Component\Utility\SafeMarkup::checkPlain($name),
      'mail' => \Drupal\Component\Utility\SafeMarkup::checkPlain($mail),
//      'picture' => $user_picture,
      'roles' => \Drupal\Component\Utility\SafeMarkup::checkPlain($roles),
    ];

    $hover_card_template_build = array(
      '#theme' => 'hover_card_template',
      '#details' => $user_data,
    );

    $hover_card_template = drupal_render($hover_card_template_build);

    return array(
      '#markup' => $hover_card_template,
    );
  }

}
