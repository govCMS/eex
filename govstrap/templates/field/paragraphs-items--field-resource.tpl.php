<?php

/**
 * @file
 * Default theme implementation for a group of paragraph items.
 *
 * Available variables:
 * - $content: Rendered HTML of content items.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - paragraphs-items
 *   - paragraphs-items-{field_name}
 *   - paragraphs-items-{field_name}-{view_mode}
 *   - paragraphs-items-{view_mode}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_paragraphs_items()
 * @see template_process()
 */

$resources = [];

$node_wrapper = entity_metadata_wrapper('node', $node);

// Information from node entity.
$resource_title = $node_wrapper->label();
$resource_source = $node_wrapper->field_resource_source->value();
$resource_year = !empty($node_wrapper->field_resource_year) ? $node_wrapper->field_resource_year->value() : '';

if (!empty($items)) {
  foreach ($items as $item_values) {
    $paragraphs_item_id = $item_values['value'];
    $paragraphs_entity = paragraphs_item_load($paragraphs_item_id);
    $paragraphs_wrapper = entity_metadata_wrapper('paragraphs_item', $paragraphs_entity);
    // Resource values.
    $resource_link_values = $paragraphs_wrapper->field_resource_url->value();
    $resources[] = array(
      'url' => $resource_link_values['url'],
      'type' => $paragraphs_wrapper->field_resource_type->value(),
      'size' => $paragraphs_wrapper->field_resource_size->value(),
      'external' => $paragraphs_wrapper->field_resource_external->value(),
    );
  }
}
?>

<div
  class="resource-link external <?php print $classes; ?>"<?php print $attributes; ?>>
  <div class="content">
    <a href="<?php print $resources[0]['url']; ?>"
       title="<?php print $resource_title; ?>" class="resource-title"
       target="_blank">
      <?php print $resource_title; ?>
      <span class="resource-year"><?php print $resource_year; ?></span>
      <span class="resource-external">(Opens in a new window)</span>
    </a>
    <ul class="resource-file-list">
      <li class="resource-source"><?php print $resource_source; ?></li>
      <?php foreach ($resources as $resource) { ?>
        <li>
          <a href="<?php print $resource['url']; ?>" title="Open <?php print $resource['type']; ?>" target="_blank">
            <?php print $resource['type']; ?> <?php print $resource['size']; ?>
          </a>
        </li>
      <?php } ?>
    </ul>
  </div>
</div>
