<?php

/**
 * @file
 * theme-settings.php
 */

/**
 * Include theme common function.
 */
include_once './' . drupal_get_path('theme', 'govstrap') . '/includes/common.inc';

/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * @param $form
 * @param $form_state
 * @param null $form_id
 */
function govstrap_form_system_theme_settings_alter(&$form, $form_state, $form_id = NULL) {
  // @see https://drupal.org/node/943212
  $theme = !empty($form_state['build_info']['args'][0]) ? $form_state['build_info']['args'][0] : FALSE;
  if (isset($form_id) || $theme === FALSE || !in_array('govstrap', _govstrap_get_base_themes($theme, TRUE))) {
    return;
  }

  // Horizontal tabs container
  $form['group_tabs'] = array(
    '#weight' => -99,
    '#type' => 'vertical_tabs',
    '#attached' => array(
      'library' => array(
        array(
          'field_group',
          'horizontal-tabs',
          'vertical-tabs',
        ),
      ),
    ),
  );

  // Default tab.
  $form['group_tab_default'] = array(
    '#type' => 'fieldset',
    '#title' => t('Theme settings'),
    '#group' => 'group_tabs',
  );

  // Set default tab.
  foreach ($form as $k => $v) {
    if ($k == 'group_tabs') {
      continue;
    }
    if ($k !== 'group_tab_default') {
      $form['group_tab_default'][$k] = $form[$k];
      $form['group_tab_default'][$k]['#group'] = 'group_tab_default';
      unset($form[$k]);
    }
  }

  // Bootstrap settings.
  $form['bootstrap'] = array(
    '#type' => 'fieldset',
    '#title' => t('Bootstrap'),
    '#description' => t("Bootstrap settings."),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'group_tabs',
  );

  $form['bootstrap']['bootstrap_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable bootstrap'),
    '#default_value' => theme_get_setting('bootstrap_enabled'),
  );

  $form['bootstrap']['bootstrap_cdn'] = array(
    '#type' => 'fieldset',
    '#title' => t('BootstrapCDN'),
    '#group' => 'bootstrap',
    '#states' => array(
      'invisible' => array(
        // If the checkbox is not enabled, show the container.
        'input[name="bootstrap_enabled"]' => array('checked' => FALSE),
      ),
    ),
  );

  $form['bootstrap']['bootstrap_cdn']['bootstrap_css_cdn'] = array(
    '#type' => 'select',
    '#title' => t('BootstrapCDN Complete CSS version'),
    '#options' => drupal_map_assoc(array(
      '3.3.6',
    )),
    '#default_value' => theme_get_setting('bootstrap_css_cdn'),
    '#empty_option' => t('Disabled'),
    '#empty_value' => NULL,
  );

  $form['bootstrap']['bootstrap_cdn']['bootstrap_js_cdn'] = array(
    '#type' => 'select',
    '#title' => t('BootstrapCDN Complete JavaScript version'),
    '#options' => drupal_map_assoc(array(
      '3.3.6',
    )),
    '#default_value' => theme_get_setting('bootstrap_js_cdn'),
    '#empty_option' => t('Disabled'),
    '#empty_value' => NULL,
  );

  // Fontawesome settings.
  $form['fontawesome'] = array(
    '#type' => 'fieldset',
    '#title' => t('Font Awesome'),
    '#description' => t("Font Awesome settings."),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'group_tabs',
  );

  $form['fontawesome']['fontawesome_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Font Awesome'),
    '#default_value' => theme_get_setting('fontawesome_enabled'),
  );

  $form['fontawesome']['fontawesome_cdn'] = array(
    '#type' => 'fieldset',
    '#title' => t('Font Awesome CDN'),
    '#group' => 'fontawesome',
    '#states' => array(
      'invisible' => array(
        // If the checkbox is not enabled, show the container.
        'input[name="fontawesome_enabled"]' => array('checked' => FALSE),
      ),
    ),
  );

  $form['fontawesome']['fontawesome_cdn']['fontawesome_css_cdn'] = array(
    '#type' => 'select',
    '#title' => t('Font Awesome CDN Complete CSS version'),
    '#options' => drupal_map_assoc(array(
      '4.6.3',
    )),
    '#default_value' => theme_get_setting('fontawesome_css_cdn'),
    '#empty_option' => t('Disabled'),
    '#empty_value' => NULL,
  );

  // Accessibility and support settings.
  $form['support'] = array(
    '#type' => 'fieldset',
    '#title' => t('Accessibility and support'),
    '#description' => t("Accessibility and support settings."),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'group_tabs',
  );

  $form['support']['govstrap_skip_link_anchor'] = array(
    '#type' => 'textfield',
    '#title' => t('Anchor ID for the “skip link”'),
    '#default_value' => theme_get_setting('govstrap_skip_link_anchor'),
    '#field_prefix' => '#',
    '#description' => t('Specify the HTML ID of the element that the accessible-but-hidden “skip link” should link to. Note: that element should have the <code>tabindex="-1"</code> attribute to prevent an accessibility bug in webkit browsers. (<a href="!link">Read more about skip links</a>.)', array('!link' => 'https://drupal.org/node/467976')),
  );

  $form['support']['govstrap_skip_link_text'] = array(
    '#type' => 'textfield',
    '#title' => t('Text for the “skip link”'),
    '#default_value' => theme_get_setting('govstrap_skip_link_text'),
    '#description' => t('For example: <em>Jump to navigation</em>, <em>Skip to content</em>'),
  );

  // Development settings.
  $form['development'] = array(
    '#type' => 'fieldset',
    '#title' => t('Development'),
    '#description' => t("Development settings."),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'group_tabs',
  );

  $form['development']['govstrap_rebuild_registry'] = array(
    '#type' => 'checkbox',
    '#title' => t('Rebuild theme registry on every page.'),
    '#default_value' => theme_get_setting('govstrap_rebuild_registry'),
    '#description' => t('During theme development, it can be very useful to continuously <a href="!link">rebuild the theme registry</a>. WARNING: this is a huge performance penalty and must be turned off on production websites.', array('!link' => 'https://drupal.org/node/173880#theme-registry')),
  );
}
