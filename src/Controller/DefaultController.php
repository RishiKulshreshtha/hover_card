<?php

namespace Drupal\hover_card\Controller;

use Drupal\Component\Utility\SafeMarkup;
use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Default controller for the hover_card module.
 */
class DefaultController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function hoverCard(UserInterface $user = NULL) {
    $name = $mail = $roles = $picture = "";
    $name = $user->getAccountName();

    if ($user->getEmail() && \Drupal::config('hover_card.settings')->get('email_display_status_value')) {
      $mail = $user->getEmail();
    }

    $uid = $user->id();
    if ($uid) {
      if (!$user->user_picture->isEmpty()) {
        $picture = $user->user_picture->view('thumbnail');
      }
    }

    foreach ($user->getRoles() as $value) {
      $roles = $value;
    }

    $user_data = [
      'name' => SafeMarkup::checkPlain($name),
      'mail' => SafeMarkup::checkPlain($mail),
      'picture' => $picture,
      'roles' => SafeMarkup::checkPlain($roles),
    ];

    $hover_card_template_build = [
      '#theme' => 'hover_card_template',
      '#details' => $user_data,
    ];

    $hover_card_template = drupal_render($hover_card_template_build);

    $response = new Response();
    $response->setContent($hover_card_template);
    return $response;
  }

}
