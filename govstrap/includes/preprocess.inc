<?php

/**
 * @file
 * preprocess.inc
 */

/**
 * Implements hook_preprocess_html().
 * Override or insert variables into the html template.
 *
 * @param $variables
 * @param $hook
 */
function govstrap_preprocess_html(&$variables, $hook) {
  // Set common variables.
  $variables['base_path'] = base_path();
  $variables['path_to_govstrap'] = drupal_get_path('theme', 'govstrap');

  // Send X-UA-Compatible HTTP header to force IE to use the most recent
  // rendering engine or use Chrome's frame rendering engine if available.
  if (is_null(drupal_get_http_header('X-UA-Compatible'))) {
    drupal_add_http_header('X-UA-Compatible', 'IE=edge,chrome=1');
  }

  // IE8 support of HTML5 elements and media queries.
  $ie_script_r = array(
    '#browsers' => array('IE' => 'lt IE 9', '!IE' => FALSE),
    '#tag' => 'script',
    '#attributes' => array(
      'type' => "text/javascript",
      'src' => './' . $variables['path_to_govstrap'] . '/js/respond.js',
    ),
  );
  drupal_add_html_head($ie_script_r, "govstraprespond");

  // IE8 support of HTML5 elements and media queries .
  $ie_script_s = array(
    '#browsers' => array('IE' => 'lt IE 9', '!IE' => FALSE),
    '#tag' => 'script',
    '#attributes' => array(
      'type' => "text/javascript",
      'src' => './' . $variables['path_to_govstrap'] . '/js/html5shiv.js',

    ),
  );
  drupal_add_html_head($ie_script_s, "govstrapshiv");

  if (theme_get_setting('bootstrap_enabled') && theme_get_setting('bootstrap_css_cdn')) {
    // Add bootstrap style file.
    $bootstrap = 'https://maxcdn.bootstrapcdn.com/bootstrap/' . theme_get_setting('bootstrap_css_cdn') . '/css/bootstrap.min.css';
    drupal_add_css($bootstrap, array('type' => 'external'));
  }

  if (theme_get_setting('fontawesome_enabled') && theme_get_setting('fontawesome_css_cdn')) {
    // Add bootstrap style file.
    $fontawesome = 'https://maxcdn.bootstrapcdn.com/font-awesome/' . theme_get_setting('fontawesome_css_cdn') . '/css/font-awesome.min.css';
    drupal_add_css($fontawesome, array('type' => 'external'));
  }

  if (theme_get_setting('bootstrap_enabled') && theme_get_setting('bootstrap_js_cdn')) {
    // Add bootstrap style file.
    $bootstrap = 'https://maxcdn.bootstrapcdn.com/bootstrap/' . theme_get_setting('bootstrap_js_cdn') . '/js/bootstrap.min.js';
    drupal_add_js($bootstrap, array('type' => 'external'));
  }

  // Accessibility settings.
  $variables['skip_link_anchor'] = check_plain(theme_get_setting('govstrap_skip_link_anchor'));
  $variables['skip_link_text'] = check_plain(theme_get_setting('govstrap_skip_link_text'));

  // Attributes for html element.
  $variables['html_attributes_array'] = array(
    'lang' => $variables['language']->language,
    'dir' => $variables['language']->dir,
  );

  // Return early, so the maintenance page does not call any of the code below.
  if ($hook != 'html') {
    return;
  }

  // Serialize RDF Namespaces into an RDFa 1.1 prefix attribute.
  if ($variables['rdf_namespaces']) {
    $prefixes = array();
    foreach (explode("\n  ", ltrim($variables['rdf_namespaces'])) as $namespace) {
      // Remove xlmns: and ending quote and fix prefix formatting.
      $prefixes[] = str_replace('="', ': ', substr($namespace, 6, -1));
    }
    $variables['rdf_namespaces'] = ' prefix="' . implode(' ', $prefixes) . '"';
  }
}

/**
 * Implements hook_preprocess_page().
 *
 * @param $variables
 *
 * @see page.tpl.php and search_api_page_search_form()
 */
function govstrap_preprocess_page(&$variables) {
  // Set page container columns.
  $variables['container_class'] = 'container';

  // Calculate container columns with sidebar.
  if (!empty($variables['page']['sidebar_first']) && (!empty($variables['page']['sidebar_second']) || !empty($variables['page']['sidebar_second_below']))) {
    $variables['content_column_class'] = 'col-sm-6';
  }
  elseif (!empty($variables['page']['sidebar_first']) || (!empty($variables['page']['sidebar_second']) || !empty($variables['page']['sidebar_second_below']))) {
    $variables['content_column_class'] = 'col-sm-9';
  }
  else {
    $variables['content_column_class'] = 'col-sm-12';
  }

  // Make search API page form available to page.tpl.php
  $page = search_api_page_load(6);
  $search_box = drupal_get_form('search_api_page_search_form_search', $page, NULL, TRUE);
  $search_box['keys_6']['#attributes']['placeholder'] = t('Search this site...');
  $search_box['#attributes']['class'][] = 'container-inline';
  $variables['search_box'] = drupal_render($search_box);
}

/**
 * Preprocess entity.
 *
 * @param $variables
 */
function govstrap_preprocess_entity(&$variables) {
  if ($variables['entity_type'] == 'paragraphs_item') {
    $node = menu_get_object();
    if (!empty($node)) {
      $variables['theme_hook_suggestions'][] = $variables['entity_type'] . '__' . 'views' . '__' . $variables['view_mode'] . '__' . $node->nid;
    }
  }
}

/**
 * Implements hook_preprocess_block().
 */
function govstrap_preprocess_block(&$variables, $hook) {
  // Use a template with no wrapper for the page's main content.
  if ($variables['block_html_id'] == 'block-system-main') {
    $variables['theme_hook_suggestions'][] = 'block__no_wrapper';
  }

  $variables['title_attributes_array']['class'][] = 'block-title';
}

/**
 * Implements hook_preprocess_image().
 */
function govstrap_preprocess_image($variables) {
  $variables['attributes']['class'][] = 'img-responsive';
}

/**
 * Implements hook_preprocess_image().
 */
function govstrap_preprocess_image_style($variables) {
  $variables['attributes']['class'][] = 'img-responsive';
}

/**
 * Prerocess the paragraphs items.
 *
 * @param $variables
 * @param $hook
 */
function govstrap_preprocess_paragraphs_items(&$variables, $hook) {
  $variables['items'] = $variables['element']['#items'];
  $variables['node'] = $variables['element']['#object'];
  // Add theme hook suggestion.
  $views_page = views_get_page_view();
  if (is_object($views_page)) {
    $variables['theme_hook_suggestions'][] = 'paragraphs_items__' . $variables['element']['#field_name'] . '__' . $variables['view_mode'] . '__' . 'views' . '__' . $views_page->name;
  }
}

/**
 * Preprocess the field.
 *
 * @param $vars
 */
function govstrap_preprocess_field(&$vars) {
  $function = 'govstrap_preprocess_field__' . $vars['element']['#field_name'];
  if (function_exists($function)) {
    $function($vars);
  }
}

/**
 * Preprocess the body field.
 *
 * @param $vars
 */
function govstrap_preprocess_field__body(&$vars) {
  // Process custom tokens.
  if (!empty($vars['items'][0]['#markup'])) {
    $content = $vars['items'][0]['#markup'];
    $content = _govstrap_custom_token_process($content);
    $vars['items'][0]['#markup'] = token_replace($content);
  }
}

/**
 * Scan custom token.
 *
 * @param $text
 * @return mixed
 */
function _govstrap_custom_token_process($text) {
  $tokens = _govstrap_custom_tokens();

  if (FALSE === strpos($text, '[')) {
    return $text;
  }

  // Find all registered tag names in $content.
  preg_match_all('@\[([^<>&/\[\]\x00-\x20=]++)@', $text, $matches);
  $tags = array_intersect(array_keys($tokens), $matches[1]);

  // Return if no tag found.
  if (empty($tags)) {
    return $text;
  }

  $pattern = get_shortcode_regex($tags);

  $text = preg_replace_callback("/$pattern/", '_govstrap_custom_token_callback', $text);

  return $text;
}

/**
 * Process custom token callback.
 */
function _govstrap_custom_token_callback($m) {
  $tokens = _govstrap_custom_tokens();

  // allow [[foo]] syntax for escaping a tag
  if ($m[1] == '[' && $m[6] == ']') {
    return substr($m[0], 1, -1);
  }

  $tag = $m[2];
  $attr = shortcode_parse_atts($m[3]);

  if (!is_callable($tokens[$tag])) {
    return $m[0];
  }

  if (isset($m[5])) {
    // enclosing tag - extra parameter
    return $m[1] . call_user_func($tokens[$tag], $attr, $m[5], $tag) . $m[6];
  }
  else {
    // self-closing tag
    return $m[1] . call_user_func($tokens[$tag], $attr, NULL, $tag) . $m[6];
  }
}

/**
 * List of custom tokens.
 *
 * @return array
 */
function _govstrap_custom_tokens() {
  return array(
    'resource' => '_govstrap_custom_token_resource',
    'case-studies' => '_govstrap_cleanup_token_casestudy',
  );
}

/**
 * Resource token callback.
 *
 * @param $attr
 * @param null $extras
 * @param $tag
 */
function _govstrap_custom_token_resource($attr, $extras = NULL, $tag) {
  $ids = $attr['ids'];

  if (!empty($ids)) {
    $output = views_embed_view('resources_list', 'views_block_resources', $ids);
  }
  else {
    $output = '';
  }

  return $output;
}

/**
 * Case studies token callback.
 *
 * @param $attr
 * @param null $extras
 * @param $tag
 */
function _govstrap_cleanup_token_casestudy($attr, $extras = NULL, $tag) {
  $ids = $attr['ids'];

  if (!empty($ids)) {
    $output = views_embed_view('case_study_list', 'views_block_case_study', $ids);
  }
  else {
    $output = '';
  }

  return $output;
}
