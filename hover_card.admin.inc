<?php

/**
 * @file
 * Hover Card module admin inc file.
 *
 * Contains admin configuration page callback functions.
 */

/**
 * Form builder; Configure hover card settings for this site.
 *
 * @ingroup forms
 * @see system_settings_form()
 */
function hover_card_settings() {
  $form['personalization'] = array(
    '#type' => 'fieldset',
    '#title' => t('Personalization'),
  );
  $form['personalization']['user_email_display_status'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Emails.'),
    '#default_value' => variable_get('user_email_display_status', TRUE),
  );

  return system_settings_form($form);
}
