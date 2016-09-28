<?php

/**
 * @file
 * alter.inc
 */

/**
 * Implements hook_css_alter().
 */
function govstrap_css_alter(&$css) {
  if (theme_get_setting('bootstrap_enabled') && !theme_get_setting('bootstrap_css_cdn')) {
    $theme_path = drupal_get_path('theme', 'govstrap');
    // Add bootstrap style file.
    $bootstrap = $theme_path . '/css/govstrap-bootstrap.css';
    // Add bootstrap css.
    $css[$bootstrap] = array(
      'data' => $bootstrap,
      'type' => 'file',
      'every_page' => TRUE,
      'media' => 'all',
      'preprocess' => TRUE,
      'group' => CSS_THEME,
      'browsers' => array('IE' => TRUE, '!IE' => TRUE),
      'weight' => -1,
    );
  }

  // Exclude css
  if (!empty($excludes)) {
    $css = array_diff_key($css, drupal_map_assoc($excludes));
  }
}

/**
 * Implements hook_js_alter().
 */
function govstrap_js_alter(&$js) {
  $theme_path = drupal_get_path('theme', 'govstrap');

  // Ensure jQuery Once is always loaded.
  // @see https://drupal.org/node/2149561
  if (empty($js['misc/jquery.once.js'])) {
    $jquery_once = drupal_get_library('system', 'jquery.once');
    $js['misc/jquery.once.js'] = $jquery_once['js']['misc/jquery.once.js'];
    $js['misc/jquery.once.js'] += drupal_js_defaults('misc/jquery.once.js');
  }

  // jQuery update.
  $node_admin_paths = array(
    'node/*/edit',
    'node/add',
    'node/add/*',
  );
  $replace_jquery = TRUE;
  if (path_is_admin(current_path())) {
    $replace_jquery = FALSE;
  }
  else {
    foreach ($node_admin_paths as $node_admin_path) {
      if (drupal_match_path(current_path(), $node_admin_path)) {
        $replace_jquery = FALSE;
      }
    }
  }
  // Swap out jQuery to use an updated version of the library.
  if ($replace_jquery) {
    $js['misc/jquery.js']['data'] = $theme_path . '/js/jquery.min.js';
    // CDN.
    $js['misc/jquery.js']['version'] = '1.9.1';
  }

  // Load bootstrap js
  if (theme_get_setting('bootstrap_enabled') && !theme_get_setting('bootstrap_js_cdn')) {
    $bootstrap = $theme_path . '/js/bootstrap.min.js';
    $js[$bootstrap] = drupal_js_defaults($bootstrap);
    $js[$bootstrap]['group'] = JS_THEME;
    $js[$bootstrap]['scope'] = 'footer';
  }

  // Exclude js
  if (!empty($excludes)) {
    $js = array_diff_key($js, drupal_map_assoc($excludes));
  }
}

/**
 * Implements hook_js_callback_filter_xss_alter().
 */
function govstrap_js_callback_filter_xss_alter(array &$allowed_tags = array()) {
  $allowed_tags[] = 'button';
}
