<?php
namespace Drupal\hover_card;

class HoverCardSettings extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'hover_card_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('hover_card.settings');

    foreach (Element::children($form) as $variable) {
      $config->set($variable, $form_state->getValue($form[$variable]['#parents']));
    }
    $config->save();

    if (method_exists($this, '_submitForm')) {
      $this->_submitForm($form, $form_state);
    }

    parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['hover_card.settings'];
  }

  public function buildForm(array $form, \Drupal\Core\Form\FormStateInterface $form_state) {
    $form['personalization'] = [
      '#type' => 'fieldset',
      '#title' => t('Personalization'),
    ];
    $form['personalization']['hover_card_user_email_display_status'] = [
      '#type' => 'checkbox',
      '#title' => t('Enable User Emails on Hover'),
      '#default_value' => \Drupal::config('hover_card.settings')->get('hover_card_user_email_display_status'),
    ];

    return parent::buildForm($form, $form_state);
  }

}
