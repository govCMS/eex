<?php

/**
 * @file
 * Menu templates.
 */

/**
 * @param $variables
 * @return string
 */
function govstrap_menu_tree__main_menu($variables) {
  return '<ul class="nav nav-tabs">' . $variables['tree'] . '</ul>';
}

/**
 * @param $variables
 * @return string'
 */
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

/**
 * @param $variables
 * @return string
 */
function govstrap_menu_tree__menu_footer_sub_menu($variables) {
  return '<ul class="list-inline small-links">' . $variables['tree'] . '</ul>';
}

/**
 * @param $variables
 * @return string
 */
function govstrap_menu_tree__menu_top_menu($variables) {
  return '<ul class="list-inline small-links">' . $variables['tree'] . '</ul>';
}

/*
 * Note: we add the fancy bottom part of the menu in javascript, see scripts.js
 */
function govstrap_menu_tree__menu_block__1($variables) {
  return '<ul class="nav nav-pills nav-stacked">' . $variables['tree'] . '</ul>';
}
