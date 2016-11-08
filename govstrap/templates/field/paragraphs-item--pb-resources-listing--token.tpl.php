<?php

/**
 * @file
 * Default theme implementation for a single paragraph item.
 *
 * Available variables:
 * - $content: An array of content items. Use render($content) to print them
 *   all, or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity
 *   - entity-paragraphs-item
 *   - paragraphs-item-{bundle}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened into
 *   a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */

$paragraphs_entity = $content['field_resource_url']['#object'];
$paragraphs_wrapper = entity_metadata_wrapper('paragraphs_item', $paragraphs_entity);

// Get parent node entity.
$node_entity = $paragraphs_entity->hostEntity();
$node_wrapper = entity_metadata_wrapper('node', $node_entity);

// Information from node entity.
$resource_title = $node_wrapper->label();
$resource_source = $node_wrapper->field_resource_source->value();
$resource_year = !empty($node_wrapper->field_resource_year) ? $node_wrapper->field_resource_year->value() : '';

// Paragraphs item id.
$paragraphs_item_id = $paragraphs_wrapper->getIdentifier();

// Resource values.
$resource_link_values = $paragraphs_wrapper->field_resource_url->value();
$resource_url = $resource_link_values['url'];
$resource_type = $paragraphs_wrapper->field_resource_type->value();
$resource_size = $paragraphs_wrapper->field_resource_size->value();
$resource_external = $paragraphs_wrapper->field_resource_external->value();
print $resource_url;
?>
