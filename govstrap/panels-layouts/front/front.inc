<?php

// Plugin definition
$plugin = array(
  'title' => t('Front'),
  'category' => t('EEX'),
  'icon' => 'front.png',
  'theme' => 'panels_front',
  'css' => 'front.css',
  'regions' => array(
    'top' => t('Top'),
    'left' => t('Left side'),
    'right' => t('Right side'),
    'bottom' => t('Bottom'),
  ),
);
