<?php

/**
 * @file
 * theme.inc
 */

/**
 * Implements theme_breadrumb().
 */
function govstrap_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    $page_type = arg(0);
    if ($page_type == 'node') {
      $node_id = arg(1);
      if (!empty($node_id) && is_numeric($node_id)) {
        $node = node_load(arg(1));
        switch ($node->type) {
          case 'webform':
            if (isset($node->field_title)) {
              $breadcrumb[] = 'Form';
              $breadcrumb[] = $node->field_title['und'][0]['value'];
            }

            break;
        }
      }
    }
    elseif ($page_type == 'search') {
      $breadcrumb = array(
        '<a href="/" title="eex.gov.au Energy Efficiency Exchange" rel="home" itemprop="url"><span itemprop="title">Home</span></a>',
        'Search',
      );
    }

    $breadcrumbs = '<ol class="breadcrumb">';
    $i = 0;
    foreach ($breadcrumb as $key => $value) {
      if ($i == 0) {
        $breadcrumbs .= '<li class="trail-begin">' . '<a href="/" title="eex.gov.au Energy Efficiency Exchange" rel="home" itemprop="url"><span itemprop="title">Home</span></a>' . '</li>';
      }
      else {
        $breadcrumbs .= '<li>' . $value . '</li>';
      }
      $i++;
    }
    $breadcrumbs .= '</ol>';

    return $breadcrumbs;
  }
}
