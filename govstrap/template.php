<?php

/**
 * @file
 * template.php
 */

// Auto-rebuild the theme registry during theme development.
if (theme_get_setting('govstrap_rebuild_registry') && !defined('MAINTENANCE_MODE')) {
  // Rebuild .info data.
  system_rebuild_theme_data();
  // Rebuild theme registry.
  drupal_theme_rebuild();
}

/**
 * Implements HOOK_theme().
 */
function govstrap_theme(&$existing, $type, $theme, $path) {
  include_once './' . drupal_get_path('theme', 'govstrap') . '/includes/registry.inc';

  return _govstrap_theme($existing, $type, $theme, $path);
}

/**
 * Clear any previously set element_info() static cache.
 *
 * If element_info() was invoked before the theme was fully initialized, this
 * can cause the theme's alter hook to not be invoked.
 *
 * @see https://www.drupal.org/node/2351731
 */
drupal_static_reset('element_info');

/**
 * Include hook_preprocess_*() hooks.
 */
include_once './' . drupal_get_path('theme', 'govstrap') . '/includes/preprocess.inc';

/**
 * Include hook_process_*() hooks.
 */
include_once './' . drupal_get_path('theme', 'govstrap') . '/includes/process.inc';

/**
 * Include hook_*_alter() hooks.
 */
include_once './' . drupal_get_path('theme', 'govstrap') . '/includes/alter.inc';

/**
 * Include normal theme overwrite.
 */
include_once './' . drupal_get_path('theme', 'govstrap') . '/includes/theme.inc';



function govstrap_menu_tree__main_menu($variables) {
    return '<ul class="nav nav-tabs">' . $variables['tree'] . '</ul>';
}
function govstrap_menu_link__main_menu($variables) {
    //unset all the classes
    if (!empty($element['#attributes']['class'])) {
        foreach ($element['#attributes']['class'] as $key => $class) {
            if ($class != 'active') {
                unset($element['#attributes']['class'][$key]);
            }
        }
    }
    $element = $variables['element'];
    $output = l($element['#title'], $element['#href'], $element['#localized_options']);
    return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . "</li>\n";
}
